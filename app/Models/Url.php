<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class Url extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['expires_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getShortHash(): string
    {
        return Str::random(8);
    }
}
