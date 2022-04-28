<?php

namespace App\Console\Commands;

use App\Models\V1\Ordenes;
use App\Models\V1\CarroCompras;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\V1\OrdenesController;
use App\Repositories\V1\OrdenCompraRepository;
use App\Repositories\V1\CarroComprasRepository;

class ConsultaOrdenes extends Command
{
    private OrdenesController $OrdenesController;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consulta:orden';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trabajo que se encarga de consultar las ordenes en la pasarela de pagos para actualizar su estado';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Seteamos el controlado de ordenes elc ual tiene una inyeccion de dependencias, en esta caso lo hacemos manual
        $this->OrdenesController = new OrdenesController(new OrdenCompraRepository(new Ordenes), new CarroComprasRepository(new CarroCompras));
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $ordenes_pendientes = Ordenes::where('status', 'created')->get();

            $ordenes_pendientes->each(function ($orden) {
                $this->OrdenesController->returnPayGateWay($orden->slug, false);
            });

            $texto = "[" . date('Y-m-d H:i:s') . "]: Se consultaron " . (($ordenes_pendientes) ? $ordenes_pendientes->count() : 0) . " ordenes";
            Storage::append('log_consulta_estado_orden.txt', $texto);
        } catch (\Throwable $th) {
            Storage::append('error_ejecucion_cron.txt', $th->getMessage());
        }
    }
}
