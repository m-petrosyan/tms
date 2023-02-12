<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_to',
        'title',
        'img',
        'description',
        'status'
    ];

    protected $dates = [
        'created_at',
    ];

    public function getCreatedAtAttribute($value)
    {
        return $value;
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
