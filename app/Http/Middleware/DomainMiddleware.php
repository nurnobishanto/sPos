<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class DomainMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the current domain
        $domain = $request->getHost();

        // Define domain-specific configurations
        $config = [];

        switch ($domain) {
            case 'spos.soft-itbd.com':
                $config = [
                    'env' => '.env.spos',
                    'public' => public_path('spos'),
                    'storage' => storage_path('app/spos'),
                ];
                break;


            // Add more domains as needed

            default:
                // Use common configurations for unrecognized domains
                $config = [
                    'env' => '.env',
                    'public' => public_path(),
                    'storage' => storage_path(),
                ];
                break;
        }

        // Set the environment file dynamically
        Config::set('env', $config['env']);

        // Set the public and storage paths dynamically
        App::bind('path.public', function () use ($config) {
            return $config['public'];
        });

        App::bind('path.storage', function () use ($config) {
            return $config['storage'];
        });

        return $next($request);
    }
}
