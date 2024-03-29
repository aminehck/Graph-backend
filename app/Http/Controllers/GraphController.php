<?php

namespace App\Http\Controllers;

use App\Graph;
use App\Http\Resources\GraphResource;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return GraphResource::collection(Graph::with('nodes')->orderBy('id', 'DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $graph = Graph::create([
            'name' => $request->name,
            'description' => $request->description,
          ]);
        return new GraphResource($graph);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $graph = Graph::findOrFail($id);
        return new GraphResource($graph);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $graph = Graph::findOrFail($id);
        $graph->update($request->all());
        return new GraphResource($graph);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $graph = Graph::findOrFail($id);
        $graph->nodes()->each(function ($node) {
            $node->edges()->delete();
            $node->delete();
        });
        $graph->delete();
        return response()->json(null, 204);
    }

    public function statistics($id)
    {
        return Graph::findOrFail($id);
    }
}
