<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];
    
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('active');
    }
    public function tasks(){
        return $this->hasManyThrough(task::class, Project_User::class , 'project_id','user_id','id', 'user_id' );
    }

}
