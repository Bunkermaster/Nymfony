<?php
namespace Tests;

use Helper\CLITableBuilder;
use phpunit\framework\TestCase;

/**
 * Class CLITableBuilderTest
 * @package Tests
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class CLITableBuilderTest extends TestCase
{

    /**
     * provides data for testInit
     *  case #1 simple string table test
     *  case #2 Simple table
     *  case #3 Simple table with separator lines
     */
    public function tableBuilderProvider()
    {
        return [
            [
                [
                    [
                        'a long string of weird text',
                        'str',
                        '',
                    ],
                ],
                null,
                false,
                false,
                '+----------------------------+----+-+'.PHP_EOL.
                '|a long string of weird text |str | |'.PHP_EOL.
                '+----------------------------+----+-+'.PHP_EOL
                ,
            ],
            [
                [
                    [
                        '1',
                        '2',
                        '3',
                    ],
                    [
                        '4',
                        '5',
                        '6',
                    ],
                ],
                [
                    'One',
                    'Two',
                    'Three',
                ],
                false,
                false,
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|1   |2   |3     |'.PHP_EOL.
                '|4   |5   |6     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL
                ,
            ],
            [
                [
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                ],
                [
                    'One',
                    'Two',
                    'Three',
                ],
                true,
                false,
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL
                ,
            ],
            [
                [
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                ],
                [
                    'One',
                    'Two',
                    'Three',
                ],
                false,
                5,
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL
            ],
            [
                [
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                    [
                        'A',
                        'B',
                        'C',
                    ],
                    [
                        'D',
                        'E',
                        'F',
                    ],
                ],
                [
                    'One',
                    'Two',
                    'Three',
                ],
                true,
                false,
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|A   |B   |C     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|D   |E   |F     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL
            ],
        ];
    }

    /**
     * @test Helper\CLITableBuilder::init
     * @dataProvider tableBuilderProvider
     * @param array $data
     * @param null|array $headers
     * @param bool $separatorLines
     * @param bool|int $repeatHeader
     * @param string $expected
     */
    public function testInitMethod($data, $headers, $separatorLines, $repeatHeader, $expected)
    {
        // test the CLITableBuilder
        $output = CLITableBuilder::init($data, $headers, $separatorLines, $repeatHeader);
        $this->assertEquals($output, $expected);
    }

    /**
     * @test Helper\TableBuilder::init
     * @expectedException \Exception
     */
    public function testInitRecordException()
    {
        // test the TableBuilder
        CLITableBuilder::init(null, null);
    }

    /**
     * @test Helper\TableBuilder::init
     * @expectedException \Exception
     */
    public function testInitDataException()
    {
        // test the TableBuilder
        CLITableBuilder::init([null], null);
    }
}
