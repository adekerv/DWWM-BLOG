<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Added 'role' to match your to-do list migration!
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role', 
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // 'role' => \App\Enums\UserRole::class, // (Optional) If you create a strict PHP 8 Enum file
        ];
    }

    /**
     * A User has many Articles.
     */
    public function articles(): HasMany 
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Helper method to check if the user is an Admin.
     * This will be super useful for protecting your "Espace Admin".
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}