<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $desde = '';
        $hasta = '';
        $data = [
            'total_customers' => Customer::whereDate('created_at', '>=', Carbon::now()->subDays(30))->count(),
            'total_pending_orders' => Order::where('status','pending')->whereDate('created_at', '>=', Carbon::now()->subDays(30))->count(),
            'total_finished_orders' => Order::where('status', 'delivered')->whereDate('created_at', '>=', Carbon::now()->subDays(30))->count(),
            'total_sales' => Order::where('status', 'delivered')->whereDate('created_at', '>=', Carbon::now()->subDays(30))->sum('total'),
        ];
        if($request->has('desde') && $request->has('hasta')) {
            $desde = $request->desde;
            $hasta = $request->hasta;
            $filteredData = [
                'total_customers' => Customer::whereBetween('created_at', [$desde, $hasta])->count(),
                'total_pending_orders' => Order::where('status','pending')->whereBetween('created_at', [$desde, $hasta])->count(),
                'total_finished_orders' => Order::where('status', 'delivered')->whereBetween('created_at', [$desde, $hasta])->count(),
                'total_sales' => Order::where('status', 'delivered')->whereBetween('created_at', [$desde, $hasta])->sum('total'),
            ];
        }
        else{
            $filteredData = [
                'total_customers' => Customer::whereDate('created_at', Carbon::today())->count(),
                'total_pending_orders' => Order::where('status', 'pending')->whereDate('created_at', Carbon::today())->count(),
                'total_finished_orders' => Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->count(),
                'total_sales' => Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total'),
            ];
        }

        $reports = Report::paginate(10);

        return view('backoffice.admin.dashboard')->with('data', $data)->with('filteredData', $filteredData)->with('reports', $reports);
    }
}