<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SyncConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'config:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza las configuraciones desde la base de datos al caché';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $configs = Setting::all()->pluck('value', 'key')->toArray();
        Cache::put('db_configs', $configs);

        $this->info('Configuraciones sincronizadas con éxito.');
    }
}
