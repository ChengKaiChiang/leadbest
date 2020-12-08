<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'transaction_type', 'amount'];

    public function balance(){
        return $this->belongsTo(Balance::class, 'user_id', 'user_id');
    }
}
