<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class MigrateFreshPartial extends Command
{
    protected $signature   = 'migrate:fresh-partial {--seed : Run seeders after migration}';
    protected $description = 'Drop all tables except users and sessions, skip users-related migrations, and optionally run seeders (except UserSeeder)';

    public function handle()
    {
        // Run dropping tables
        $this->info('Dropping database (excluding users and sessions)...');
        $exceptTables = ['users', 'sessions', 'migrations'];
        $connection   = DB::connection();
        $driver       = $connection->getDriverName();

        if ($driver === 'sqlite') {
            $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
            $tables = array_map(fn($table) => $table->name, $tables);
        } elseif ($driver === 'mysql') {
            $databaseName = DB::getDatabaseName();
            $tables       = DB::table('information_schema.tables')
                ->select('table_name')
                ->where('table_schema', $databaseName)
                ->get()
                ->pluck('table_name')
                ->toArray();
        } elseif ($driver === 'pgsql') {
            $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
            $tables = array_map(fn($table) => $table->tablename, $tables);
        } else {
            throw new \Exception("Unsupported DB driver: $driver");
        }

        Schema::disableForeignKeyConstraints();
        foreach ($tables as $table) {
            if (!in_array($table, $exceptTables)) {
                Schema::drop($table);
                $this->line("Dropped table: $table");
            }
        }
        Schema::enableForeignKeyConstraints();

        if (Schema::hasTable('migrations')) {
            DB::table('migrations')->truncate();
        }

        // Run migration tables
        $this->info('Skipping user-related migrations...');
        $migrationPath  = database_path('migrations');
        $migrationFiles = glob($migrationPath . '/*.php');
        foreach ($migrationFiles as $file) {
            $contents      = file_get_contents($file);
            $migrationName = basename($file, '.php');

            if (preg_match("/Schema\s*::\s*(create|table)\s*\(\s*['\"]users['\"]/", $contents)) {
                DB::table('migrations')->insert([
                    'migration' => $migrationName,
                    'batch'     => 1,
                ]);
                $this->line("Skipped & marked as migrated (users): $migrationName");
            }
        }

        $this->info('Running remaining migrations...');
        Artisan::call('migrate', [], $this->getOutput());

        // Run seeder 
        if ($this->option('seed')) {
            $this->info('Running seeders (excluding UserSeeder)...');
            config(['seeder.skip_user' => true]);
            Artisan::call('db:seed', [], $this->getOutput());
        }

        $this->info('✅ All done.');
        return 0;
    }
}
