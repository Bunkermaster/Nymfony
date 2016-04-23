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
     *
     */
    public function tableBuilderProvider()
    {
        return [
            [
                [],
                null,
                '',
            ],
            [
                [
                    'a long string of weird text',
                    'str',
                    '',
                ],
                null,
                '',
            ],
        ];
    }

    /**
     * @dataProvider tableBuilderProvider
     * @param array $data
     * @param string $expected
     */
    public function testInit($data, $headers, $expected)
    {
        // test the TableBuilder
        $output = TableBuilder::init($data, $headers);
        $this->assertEquals($output, $expected);
    }
}
