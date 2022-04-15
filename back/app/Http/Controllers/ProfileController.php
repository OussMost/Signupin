<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        $profiles = Profile::all();
        return $this->sendOkResponse(['profiles' => $profiles]);
    }


    public function store(ProfileRequest $request)
    {
        $profile = Profile::create([
           'nom' => Str::upper($request->nom),
        ]);
        return $this->sendOkResponse(['profile' => $profile]);
    }
   
}
