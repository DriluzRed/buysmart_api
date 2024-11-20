<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{


    public function run(Request $request)
    {
        $report = Report::findOrFail($request->report_id);
        $query = $report->custom_query;
        $variables = json_decode($report->variables, true);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date') . ' 23:59:59';
        if ($startDate && $endDate) {
            if (isset($variables['DATERANGE']['fields'])) {
                foreach ($variables['DATERANGE']['fields'] as $table => $column) {
                    $replacement = "AND $table.$column BETWEEN '$startDate' AND '$endDate'";
                    $query = str_replace("[DATERANGE]", $replacement, $query);
                }
            }
        } else {
            $today = Carbon::today()->toDateString();
            if (isset($variables['DATERANGE']['fields'])) {
                foreach ($variables['DATERANGE']['fields'] as $table => $column) {
                    $replacement = "AND $table.$column BETWEEN '$today' AND '$today 23:59:59'";
                    $query = str_replace("[DATERANGE]", $replacement, $query);
                }
            }
        }
        try {
            // Asegúrate de que la consulta sea una cadena de texto
            $query = (string) $query;
            $results = DB::select($query);
            
            // Verificar si hay resultados
            if (empty($results)) {
                return redirect()->back()->with('error', 'No se encontraron resultados');
            }
    
            $headers = [];
            if (!empty($results)) {
                $headers = array_keys((array)$results[0]);
            }
    
            $filename = $report->name . '_' . date('Y-m-d_H-i-s') . '.xlsx';

            Excel::store(new ReportExport($results, $headers), $filename, 'public');
           
            return response()->download(storage_path('app/public/' . $filename))->deleteFileAfterSend(true);
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar el reporte: ' . $e->getMessage());
        }
    }

    public function deleteFile(Request $request)
    {
        $filePath = $request->input('file_path');
        if (file_exists($filePath)) {
            unlink($filePath);
            return response()->json(['message' => 'Archivo eliminado']);
        }
        return response()->json(['error' => 'No se encontró el archivo'], 404);
    }
}