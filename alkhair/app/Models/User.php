<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profilePhoto',
        'role',
        'ville',
'licenseNumber',
 'address',
 'rib',
 'description',
 'documentKYC',
  'status',
   'category_id'    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects(){
    return $this->HasMany(Project::class,'association_id');
    }
    public function category(){
        return $this->BelongsTo(Category::class,'category_id');
    }
    public function donations(){
        return $this->HasMany(Donation::class,'donator_id');
    }
    public function isAdmin(){
        return $this->role='admin';
    }
     public function isAssociation(){
        return $this->role='association';
    }
     public function isDonator(){
        return $this->role='donator';
    }
}
