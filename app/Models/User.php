<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Software;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function softwares(){
        return $this->hasMany(Software::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPopularUser($limit=1)
    {
        $query = User::find(
            Software::select('user_id')
            ->groupBy('user_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit($limit)
            ->get());
        return $query;
    }
    public static function getYourPosition($idUser)
    {
        $position = null;
        $allUsers = User::getPopularUser(null);

        for ($i=0; $i < count($allUsers) ; $i++) { 
            if($allUsers[$i]->id == $idUser) $position = $i+1;//+1 bo pierwszą pozycją jest 0
        }
        return $position;        
    }
}
