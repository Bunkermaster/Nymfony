<?php
namespace Helper;


/**
 * Class Majordomo
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Majordomo
{
    /**
     * Clear TWIG cache
     * @return void
     * @throws \Exception if APP_ROOT_DIR is not defined
     * @throws \Exception if trying to delete a directory not in APP
     */
    public static function clearTwigCache()
    {
        if (!defined('APP_ROOT_DIR')) {
            throw new \Exception('Could not secure cache directory clearing.');
        }
        CLIShellColor::commandOutput("Clearing cache", 'green', 'black');
        $path = APP_CACHE_DIR;
        $rmDir = function ($file, $path) use (&$rmDir) {
            if (strpos($path, APP_ROOT_DIR) !== 0) {
                // in case of attempted deletion of a directory not inside
                // the application directory, throw an exception to halt the
                // execution of the script.
                throw new \Exception(
                    'The directory attempted to clear is not an application directory.'
                );
            }
            if (!in_array($file, ['.', '..'])) {
                if (is_dir($path.$file)) {
                    if (($dirContent = scandir($path.$file)) !== false) {
                        if (count($dirContent) > 2) {
                            foreach ($dirContent as $oneDir) {
                                $rmDir($oneDir, $path.$file.'/');
                            }
                        } else {
                            rmdir($file);
                        }
                    }
                    rmdir($path.$file);
                } elseif (is_file($path.$file)) {
                    unlink($path.$file);
                }
            }
        };
        foreach (scandir($path) as $oneFile) {
            $rmDir($oneFile, $path);
        }
        CLIShellColor::commandOutput("Cache cleared", 'green', 'black');
    }

    /**
     * Builds the commands array for the bin/console based on
     * the configuration file
     * @param string $configurationFile
     * @return array
     * @throws \Exception\JsonException
     */
    public static function loadConfig($configurationFile = 'commands.json') : array
    {
        $commandsArray = JsonParser::getJson(
            $configurationFile,
            "Command configuratio file not found"
        );
        $commands = [];
        foreach ($commandsArray as $catName => $category) {
            foreach ($category as $commandName => $command) {
                $commands[$catName][$command['name']]['method'] = $command['method'];
                $commands[$catName][$command['name']]['man'] = $command['man'];
            }
        }
        return $commands;
    }
}
