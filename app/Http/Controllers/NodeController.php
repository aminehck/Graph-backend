<?php

namespace App\Http\Controllers;

use App\Edge;
use App\Node;
use Illuminate\Http\Request;
use App\Http\Resources\NodeResource;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        $node = Node::create([
            'tooltip' => $request->tooltip,
            'graph_id' => $request->graph_id
        ]);

        foreach($request->edges as $out_node_id) {
            //Create a relation between the new added node and the neighbor nodes
            $edge = Edge::create([
                'in_node_id' => $node->id,
                'out_node_id' => $out_node_id,
            ]);
            $node->edges()->save($edge);
            //Reverse the relation
            $neighbor = Node::find($out_node_id);
            $edge = Edge::create([
                'in_node_id' => $neighbor->id,
                'out_node_id' => $node->id,
            ]);
            $neighbor->edges()->save($edge);
        }
        return new NodeResource($node);
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
        $node = Node::findOrFail($id);
        return new NodeResource($node);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $node = Node::findOrFail($id);
        $node->update($request->all());
        if(is_null($request->edges)){
            $node->edges()->delete();
            $edges = Edge::where('out_node_id', '=', $node->id)->get();
            foreach ($edges as $edge) {
                $edge->delete();
            }
        } else {
            foreach ($node->edges as $edge) {
                if(!in_array($edge->out_node_id, $request->edges)){
                    $edge->delete();
                    $edge = Edge::where('in_node_id', '=', $edge->out_node_id)
                                ->where('out_node_id', '=', $edge->in_node_id)->first();
                    $edge->delete();
                }
            }
            foreach($request->edges as $edge) {
                if(!$node->edges->contains('out_node_id', $edge)){
                    $newEdge = Edge::create([
                        'in_node_id' => $node->id,
                        'out_node_id' => $edge,
                    ]);
                    $node->edges()->save($newEdge);

                    $neighbor = Node::find($edge);
                    $newEdge = Edge::create([
                        'in_node_id' => $neighbor->id,
                        'out_node_id' => $node->id,
                    ]);
                    $neighbor->edges()->save($newEdge);
                }
            }
        }
        return new NodeResource($node);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $node = Node::findOrFail($id);
        $node->edges()->each(function ($edge) {
            $edge->delete();
        });
        $neighbors = Edge::where('out_node_id', '=', $id)->get();
        foreach ($neighbors as $neighbor) {
            $neighbor->delete();
        }
        $node->delete();
        return response()->json(null, 204);

    }
}
