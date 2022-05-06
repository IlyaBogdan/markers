<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Marker;

class APIController extends Controller {

    // method GET to URL /all
    public function allMarkers(){
        $markers = Marker::all();
        return response()->json($markers, 200);
    }

    // method GET to URL /find
    public function find($mobile) {
        try {
            $marker = Marker::where('mobile', $mobile)->get()->first();
            return response()->json($marker, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        
    }

    // method PUT to URL /add-marker
    public function add(Request $req) {
        try {
            $marker = Marker::create($req->all());
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }        
        return response()->json($marker, 201);
    }

    // method DELETE to URL /delete-marker
    public function delete($id) {
        $marker = Marker::find($id);
        $marker->delete();
        $res = array(
            'id' => $marker->id,
            'mobile' => $marker->mobile,
            'coordinates' => sprintf('%f %f', $marker->x, $marker->y),
            'status' => "DELETED"
        );
        return response()->json(json_encode($res, JSON_UNESCAPED_SLASHES), 201);
    }
}
