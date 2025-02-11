<?php

/*
*   Developer : Abd alwahed rajab
*/

// Run
// php artisan make:provider ResponseServiceProvider
namespace App\Providers;

use App\Http\Helpers\HttpCodes;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {



        $factory->macro('sendResponse', function ($data = false, $message = '') use ($factory) {

            $format = [
                'state' => true,
                'code' => HttpCodes::OK,
                'message' => $message,
            ];

            $format['data'] = $data ?? [];



            if (env('FULL_SYSTEM_DEBUG') == 'true') {
                $debug = debug_request();
                $format['debug'] = $debug;
            }

            return $factory->make($format);
        });


        $factory->macro('sendError', function ($code, $message = '', $data = []) use ($factory) {

            $false = [
                'state' => false,
                'code' => $code,
                'message' => $message,
            ];

            if ($data) {
                $false['errors'] = $data;
            }

            if (env('FULL_SYSTEM_DEBUG') == 'true') {
                $debug = debug_request();
                $false['debug'] = $debug;
            }

            return $factory->make($false,$code);
        });
    }






    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
