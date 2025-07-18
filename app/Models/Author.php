<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * @property mixed $name
 */
class Author extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
