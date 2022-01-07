<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Software;

class SoftwareRepository extends BaseRepository{
    public function __construct(Software $model)
    {
        $this->model = $model;
    }

    public function getByLicence($licence)
    {
        if($licence){
            $softwareList = $this->model->where('licence', '=', $licence)->paginate(10);
        }
        else $softwareList = $this->paginate(10);

        return $softwareList;
    }

    public function countSoftware()
    {
        return $this->model->count();
    }
}

?>