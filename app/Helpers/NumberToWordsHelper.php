<?php

namespace App\Helpers;

class NumberToWordsHelper
{
    private static $ones_teens = [ '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen' ];

    private static $tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    private static $scales = ['', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion'];

    public static function convert(float|int $num): string
    {
        $newNum = ['amount' => ''];
        $num = self::_inWords($newNum, $num, strlen((string) $num) < 4);
        return $newNum['amount'] ? $newNum['amount'] : $num;
    }

    private static function _inWords(array &$newNum, float|int $num, bool $lastPointSequence = false)
    {
        if ($num === 0) {
            return 'zero';
        }

        if ($num < 20) {
            return self::$ones_teens[$num];
        }

        if ($num < 100) {
            return self::$tens[floor($num / 10)] . ' ' . ($num % 10 !== 0 ? '' . self::$ones_teens[$num % 10] : '');
        }

        if ($num < 1000) {
            $closure = $lastPointSequence ? "and " : '';
            return $newNum['amount'] .= ' ' . self::$ones_teens[floor($num / 100)] . ' hundred ' . $closure . self::_inWords($newNum, $num - floor($num / 100) * 100);
        } else {
            $numToIterate = explode(",", number_format($num));

            for ($i = 0; $i < count($numToIterate); $i++) {
                $currentGroup = $numToIterate[$i];
                $isLastGroup = $i === count($numToIterate) - 1;
                
                if (strlen($currentGroup) !== 3) {
                    $newNum['amount'] .= self::_inWords($newNum, (int) $currentGroup) . ' ' . self::$scales[count($numToIterate) - $i - 1];
                } else {
                    self::_inWords($newNum, (int) $currentGroup, $isLastGroup);
                    $newNum['amount'] .= ' ' . self::$scales[count($numToIterate) - $i - 1] . ' ';
                }
            }
        }
    }
}

// Test the function
// $num = 123 456 780 9;
// $num = 3289933333232223423323232323333333;
// $words = NumberToWordsHelper::convert($num);

// echo "Number: $num  - In Words: $words";
