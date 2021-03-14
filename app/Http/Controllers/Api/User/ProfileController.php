<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\User\ProfileResource
     */
    public function show(Request $request)
    {
        return new ProfileResource($request->user());
    }
}
