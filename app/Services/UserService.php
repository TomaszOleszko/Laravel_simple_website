<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($id)
    {
        $user = $this->userRepository->find($id);
        
        return $user;
    }

    public function hasSoftware($software)
    {
        (count($software)) ? $hasSoftware=true : $hasSoftware=false;
        return $hasSoftware;
    }

    public function getMySoftware($data)
    {
        $user = $this->userRepository->find(auth()->user()->id);
        //jeśli jest wybrana jakaś licencja   /software?licences
        if(!empty($data['licences']))
        {
            Session::put('userSoftwareFilter', $data['licences']);
            $software = $this->userRepository->getMySoftwareByLicence(Session::get('softwareFilter'), 10);
        }
        //jeśli wyczyszczono filtr  /software/get?delete-filter
        else if(!empty($data['clicked']) && $data['clicked']=='delete-filter')
        {
            Session::forget('userSoftwareFilter');
            $software = $this->userRepository->getMySoftwareByLicence(Session::get('softwareFilter'), 10);
        }
        //   /software
        else
        {
            if(Session::get('userSoftwareFilter'))
            {
                $software = $this->userRepository->getMySoftwareByLicence(Session::get('softwareFilter'), 10);
            }
            else{
                $software = $this->userRepository->getMySoftwareByLicence(Session::get('softwareFilter'), 10);
            }    
        }

        return $software;
    }

    public function updateUserProfile($data, $id)
    {
        DB::beginTransaction();
        try{
            $user = $this->userRepository->update($data, $id); 
        }
        catch(Exception $e)
        {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update user profil');
        }
        DB::commit();
        return $user;
    }
}

?>