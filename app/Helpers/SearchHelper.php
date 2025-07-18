<?php

namespace App\Helpers;

class SearchHelper
{
    public static function highlight(string $text, string $query, int $limit = 200): string
    {
        // Убираем все HTML-теги, чтобы искать по чистому тексту
        $plainText = strip_tags($text);
        $query = preg_quote($query, '/');

        // Находим первое вхождение поискового запроса
        $pos = mb_stripos($plainText, $query, 0, 'UTF-8');

        if ($pos === false) {
            // Если слово не найдено, просто возвращаем начало текста
            return mb_substr($plainText, 0, $limit) . (mb_strlen($plainText) > $limit ? '...' : '');
        }

        // Определяем, с какого символа начать вырезать фрагмент
        $start = max(0, $pos - ($limit / 2));

        // Вырезаем фрагмент текста вокруг найденного слова
        $snippet = mb_substr($plainText, $start, $limit, 'UTF-8');

        // Подсвечиваем все вхождения запроса внутри фрагмента жирным
        $highlighted = preg_replace("/($query)/i", '<strong class="bg-primary/50 dark:bg-primary/70">$1</strong>', $snippet);

        return ($start > 0 ? '...' : '') . $highlighted . (mb_strlen($plainText) > ($start + $limit) ? '...' : '');
    }
}
