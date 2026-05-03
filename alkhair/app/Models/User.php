<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

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
        'category_id',
        'kyc_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'kyc_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects(): HasMany{
        return $this->HasMany(Project::class,'association_id');
    }
    
    public function category(): BelongsTo{
        return $this->BelongsTo(Category::class,'category_id');
    }
    
    public function donations(): HasMany{
        return $this->HasMany(Donation::class,'donator_id');
    }
    
    public function isAdmin(): bool{
        return $this->role==='admin';
    }
    
    public function isAssociation(): bool{
        return $this->role==='association';
    }
    
    public function isDonator(): bool{
        return $this->role==='donator';
    }
    
    public function getRedirectRoute()
    {
        return match($this->role) {
            'admin' => route('admin.dashboard', absolute: false),
            'association' => $this->status === 'ACTIVE' ? route('association.dashboard', absolute: false) : route('home', absolute: false),
            'donator' => route('donator.dashboard', absolute: false),
            default => route('home', absolute: false),
        };
    }
}
