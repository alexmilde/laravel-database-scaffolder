<?php

namespace Alexmilde\Scaffolder\Commands;

use Illuminate\Console\Command;
use Alexmilde\Scaffolder\MigrationCreatorScaffoldable;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:migration {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a migration table';

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
        $migrationCreator = new MigrationCreatorScaffoldable($this->laravel['files'], database_path('migrations/stubs/'));

        $file = $migrationCreator->create(
            "create_{$this->argument('table')}_table",
            $this->getMigrationPath(),
            $this->argument('table'),
            true,
            $this->createScaffold($this->loadConfiguration())
        );

        $file = pathinfo($file, PATHINFO_FILENAME);
        $this->line("<info>Created Scaffolded Migration:</info> {$file}");
    }

    protected function loadConfiguration()
    {
        $path = database_path('migrations/scaffolds/') . $this->argument('table') . '.json';
        return json_decode(file_get_contents($path), true);
    }

    protected function createScaffold($config)
    {
        return collect($config)->map(function ($item, $key) {
            $optionalsString = "";
            if (array_key_exists('parameters', $item)) {
                $optionalsString = collect($item['parameters'])->reduce(function ($carry, $value) {
                    return $carry . ", " . $value;
                });
            }

            return '$table->' . $item['type'] . '(\'' . $key . '\'' . $optionalsString . ');' . "\n";

        })->reduce(function ($carry, $innerItem) {
            if ($carry) {
                return $carry . "\t\t\t" . $innerItem;
            }

            return $carry . $innerItem;

        });
    }

    protected function getMigrationPath()
    {
        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations';
    }
}
