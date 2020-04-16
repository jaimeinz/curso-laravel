<?php

namespace App\Console\Commands;

use App\Http\Controllers\UserController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ContarUsuraios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contarusuarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que regresa la cantidad de usuarios en la BD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $controller = new UserController();
        $cantidad = $controller->contarUsuarios();
        $msg = "Hay ".$cantidad." usuarios registrados\n";
        Log::info($msg);
        print("Hay ".$cantidad." usuarios registrados\n");
    }
}
