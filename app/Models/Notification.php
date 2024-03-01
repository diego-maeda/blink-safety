<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'lifx_pd_st_petersburg',
        'lifx_pd_orlando',
    ];

    public function notification(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
