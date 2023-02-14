<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parkingPrice extends Model
{

    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['rates' => 'json'];

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
