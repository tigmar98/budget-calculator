<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment',
        'budget_id',
        'payment_type'
    ];

    public function budget(){
        return $this->belongsTo(Budget::class, 'budget_id');
    }
}
