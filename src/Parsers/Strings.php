<?php namespace Mossengine\FiveCode\Parsers;

use Mossengine\FiveCode\Exceptions\ParserNotAllowedException;
use Mossengine\FiveCode\Exceptions\ParserNotFoundException;
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
     * @param array $arrayData
     * @return int
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function length(FiveCode $fiveCode, array $arrayData = []) : int {
        $intLength = 0;
        foreach ($arrayData as $arg) {
            $intLength += strlen($fiveCode->instructions($arg));
        }
        return $fiveCode->result($intLength);
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function join(FiveCode $fiveCode, array $arrayData = []) : string {
        $glue = $fiveCode->instructions(array_shift($arrayData));
        return $fiveCode->result(
            implode(
                $glue,
                array_map(
                    function($item) use ($fiveCode) {
                        return $fiveCode->instructions($item);
                    },
                    $arrayData
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return array
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function split(FiveCode $fiveCode, array $arrayData = []) : array {
        $glue = $fiveCode->instructions(array_shift($arrayData));
        return $fiveCode->result(
            explode(
                $glue,
                self::join(
                    $fiveCode,
                    array_merge([$glue], $arrayData)
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function upper(FiveCode $fiveCode, array $arrayData = []) : string {
        return $fiveCode->result(
            strtoupper(
                self::join(
                    $fiveCode,
                    array_merge([''], $arrayData)
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function firstUpper(FiveCode $fiveCode, array $arrayData = []) : string {
        return $fiveCode->result(
            self::join(
                $fiveCode,
                array_merge(
                    [''],
                    array_map(
                        function($value) {
                            return ucfirst($value);
                        },
                        $arrayData
                    )
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function lower(FiveCode $fiveCode, array $arrayData = []) : string {
        return $fiveCode->result(
            strtolower(
                self::join(
                    $fiveCode,
                    array_merge([''], $arrayData)
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function firstLower(FiveCode $fiveCode, array $arrayData = []) : string {
        return $fiveCode->result(
            self::join(
                $fiveCode,
                array_merge(
                    [''],
                    array_map(
                        function($value) {
                            return lcfirst($value);
                        },
                        $arrayData
                    )
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function reverse(FiveCode $fiveCode, array $arrayData = []) : string {
        return $fiveCode->result(
            self::join(
                $fiveCode,
                array_merge(
                    [''],
                    array_map(
                        function($value) {
                            return strrev($value);
                        },
                        $arrayData
                    )
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return string
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function extract(FiveCode $fiveCode, array $arrayData = []) : string {
        return $fiveCode->result(
            call_user_func_array(
                'substr',
                array_map(
                    function($item) use ($fiveCode) {
                        return $fiveCode->instructions($item);
                    },
                    $arrayData
                )
            )
        );
    }

    /**
     * @param FiveCode $fiveCode
     * @param array $arrayData
     * @return array|\ArrayAccess|mixed|null
     * @throws ParserNotAllowedException
     * @throws ParserNotFoundException
     */
    public static function position(FiveCode $fiveCode, array $arrayData = []) {
        return $fiveCode->result(
            call_user_func_array(
                'strpos',
                array_map(
                    function($item) use ($fiveCode) {
                        return $fiveCode->instructions($item);
                    },
                    $arrayData
                )
            )
        );
    }

}