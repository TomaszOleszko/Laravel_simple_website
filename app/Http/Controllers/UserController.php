<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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

    public function show(User $user){
        $software = $user->softwares;
        $positionInRanking = User::getYourPosition($user->id);
        return view('user.show', [
            'user' => $user,
            'software' => $software,
            'positionInRanking' => $positionInRanking,
        ]);
    }

    public function edit(User $user)
    {
        return view('user.edit',[
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        $user->update($data);
        return redirect('/user/'.$user->id);
    }
}
