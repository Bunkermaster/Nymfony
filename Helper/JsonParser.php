<?php
namespace Helper;

use Exception\JsonException;

/**
 * Class JsonParser
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class JsonParser
{
    public static function getJson(string $file, string $exceptionMessage = 'JSON file \'%s\' not found')
    {
        if (!file_exists($file)) {
            throw new JsonException(printf($exceptionMessage, $file));
        }
        if (!$data = json_decode(file_get_contents($file), true)) {
            throw new JsonException('JSON file \'$file\' badly formated');
        }
        return $data;
    }
}