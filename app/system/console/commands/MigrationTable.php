<?php namespace System\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Console\Migrations\MigrateCommand;

class MigrationTable extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'kave:migrate';

    /**
     * @var string The console command description.
     */
    protected $description = 'migration single table';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        // $this->output->writeln('Hello world!');
        $this->migrate();

    }

}
