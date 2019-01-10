<?php

namespace ItForFree\rusphp\PHP\Str;

use LogicException;

/**
 * Общая работа со строками
 *
 */
class Str extends StrCommon {
    /**
     * Добавляйте код и вносите правки в StrCommon
     */

     /**
     * Выделит из срока, указанного только в месяцах(int) годы и месяцы.
     * Например: 17 месяцев -> 1 год 5 месяцев
     *
     * @param int $termInMonth
      *
     * @return array
     */
    public static function changeTermFormatToStrict(int $termInMonth): array
    {
        return [
            'years' => intval($termInMonth/12),
            'months' => $termInMonth % 12,
        ];
    }

    /**
     * Сформирует строку для вывода какого-либо срока в виде "N лет M месяцев"
     * В качестве аргументов метод принимает уже рассчитанное число месяцев и лет:
     * количество месяцев не может быть больше 11. Увеличьте количество лет.
     *
     * Для выделения полных лет из общего количества месяцев можете использовать
     * метод Str::changeTermFormatToStrict()
     *
     * @param int $monthTerm
     * @param int $yearsTerm
     *
     * @return string
     *
     * @throws LogicException
     */
    public static function termToString(int $monthTerm, int $yearsTerm): string
    {
        if (1 == $monthTerm) {
            $monthString = ' месяц';
        } elseif (in_array($monthTerm, [2,3,4])) {
            $monthString = ' месяца';
        } elseif (in_array($monthTerm, [5,6,7,8,9,10,11])) {
            $monthString = ' месяцев';
        } else {
            throw new LogicException('Количество месяцев не может быть больше 11. Увеличьте количество лет.');
        }

        if (in_array($yearsTerm, [11,12,13,14])) {
            $yearsString = ' лет ';
        } elseif (1 == $yearsTerm % 10) {
            $yearsString = ' год ';
        } elseif (in_array($yearsTerm % 10, [2,3,4])) {
            $yearsString = ' года ';
        } else {
            $yearsString = ' лет ';
        }

        if (empty($yearsTerm)) {
            $stringTerm = $monthTerm.$monthString;
        } elseif (empty($monthTerm)) {
            $stringTerm = $yearsTerm.$yearsString;
        } elseif (empty($yearsTerm) && empty($monthTerm)) {
            $stringTerm = 'Не указано';
        } else {
            $stringTerm = $yearsTerm.$yearsString.$monthTerm.$monthString;
        }
    }

}
