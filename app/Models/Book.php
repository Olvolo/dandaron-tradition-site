<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @property mixed $title
 * @property mixed $authors
 */
class Book extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::deleting(function (Book $book) {
            $book->chapters()->delete();
        });
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('order_column');
    }

    /**
     * Возвращает плоский массив глав в виде дерева для использования в <select>.
     *
     * @param int|null $excludeId ID главы, которую нужно исключить (вместе с ее детьми)
     * @return array
     */
    public function getChapterTree(int $excludeId = null): array
    {
        $tree = [];
        $rootChapters = $this->chapters()->whereNull('parent_id')->orderBy('order_column')->get();

        // ДОБАВЛЕНА АННОТАЦИЯ ДЛЯ ЦИКЛА
        /** @var Chapter $chapter */
        foreach ($rootChapters as $chapter) {
            if ($chapter->id == $excludeId) {
                continue;
            }
            $tree[$chapter->id] = $chapter->title;
            $this->buildChapterSubTree($chapter, $tree, 1, $excludeId);
        }

        return $tree;
    }

    /**
     * Рекурсивная вспомогательная функция для построения поддерева.
     */
    private function buildChapterSubTree(Chapter $chapter, array &$tree, int $level, int $excludeId = null): void
    {
        $children = $chapter->children()->orderBy('order_column')->get();

        // ДОБАВЛЕНА АННОТАЦИЯ ДЛЯ ЦИКЛА
        /** @var Chapter $child */
        foreach ($children as $child) {
            if ($child->id == $excludeId) {
                continue;
            }
            $tree[$child->id] = str_repeat('-- ', $level) . $child->title;
            $this->buildChapterSubTree($child, $tree, $level + 1, $excludeId);
        }
    }
}
