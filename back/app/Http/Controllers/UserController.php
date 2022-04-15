<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return $this->sendOkResponse(['users' => $users]);
    }


    public function store(UserRequest $request)
    {
        $this->unique("users", "email", Str::lower($request->email));
        $nomsociete = $request->nomsociete ? $request->nonsociete : null;
        $ice = $request->ice ? $request->ice : null;
        $user = User::create([
           'nomfamille' => Str::upper($request->nomfamille),
           'type' => Str::upper($request->type),
           'nomsociete' => Str::upper($nomsociete),
           'ice' => Str::upper($ice),
           'profile_id' => 2, //2 = profile clients
           'prenom' => Str::upper($request->prenom),
           'email' => Str::lower($request->email),
           'password' => Hash::make($request->password),
        ]);
        return $this->sendOkResponse(['user' => $user]);
    
}
   
  

  

}
