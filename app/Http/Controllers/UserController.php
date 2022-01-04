<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userSoftware(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $software = $user->softwares;
        if(count($software)) $hasSoftware = true;
        else $hasSoftware = false;
        $data = $request->all();
        $filter = null;
        //jeśli jest wybrana jakaś licencja   /software?licences
        if(!empty($data['licences']))
        {
            $software = $user->softwares()->where('licence', '=', $data['licences'])->paginate(10);
            Session::put('userSoftwareFilter', $data['licences']);
            $filter = Session::get('userSoftwareFilter');
            // session(['softwareFilter' => $data['licences']]);
        }
        //jeśli wyczyszczono filtr  /software/get?delete-filter
        else if(!empty($data['clicked']) && $data['clicked']=='delete-filter')
        {
            Session::forget('userSoftwareFilter');
            $filter = null;
            $software = $user->softwares()->paginate(10);
        }
        //   /software
        else
        {
            if(Session::get('userSoftwareFilter'))
            {
                $software = $user->softwares()->where('licence', '=', Session::get('userSoftwareFilter'))->paginate(10);
            }
            else{
                $software = $user->softwares()->paginate(10);
            }    
        }

        return view('Softwares.user-software', [ 
            'softwares' => $software, 
            'hasSoftware' => $hasSoftware,
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
