<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\Chapter
 *
 * @property int $id
 * @property int $book_id
 * @property int|null $parent_id
 * @property string $title
 * @property string $slug
 * @property string $content_html
 * @property int $order_column
 * @property boolean $is_hidden
 * @property-read Book $book
 * @property-read Chapter|null $parent
 * @property-read Collection|Chapter[] $children
 * @property mixed $snippet
 */
class Chapter extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];

    /**
     * Получить родительскую книгу.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Получить родительский раздел.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Получить все дочерние разделы.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order_column');
    }
}
