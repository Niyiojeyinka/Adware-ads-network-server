<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Account;
use App\Models\Transfer;
use App\Models\ExtAccount;
use App\Models\Withdrawal;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function extAccounts()
    {
        return $this->hasMany(ExtAccount::class,'user_id');
    }

    public function soldOrders()
    {
        return $this->hasMany(Order::class,'seller_id');
    }

      public function purchasedOrders()
    {
        return $this->hasMany(Order::class,'buyer_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class,'seller_id');
    }


    public function receivedTransfers()
    {
     return $this->hasMany(Transfer::class,'receiver_id');

    }

       public function sentTransfers()
    {
     return $this->hasMany(Transfer::class,'sender_id');

    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class,'user_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class,'role_id');
    }
}



