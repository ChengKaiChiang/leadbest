<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'balance'];

    public function balaceLogs()
    {
        return $this->hasMany(BalanceLog::class, 'user_id', 'user_id');
    }
}
