<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Models\User;
use App\Repositories\SoftwareRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    protected $userRepository;
    protected $softwareRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, SoftwareRepository $softwareRepository)
    {
        $this->userRepository = $userRepository;
        $this->softwareRepository = $softwareRepository;
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
        $userCount = $this->userRepository->userCount();
        $userSoftwaresCount = $this->userRepository->countMySoftware();
        $softwareCount = $this->softwareRepository->countSoftware();

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
