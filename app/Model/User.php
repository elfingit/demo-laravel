<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
	const STATUS_ACTIVE = 'active';
	const STATUS_SUSPENDED = 'suspended';
	const STATUS_SELF_EXCLUDED = 'self-excluded';
	const STATUS_SELF_CLOSED = 'self-closed';
	const STATUS_CLOSED = 'closed';

    use HasApiTokens, Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status_finished_at' => 'datetime'
    ];

	public function role()
	{
		return $this->belongsTo(UserRole::class, 'user_role_id', 'id');
	}

	public function profile()
	{
		return $this->hasOne(UserProfile::class, 'user_id', 'id');
	}

	public function available_balance()
	{
		return $this->hasOne(UserAvailableBalance::class, 'user_id', 'id');
	}

	public function leads()
    {
        return $this->hasMany(Lead::class, 'user_id', 'id');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class, 'user_id', 'id');
    }

    public function getPaidBetsAttribute()
    {
        return $this->bets()
                    ->where('bets.status', Bet::STATUS_PAID)
                    ->count(['bets.id']);
    }

    public function getPendingBetsAttribute()
    {
        return $this->leads()
                ->where('leads.status', Lead::STATUS_NEW)
                ->count(['leads.id']);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
    }

    public function docs()
    {
        return $this->hasMany(UserAuthDoc::class, 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(UserTransaction::class, 'user_id', 'id');
    }
}
