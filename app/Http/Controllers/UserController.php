<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function userSoftware(Request $request)
    {
        $software = $this->userService->getMySoftware($request->all());
        $hasSoftware = $this->userService->hasSoftware($software);

        return view('Softwares.user-software', [
            'softwares' => $software,
            'hasSoftware' => $hasSoftware,
        ]);
    }

    public function show($id){
        $user = $this->userService->getUser($id);
        switch ($user) {
            case null:
                $software = 0;
                $positionInRanking = 0;
                break;
            default:
                $software = $user->softwares;
                $positionInRanking = User::getYourPosition($user->id);
                break;
        }
        return view('user.show', [
            'user' => $user,
            'software' => $software,
            'positionInRanking' => $positionInRanking,
        ]);
    }

    public function edit($id)
    {
        $user = $this->userService->getUser($id);
        return view('user.edit',[
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->only([
            'name',
            'email'
        ]);
        $this->userService->updateUserProfile($data, $id);
        $user = $this->userService->getUser($id);

        return redirect('/user/'.$user->id);
    }
}
