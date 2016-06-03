<?php
namespace Helper;

/**
 * Class CLITableBuilder
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class CLITableBuilder
{
    /**
     * String
     */
    const TABLE_CORNER = "+";
    /**
     * String
     */
    const TABLE_HORIZONTAL_LINE = "-";
    /**
     * String
     */
    const TABLE_VERTICAL_LINE = "|";

    /**
     * @param array $data
     * @param array $headers
     * @param bool $separatorLines
     * if true, every line is seperated from next
     * if false, lines are not seperated
     * @param bool|int $repeatHeader
     * if false, never repeat header
     * if true, repeat header every $repeatHeader lines
     * @throws \Exception if $data is not an array
     * @return string CLI table
     */
    public static function init($data, $headers = null, $separatorLines = false, $repeatHeader = false)
    {
        // first line deleimiting the header
        $first = false;
        if (!is_array($data)) {
            throw new \Exception('Oops, no data to build a table with :(');
        }
        // get max length per field
        $maxLength = [];
        if (!is_null($headers) && is_array($headers)) {
            $first = true;
            $data = array_merge([$headers], $data);
        }
        // build column max length array
        foreach ($data as $record) {
            $i = 0;
            if (is_array($record)) {
                foreach ($record as $field) {
                    if (!isset($maxLength[$i]) || $maxLength[$i] < mb_strlen($field)) {
                        $maxLength[$i] = mb_strlen($field);
                    }
                    $i++;
                }
            } else {
                throw new \Exception('Oops, no records to build a table with :(');
            }
        }
        // declare $output string
        $output = '';
        $tableLine = '';
        // add 1 character for cosmetic reasons
        foreach ($maxLength as $index => $count) {
            $maxLength[$index] = $count + 1;
            $tableLine .= self::TABLE_CORNER . str_pad('', $maxLength[$index], self::TABLE_HORIZONTAL_LINE);
        }
        $tableLine .= self::TABLE_CORNER . PHP_EOL;
        $output .= $tableLine;
        /**
         * @var int $countLines
         * stores number of lines, starts at -1 to avoid counting header
         * not used unless a header is displayed
         */
        $countLines = -1;
        /**
         * @var string $header stores header for repeated header feature
         */
        $header = '';
        /**
         * @var string $headerForRepeat stores header for repeated header feature
         */
        $headerForRepeat = '';
        /**
         * @var bool $second used to avoid repeating header after header itself
         */
        $second = false;
        // generate lines
        foreach ($data as $record) {
            if (is_int($repeatHeader) && ($countLines % $repeatHeader === 0)) {
                if ($second !== true) {
                    $output .= $header;
                } else {
                    $output .= $headerForRepeat;
                }
            }
            $output .= self::TABLE_VERTICAL_LINE;
            $column = 0;
            // output fields
            foreach ($record as $field) {
                $output .= str_pad($field, $maxLength[$column], ' ').self::TABLE_VERTICAL_LINE;
                $column++;
            }
            $output .= PHP_EOL;
            // output seperators
            if ($second === true) {
                $second = false;
            }
            if ($first === true) {
                $first = false;
                $output .= $tableLine;
                if ($separatorLines !== false) {
                    $explodeHeader = explode(PHP_EOL, $output);
                    $headerForRepeat = $explodeHeader[1].PHP_EOL.$explodeHeader[2].PHP_EOL;
                } else {
                    $headerForRepeat = $header;
                }
                $header = $output;
                $second = true;
            } elseif ($separatorLines !== false) {
                $output .= $tableLine;
            }
            $countLines++;
        }
        if ($separatorLines == false) {
            $output .= $tableLine;
        }
        return $output;
    }
}
