<?php namespace Mossengine\FiveCode\Parsers;

use Mossengine\FiveCode\FiveCode;

/**
 * Class Strings
 * @package Mossengine\FiveCode\Parsers
 */
class Strings extends ParsersAbstract {

    /**
     * @return array|string
     */
    public static function register() : array {
        return [
            'strings.length' => function($fiveCode, $arrayData) { return self::length($fiveCode, (array) $arrayData); },
            'strings.join' => function($fiveCode, $arrayData) { return self::join($fiveCode, (array) $arrayData); },
            'strings.split' => function($fiveCode, $arrayData) { return self::split($fiveCode, (array) $arrayData); },
            'strings.upper' => function($fiveCode, $arrayData) { return self::upper($fiveCode, (array) $arrayData); },
            'strings.first.upper' => function($fiveCode, $arrayData) { return self::firstUpper($fiveCode, (array) $arrayData); },
            'strings.lower' => function($fiveCode, $arrayData) { return self::lower($fiveCode, (array) $arrayData); },
            'strings.first.lower' => function($fiveCode, $arrayData) { return self::firstLower($fiveCode, (array) $arrayData); },
            'strings.reverse' => function($fiveCode, $arrayData) { return self::reverse($fiveCode, (array) $arrayData); },
            'strings.extract' => function($fiveCode, $arrayData) { return self::extract($fiveCode, (array) $arrayData); },
            'strings.position' => function($fiveCode, $arrayData) { return self::position($fiveCode, (array) $arrayData); },
        ];
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return int
     */
    public static function length(FiveCode $fiveCode, array $mixedData = []) : int {
        $intLength = 0;
        foreach ($mixedData as $arg) {
            $intLength += strlen($arg);
        }
        return $fiveCode->result($intLength);
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function join(FiveCode $fiveCode, array $mixedData = []) : string {
        $glue = array_shift($mixedData);
        return $fiveCode->result(implode($glue, $mixedData));
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return array
     */
    public static function split(FiveCode $fiveCode, array $mixedData = []) : array {
        $glue = array_shift($mixedData);
        return $fiveCode->result(explode($glue, self::join($fiveCode, array_merge([$glue], $mixedData))));
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function upper(FiveCode $fiveCode, array $mixedData = []) : string {
        return $fiveCode->result(strtoupper(self::join($fiveCode, array_merge([''], $mixedData))));
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function firstUpper(FiveCode $fiveCode, array $mixedData = []) : string {
        return $fiveCode->result(
            self::join(
                $fiveCode,
                array_merge(
                    [''],
                    array_map(
                        function($value) {
                            return ucfirst($value);
                        },
                        $mixedData
                    )
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function lower(FiveCode $fiveCode, array $mixedData = []) : string {
        return $fiveCode->result(strtolower(self::join($fiveCode, array_merge([''], $mixedData))));
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function firstLower(FiveCode $fiveCode, array $mixedData = []) : string {
        return $fiveCode->result(
            self::join(
                $fiveCode,
                array_merge(
                    [''],
                    array_map(
                        function($value) {
                            return lcfirst($value);
                        },
                        $mixedData
                    )
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function reverse(FiveCode $fiveCode, array $mixedData = []) : string {
        return $fiveCode->result(
            self::join(
                $fiveCode,
                array_merge(
                    [''],
                    array_map(
                        function($value) {
                            return strrev($value);
                        },
                        $mixedData
                    )
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return string
     */
    public static function extract(FiveCode $fiveCode, array $mixedData = []) : string {
        return $fiveCode->result(
            call_user_func_array(
                'substr',
                $mixedData
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $mixedData
     * @return array|\ArrayAccess|mixed|null
     */
    public static function position(FiveCode $fiveCode, array $mixedData = []) {
        return $fiveCode->result(
            call_user_func_array(
                'strpos',
                $mixedData
            )
        );
    }

}