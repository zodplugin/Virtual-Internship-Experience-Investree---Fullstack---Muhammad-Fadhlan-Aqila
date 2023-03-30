<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','content','category_id','user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Categories::class,'category_id','id');
    }
}
