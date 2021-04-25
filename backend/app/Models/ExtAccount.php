<?php

namespace App\Models;

use App\Models\User;
use App\Models\ExtAccountProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtAccount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
    return $this->belongsTo(User::class,'user_id');
    }

    public function provider()
    {
    return $this->belongsTo(ExtAccountProvider::class,'provider_id');
    }


}
