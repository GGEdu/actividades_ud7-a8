<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\API;
use App\Models\APIMethod;

class APIMethodController extends Controller
{
    public function index($apiId)
    {
        $api = API::findOrFail($apiId);
        $methods = $api->methods;
        return response()->json(['message' => 'API methods retrieved successfully', 'data' => $methods], 200);
    }
    
    public function store(Request $request, $apiId)
    {
        $api = API::findOrFail($apiId);
        $validatedData = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'documentation' => 'required',
        ]);

        $method = new APIMethod($validatedData);
        $api->methods()->save($method);
        return response()->json(['message' => 'API method created successfully', 'data' => $method], 201);
    }

    public function show($apiId, $methodId)
    {
        $api = API::findOrFail($apiId);
        $method = $api->methods()->findOrFail($methodId);
        return response()->json(['message' => 'API method retrieved successfully', 'data' => $method], 200);
    }

    public function update(Request $request, $apiId, $methodId)
    {
        $api = API::findOrFail($apiId);
        $method = $api->methods()->findOrFail($methodId);

        $validatedData = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'documentation' => 'required',
        ]);

        $method->update($validatedData);
        return response()->json(['message' => 'API method updated successfully', 'data' => $method], 200);
    }

    public function destroy($apiId, $methodId)
    {
        $api = API::findOrFail($apiId);
        $method = $api->methods()->findOrFail($methodId);
        
        $method->delete();
        return response()->json(['message' => 'API method deleted successfully'], 200);
    }
}
