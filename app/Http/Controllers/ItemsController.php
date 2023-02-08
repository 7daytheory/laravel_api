<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retrieve items
        $items = Item::get();

        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //For This API - can use store as the POST method
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'body' => 'required',
        ]);

        //If Validator fails return error message
        if($validator->fails()) {
            return ['response' => $validator->messages(), 'success' => false];
        }

        $item = new Item;
        $item->items_text = $request->input('text');
        $item->items_body = $request->input('body');
        $item->save();

        return response()->json($item);
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
        $item = Item::find($id);

        return response()->json($item);
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
        //Update item via API
        //For This API - can use store as the POST method
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'body' => 'required',
        ]);

        //If Validator fails return error message
        if($validator->fails()) {
            return ['response' => $validator->messages(), 'success' => false];
        }

        $item = Item::find($id);
        $item->items_text = $request->input('text');
        $item->items_body = $request->input('body');
        $item->save();

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
