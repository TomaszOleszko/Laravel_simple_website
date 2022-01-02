<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
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

    use HasFactory;
}
