<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SystemHealthCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:health-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifier la santé du système AL-KHAIR';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Vérification de la santé du système AL-KHAIR...');
        $this->newLine();

        $checks = [
            'Base de données' => $this->checkDatabase(),
            'Cache' => $this->checkCache(),
            'Storage' => $this->checkStorage(),
            'Queue' => $this->checkQueue(),
            'Permissions' => $this->checkPermissions(),
            'Configuration' => $this->checkConfiguration(),
        ];

        $allPassed = true;

        foreach ($checks as $name => $result) {
            if ($result['status']) {
                $this->info("✅ {$name}: {$result['message']}");
            } else {
                $this->error("❌ {$name}: {$result['message']}");
                $allPassed = false;
            }
        }

        $this->newLine();

        if ($allPassed) {
            $this->info('🎉 Tous les tests sont passés avec succès!');
            return Command::SUCCESS;
        } else {
            $this->error('⚠️  Certains tests ont échoué. Veuillez corriger les problèmes.');
            return Command::FAILURE;
        }
    }

    protected function checkDatabase()
    {
        try {
            DB::connection()->getPdo();
            $tables = DB::select('SHOW TABLES');
            return [
                'status' => true,
                'message' => 'Connexion réussie (' . count($tables) . ' tables)',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Erreur de connexion: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkCache()
    {
        try {
            Cache::put('health_check', 'test', 10);
            $value = Cache::get('health_check');
            Cache::forget('health_check');

            if ($value === 'test') {
                return [
                    'status' => true,
                    'message' => 'Cache fonctionnel (' . config('cache.default') . ')',
                ];
            }

            return [
                'status' => false,
                'message' => 'Le cache ne fonctionne pas correctement',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkStorage()
    {
        try {
            $disks = ['public', 'local'];
            $allWorking = true;

            foreach ($disks as $disk) {
                if (!Storage::disk($disk)->exists('')) {
                    $allWorking = false;
                    break;
                }
            }

            if ($allWorking) {
                return [
                    'status' => true,
                    'message' => 'Tous les disques sont accessibles',
                ];
            }

            return [
                'status' => false,
                'message' => 'Certains disques ne sont pas accessibles',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkQueue()
    {
        try {
            $connection = config('queue.default');
            $jobs = DB::table('jobs')->count();

            return [
                'status' => true,
                'message' => "Queue active ({$connection}), {$jobs} jobs en attente",
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkPermissions()
    {
        $directories = [
            storage_path(),
            storage_path('app'),
            storage_path('framework'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($directories as $dir) {
            if (!is_writable($dir)) {
                return [
                    'status' => false,
                    'message' => "Le dossier {$dir} n'est pas accessible en écriture",
                ];
            }
        }

        return [
            'status' => true,
            'message' => 'Toutes les permissions sont correctes',
        ];
    }

    protected function checkConfiguration()
    {
        $issues = [];

        if (config('app.debug') && app()->environment('production')) {
            $issues[] = 'APP_DEBUG est activé en production';
        }

        if (empty(config('app.key'))) {
            $issues[] = 'APP_KEY n\'est pas définie';
        }

        if (empty(config('services.stripe.key')) || empty(config('services.stripe.secret'))) {
            $issues[] = 'Configuration Stripe incomplète';
        }

        if (!empty($issues)) {
            return [
                'status' => false,
                'message' => implode(', ', $issues),
            ];
        }

        return [
            'status' => true,
            'message' => 'Configuration correcte',
        ];
    }
}
