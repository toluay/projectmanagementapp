<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Project_User extends Pivot
{
    use HasFactory;
    protected $table  = "project_user";

    // public static function boot(){
    //     parent::boot();
    //     static::created(function($item){
    //         dd('created ' , $item);

    //     });
    //     static::deleted(function($item){
    //         dd($item);
    //     });
    // }
}
