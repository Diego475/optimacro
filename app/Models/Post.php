<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'short_description', 'cover', 'miniature'];

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['limit'])) $query->limit($filters['limit']);

        return $query;
    }

    public function scopeSorting($query, $sort)
    {
        if (isset($sort['date'])) $query->orderBy('created_at', $sort['date']);

        return $query;
    }
}
