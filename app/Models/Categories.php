<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;



    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function articles(): HasMany{
        return $this->hasMany(Articles::class);
    }

}
