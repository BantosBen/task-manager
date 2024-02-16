<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'is_done' => 'boolean',
    ];
    protected $fillable = [
        'title',
        'is_done'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('creator', function (QueryBuilder $builder) {
            $builder->where('creator_id', Auth::id());
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}