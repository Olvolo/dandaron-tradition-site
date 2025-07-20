<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @param int|null $excludeId
 *  @return array
 *@property int|null $parent_id
 * @property mixed $parent
 * @property mixed $authors
 * @property mixed $category_id
 *  @property mixed $title
 * @property mixed $snippet
 */
class Article extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order_column');
    }

    public static function getArticleTree(int $excludeId = null): array
    {
        $tree = [];
        $rootArticles = self::query()->whereNull('parent_id')->orderBy('order_column')->get();

        /** @var Article $article */
        foreach ($rootArticles as $article) {
            if ($article->getKey() == $excludeId) {
                continue;
            }
            $tree[$article->getKey()] = $article->title;
            self::buildArticleSubTree($article, $tree, 1, $excludeId);
        }

        return $tree;
    }
    private static function buildArticleSubTree(Article $article, array &$tree, int $level, int $excludeId = null): void
    {
        $children = $article->children()->orderBy('order_column')->get();

        /** @var Article $child */
        foreach ($children as $child) {
            if ($child->getKey() == $excludeId) {
                continue;
            }
            $tree[$child->getKey()] = str_repeat('-- ', $level) . $child->title;
            self::buildArticleSubTree($child, $tree, $level + 1, $excludeId);
        }
    }

    /**
     * Возвращает плоский массив дочерних разделов в виде дерева для <select>.
     */
    public function getSectionTree(int $excludeId = null): array
    {
        $tree = [];
        // Начинаем с дочерних элементов верхнего уровня для ЭТОЙ статьи
        $rootSections = $this->children()->whereNull('parent_id')->orderBy('order_column')->get();

        /** @var Article $section */
        foreach ($rootSections as $section) {
            if ($section->getKey() == $excludeId) {
                continue;
            }
            $tree[$section->getKey()] = $section->title;
            $this->buildSectionSubTree($section, $tree, 1, $excludeId);
        }

        return $tree;
    }

    /**
     * Рекурсивная вспомогательная функция для построения поддерева.
     */
    private function buildSectionSubTree(Article $section, array &$tree, int $level, int $excludeId = null): void
    {
        $children = $section->children()->orderBy('order_column')->get();

        /** @var Article $child */
        foreach ($children as $child) {
            if ($child->getKey() == $excludeId) {
                continue;
            }
            $tree[$child->getKey()] = str_repeat('-- ', $level) . $child->title;
            $this->buildSectionSubTree($child, $tree, $level + 1, $excludeId);
        }
    }
}
