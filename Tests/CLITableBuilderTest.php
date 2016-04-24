<?php
namespace Tests;

use Helper\CLITableBuilder;

/**
 * Class CLITableBuilderTest
 * @package Tests
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class CLITableBuilderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * provides data for testInit
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
                '+----+----+------+'.PHP_EOL.
                '|One |Two |Three |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|1   |2   |3     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL.
                '|4   |5   |6     |'.PHP_EOL.
                '+----+----+------+'.PHP_EOL
                ,
            ],
        ];
    }

    /**
     * @test Helper\CLITableBuilder::init
     * @dataProvider tableBuilderProvider
     * @param array $data
     * @param null|array $headers
     * @param string $expected
     */
    public function testInitMethod($data, $headers, $expected)
    {
        // test the CLITableBuilder
        $output = CLITableBuilder::init($data, $headers);
        $this->assertEquals($output, $expected);
    }

    /**
     * @test Helper\TableBuilder::init
     */
    public function testInitRecordException()
    {
        // test the TableBuilder
        $this->setExpectedException('\Exception', 'Oops, no data to build a table with :(');
        CLITableBuilder::init(null, null);
    }

    /**
     * @test Helper\TableBuilder::init
     */
    public function testInitDataException()
    {
        // test the TableBuilder
        $this->setExpectedException('\Exception', 'Oops, no records to build a table with :(');
        CLITableBuilder::init([null], null);
    }
}
