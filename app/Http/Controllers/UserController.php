<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function userSoftware()
    {
        $user = User::findOrFail(auth()->user()->id);
        $softwares = $user->softwares;

        return view('Softwares.user-software', [ 
            'softwares' => $softwares, 
        ]);
    }
}
