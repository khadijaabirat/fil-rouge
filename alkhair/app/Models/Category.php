<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = ['name'];
    public function associations(){
    return $this->hasMany(User::class,'category_id')->where('role', 'association');
    }
    public function projects(){
    return $this->hasMany(Project::class,'category_id');
    }
}
