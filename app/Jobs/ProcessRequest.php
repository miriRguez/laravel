<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Jobs\Middleware\RateLimited;

class ProcessRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url, $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $params)
    {
        $this->url = $url;
        $this->params = $params;
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware()
    {
        return [new RateLimited];
    }

    /**
     * Execute the job.
     * @param string $url
     * @param mixed $params
     *
     * @return void
     */
    public function handle()
    {
        $status_success = 200;
        try {
            $response = Http::post($this->url, $this->params);
            if ($response->successful() && $response->ok() && $response->status() == $status_success) {
                return $response->body();
            }

            return -1;

        } catch (Throwable $e) {
            report($e);
            return -1;
        }
    }
}
