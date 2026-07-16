<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role',
        'last_login',
        'password',
    ];

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
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function deposits()
    {
        return $this->hasMany(WasteDeposit::class);
    }

    public function validatedDeposits()
    {
        return $this->hasMany(WasteDeposit::class, 'admin_id');
    }

    public function rewardRedemptions()
    {
        return $this->hasMany(RewardRedemption::class);
    }

    public function approvedRedemptions()
    {
        return $this->hasMany(RewardRedemption::class, 'admin_id');
    }
}
