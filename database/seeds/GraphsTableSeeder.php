<?php

use Illuminate\Database\Seeder;

class GraphsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Graph::class, rand(5,10))->create()->each(function($graph) {
            $graph->nodes()->saveMany(factory(App\Node::class, rand(4,8))->make());
          });
    }
}
