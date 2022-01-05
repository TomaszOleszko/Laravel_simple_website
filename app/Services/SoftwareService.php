<?php

namespace App\Services;

use App\Repositories\SoftwareRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use PharIo\Manifest\InvalidApplicationNameException;

class SoftwareService
{    
    /**
     * softwareRepository
     *
     * @var mixed
     */
    protected $softwareRepository;
    protected $userRepository;
    
    /**
     * SoftwareService contructor
     *
     * @param  SoftwareRepository $softwareRepository
     * @return void
     */
    public function __construct(SoftwareRepository $softwareRepository, UserRepository $userRepository)
    {
        $this->softwareRepository = $softwareRepository;   
        $this->userRepository = $userRepository;
    }

    public function getSoftware($data)
    {
        //jeśli jest wybrana jakaś licencja   /software?licences
        if(!empty($data['licences']))
        {
            Session::put('softwareFilter', $data['licences']);
            $softwares = $this->softwareRepository->getByLicence(Session::get('softwareFilter'));
        }
        //jeśli wyczyszczono filtr  /software/get?delete-filter
        else if(!empty($data['clicked']) && $data['clicked']=='delete-filter')
        {
            Session::forget('softwareFilter');
            $softwares = $this->softwareRepository->getByLicence(Session::get('softwareFilter'));
        }
        //   /software
        else
        {
            if(Session::get('softwareFilter'))
            {
                $softwares = $this->softwareRepository->getByLicence(Session::get('softwareFilter'));
            }
            else{
                $softwares = $this->softwareRepository->paginate();
            }
        }

        return $softwares;
    }

    public function saveSoftwareData($data)
    {
        $icons = ['fas fa-file-archive', 'far fa-file-archive', 'fas fa-file', 'far fa-file'];

        $data['icon'] =  $icons[array_rand($icons,1)];
        $user = $this->userRepository->find(auth()->user()->id);
        $software = $user->softwares()->create($data);
        return $software;
    }

    public function updateSoftwareData($data, $id)
    {
        DB::beginTransaction();
        try{
            $software = $this->softwareRepository->update($data, $id);   
        }
        catch(Exception $e)
        {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update software data');
        }
        DB::commit();
        return $software;
    }
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $software = $this->softwareRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete software data');
        }
        DB::commit();

        return $software;
    }
}

?>