<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class sendRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:postRequest {params}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will send a POST request to https://atomic.incfile.com/fakepost';

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
        echo 'prueba 1';
        $response = Http::post('http://test.com/users', []);
        dd($response->status());
        dd($response->body());
    }
}
