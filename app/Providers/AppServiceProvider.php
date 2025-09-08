<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use Exception;
use Google\Client;
use Google\Service\Drive\Drive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Masbug\Flysystem\GoogleDriveAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadGoogleStorageDriver();
        Builder::macro('withAndWhereHas', function ($relation, $constraint) {
            return $this->whereHas($relation, $constraint)
                        ->with([$relation => $constraint]);
        });

        Str::macro("ordinalWord", function($n) {
            $ordinals = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth'];

            if ($n >= 1 && $n <= count($ordinals)) {
                return $ordinals[$n - 1];
            }

            $v = $n % 100;
            if ($v >= 11 && $v <= 13) {
                $suffix = 'th';
            } else {
                switch ($n % 10) {
                    case 1: $suffix = 'st'; break;
                    case 2: $suffix = 'nd'; break;
                    case 3: $suffix = 'rd'; break;
                    default: $suffix = 'th';
                }
            }

            return $n . $suffix;
        });

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    }

    private function loadGoogleStorageDriver(string $driverName = "google") {
        try {
        Storage::extend($driverName, function($app, $config) {
            $options = [];

            if (!empty($config['teamDriveId'] ?? null)) {
                $options['teamDriveId'] = $config['teamDriveId'];
            }

            $client = new Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);

            $service = new \Google\Service\Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
            $driver = new \League\Flysystem\Filesystem($adapter);

            return new FilesystemAdapter($driver, $adapter);
        });
    } catch(Exception $e) {
        // your exception handling logic
    }
    }
}
