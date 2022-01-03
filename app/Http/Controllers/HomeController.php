<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $userCount = User::count();
        $softwareCount = Software::count();
        $userSoftwaresCount = $user->softwares->count();
        $popularLicence = Software::getPopularLicense(null,1);

        if(empty($popularLicence[0])){
            $popularLicence['licence'] = "None";
        }else{
            $popularLicence['licence'] = $popularLicence[0]['licence'];
        }
        $popularUser = User::getPopularUser(1);
        
        if (empty($popularUser[0])){
            $popularUser['name'] = "None";
        }else{
            $popularUser['name'] = $popularUser[0]['user_id'];
        }
        return view('home',['user' => $user,
            'userCount' => $userCount,
            'softwareCount'=>$softwareCount,
            'userSoftwaresCount'=>$userSoftwaresCount,
            'popularLicence'=>$popularLicence['licence'],
            'popularUser' =>$popularUser[0]['name']]);
    }

}
