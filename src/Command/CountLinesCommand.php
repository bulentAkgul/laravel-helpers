<?php

namespace Bakgul\Kernel\Commands;

use Illuminate\Console\Command;
use Bakgul\Kernel\Helpers\Folder;
use Bakgul\Kernel\Helpers\Path;

class CountLinesCommand extends Command
{
    protected $signature = 'count {path?}';
    protected $description = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info($this->count(base_path($this->argument('path') ?? '')));
    }

    public function count($path)
    {
        $num = 0;

        foreach (Folder::content($path) as $item) {
            $itemPath = Path::glue([$path, $item]);
            $num += is_dir($itemPath) 
                ? $this->count($itemPath)
                : count(array_filter(array_map('trim', file($itemPath))));
        }

        return $num;
    }
}
