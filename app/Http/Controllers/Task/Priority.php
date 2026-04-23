<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\References\PriorityResource;
use App\Models\Management\Priority as ManagementPriority;
use Illuminate\Http\Request;

class Priority extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PriorityResource::collection(ManagementPriority::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ManagementPriority $priority)
    {
        return new PriorityResource($priority);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
