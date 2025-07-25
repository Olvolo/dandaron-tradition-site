<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $id
 */
class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class)->orderBy('order_column');
    }
}
