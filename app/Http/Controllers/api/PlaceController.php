<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $places = Place::all();

        return response()->json($places, 200);
    }


    public function store(Request $request){
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:places', // Ensure unique slug
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create Place
        $place = Place::create($request->all());

        // Return created Place
        return response()->json($place, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::find($id);

        if (!$place) {
            abort(404);
        }

        return response()->json($place);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['error' => 'Place not found'], 404);
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update place attributes
        $place->update($request->all());

        return response()->json($place);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['error' => 'Place not found'], 404);
        }

        $place->delete();

        return response()->json(['success' => true, 'message' => 'Place deleted successfully'], 200);
    }
}
