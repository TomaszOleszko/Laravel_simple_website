<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository extends BaseRepository{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getMySoftware()
    {
        $user = $this->model->find(auth()->user()->id);
        $mySoftware = $user->softwares;
        
        return $mySoftware;
    }
    public function getMySoftwareByLicence($licence, $paginate = 10)
    {
        $user = $this->model->find(auth()->user()->id);
        if($licence && $paginate)
        {
            $softwareList = $user->softwares()->where('licence', '=', $licence)->paginate($paginate);
        }
        else if($licence && $paginate < 1)
        {
            $softwareList = $user->softwares()->where('licence', '=', $licence);
        }
        else if ($paginate)
        {
            $softwareList = $user->softwares()->paginate($paginate);
        }
        else
        {
            $softwareList = $user->softwares()->get();
        }

        return $softwareList;
    }

    public function userCount()
    {
        return $this->model->count();
    }

    public function countMySoftware()
    {
        return count($this->getMySoftware());
    }
}

?>