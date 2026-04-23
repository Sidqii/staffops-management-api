<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\References\StatusResource;
use App\Models\Management\Status as ManagementStatus;
use Illuminate\Http\Request;

class Status extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StatusResource::collection(ManagementStatus::all());
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
    public function show(ManagementStatus $status)
    {
        return new StatusResource($status);
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
