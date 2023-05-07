<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = ['updated_at', 'created_at'];


    public function history(): BelongsTo
    {
        return $this->belongsTo(History::class);
    }
}
