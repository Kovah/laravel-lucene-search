<?php namespace Nqxcode\LuceneSearch\Console;

use Illuminate\Console\Command;
use Config;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class ClearCommand
 * @package Nqxcode\LuceneSearch\Console
 */
class ClearCommand extends Command
{
    protected $name = 'search:clear';
    protected $description = 'Clear the search index storage';

    public function handle()
    {
        if (!$this->option('verbose')) {
            $this->output = new NullOutput;
        }

        if (\File::isDirectory($indexPath = Config::get('laravel-lucene-search.index.path'))) {
            $fs = new Filesystem();
            $fs->cleanDirectory($indexPath);
            $this->info('Search index is cleared.');
        } else {
            $this->comment('There is nothing to clear..');
        }
    }
}
