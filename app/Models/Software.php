<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Software extends Model
{
    use HasFactory;

    protected $table = 'softwares';

    protected $fillable = [
        'title',
        'description',
        'link',
        'icon',
        'licence',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function getPopularLicense($sorting = 'asc', $limit = null)
    {
        if($sorting == 'asc')
        {
            $query = Software::select('licence')
            ->groupBy('licence')
            ->orderByRaw('COUNT(*)')
            ->limit($limit)
            ->get();
        }
        else
        {
            $query = Software::select('licence')
            ->groupBy('licence')
            ->orderByRaw('COUNT(*) DESC')
            ->limit($limit)
            ->get();
        }
        return $query;
    }
}
