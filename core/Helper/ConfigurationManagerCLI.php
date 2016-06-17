<?php
namespace Helper;

/**
 * Class ConfigurationManagerCLI
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class ConfigurationManagerCLI
{
    /**
     * Outputs current configuration
     * @return void
     */
    public static function config()
    {
        $configOutput = '[App Configuration]' . PHP_EOL;
        ConfigurationManager::init();
        $constants = array_merge(
            get_defined_constants(true)['user'],
            ConfigurationManager::dump()
        );
        foreach ($constants as $constantName => $constantValue) {
            $configOutput .= $constantName.' = '.var_export($constantValue, true);
            $configOutput .= PHP_EOL;
        }
        CLIShellColor::commandOutput($configOutput.PHP_EOL, 'white', 'green');
    }
}
