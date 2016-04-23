<?php
namespace Tests;

use Helper\TableBuilder;

/**
 * Class TableBuilderTest
 * @package Tests
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class TableBuilderTest extends \PHPUnit_Framework_TestCase
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
                    ]
                ],
                null,
                '+----------------------------+----+-+'.PHP_EOL.
                '|a long string of weird text |str | |'.PHP_EOL.
                '+----------------------------+----+-+'.PHP_EOL
                ,
            ],
        ];
    }

    /**
     * @test Helper\TableBuilder::init
     * @dataProvider tableBuilderProvider
     * @param array $data
     * @param null|array $headers
     * @param string $expected
     */
    public function testInitMethod($data, $headers, $expected)
    {
        // test the TableBuilder
        $output = TableBuilder::init($data, $headers);
        $this->assertEquals($output, $expected);
    }

    /**
     * @test Helper\TableBuilder::init
     */
    public function testInitRecordException()
    {
        // test the TableBuilder
        $this->setExpectedException('\Exception', 'Oops, no data to build a table with :(');
        TableBuilder::init(null, null);
    }

    /**
     * @test Helper\TableBuilder::init
     */
    public function testInitDataException()
    {
        // test the TableBuilder
        $this->setExpectedException('\Exception', 'Oops, no records to build a table with :(');
        TableBuilder::init([null], null);
    }
}
