<?php

namespace App\Models;

use App\Models\InvestmentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investment extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(InvestmentType::class);
    }
}
