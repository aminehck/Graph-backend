<?php

namespace App\Console\Commands;

use App\Edge;
use App\Graph;
use App\Node;
use Illuminate\Console\Command;

class Graphs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graphs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'truncate Graphs Table';

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
        //
        Edge::truncate();
        Node::truncate();
        Graph::truncate();
        echo 'Graphs table truncated';
    }
}
