<?php

use Mossengine\FiveCode\Parsers\Strings;

/**
 * Class StringsTest
 */
class StringsTest extends PHPUnit_Framework_TestCase
{

    public function testCanLength() {
        $this->assertEquals(
            6,
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.length' => [
                        'abcdef'
                    ]]
                ])
                ->return(0)
        );
        $this->assertEquals(
            12,
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.length' => [
                        'abcdef',
                        'xyz',
                        '456'
                    ]]
                ])
                ->return(0)
        );
    }

    public function testCanJoin() {
        $this->assertEquals(
            'hello,world',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.join' => [
                        ',',
                        'hello',
                        'world'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'hello,world,FiveCode,ROCKS!!',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.join' => [
                        ',',
                        'hello',
                        'world',
                        'FiveCode',
                        'ROCKS!!'
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanSplit() {
        $this->assertEquals(
            [
                'hello',
                'world'
            ],
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.split' => [
                        ',',
                        'hello,world'
                    ]]
                ])
                ->return(false)
        );
        $this->assertEquals(
            [
                'hello',
                'world',
                'FiveCode',
                'ROCKS!!'
            ],
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.split' => [
                        ',',
                        'hello,world',
                        'FiveCode',
                        'ROCKS!!'
                    ]]
                ])
                ->return(false)
        );
    }

    public function testCanUpper() {
        $this->assertEquals(
            'HELLO WORLD',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.upper' => [
                        'hello world'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'HELLO WORLDFIVECODEROCKS!!',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.upper' => [
                        'hello world',
                        'FiveCode',
                        'ROCKS!!'
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanFirstUpper() {
        $this->assertEquals(
            'Hello world',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.first.upper' => [
                        'hello world'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'Hello worldFiveCodeRocks!!',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.first.upper' => [
                        'hello world',
                        'fiveCode',
                        'rocks!!'
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanLower() {
        $this->assertEquals(
            'hello world',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.lower' => [
                        'HELLO WORLD'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'hello worldfivecoderocks!!',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.lower' => [
                        'HELLO WORLD',
                        'FiveCode',
                        'ROCKS!!'
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanFirstLower() {
        $this->assertEquals(
            'hELLO WORLD',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.first.lower' => [
                        'HELLO WORLD'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'hELLO WORLDfiveCoderOCKS!!',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.first.lower' => [
                        'HELLO WORLD',
                        'FiveCode',
                        'ROCKS!!'
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanReverse() {
        $this->assertEquals(
            'dlroW olleH',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.reverse' => [
                        'Hello World'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'dlroW olleHedoCeviF!!SKCOR',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.reverse' => [
                        'Hello World',
                        'FiveCode',
                        'ROCKS!!'
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanExtract() {
        $this->assertEquals(
            ' World',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.extract' => [
                        'Hello World',
                        5
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            ' Wor',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.extract' => [
                        'Hello World',
                        5,
                        4
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            'Worl',
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.extract' => [
                        'Hello World',
                        -5,
                        4
                    ]]
                ])
                ->return('invalid')
        );
    }

    public function testCanPosition() {
        $this->assertEquals(
            6,
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.position' => [
                        'Hello World',
                        'World'
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertEquals(
            11,
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.position' => [
                        'Hello WorldWorld',
                        'World',
                        8
                    ]]
                ])
                ->return('invalid')
        );
        $this->assertFalse(
            Mossengine\FiveCode\FiveCode::make([
                'parsers' => [
                    'include' => [
                        'strings' => Strings::class
                    ]
                ]
            ])
                ->evaluate([
                    ['strings.position' => [
                        'Hello World',
                        'FiveCode'
                    ]]
                ])
                ->return('invalid')
        );
    }

}