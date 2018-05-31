<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class makeDoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'makeDoc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make doc';

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
        $ipath=base_path().'\app\Http\Controllers\Api\v1';
        $opath=base_path().'\public\apidoc';
        exec("apidoc -i ".$ipath." -o ".$opath);
    }
}
