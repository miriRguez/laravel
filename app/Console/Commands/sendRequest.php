<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Jobs\ProcessRequest;
use App\Http\Controllers\RequestDispatcherController;


class sendRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:postRequest {--url=?} {params?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will send a POST request to the given URL or by default to https://atomic.incfile.com/fakepost';

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
        $url_request = 'http://test.com/users';
        $url = $this->option('url');
        $params = $this->arguments();
        if($url != '?') {
            $url_request = $url;
        }

        RequestDispatcherController::postRequest($url_request, $params['params']);
    }
}
