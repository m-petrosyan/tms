<?php

namespace App\Models;

use App\Helpers\General;
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

    /**
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value): mixed
    {
        return $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getImgAttribute($value): string
    {
        return General::getPath($value, '', 'storage/task/');
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
