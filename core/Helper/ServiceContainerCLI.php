<?php
namespace Helper;

/**
 * Class ContainerCLI
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package core\Helper
 */
class ServiceContainerCLI
{
    /**
     * Outputs container debug information
     * @return void
     */
    public static function container()
    {
        $containerOutput = '[ServiceContainer]' . PHP_EOL;
        ServiceContainer::init();
        $services = ServiceContainer::getServiceCollection();
        $serviceDebug = [];
        foreach ($services as $name => $service) {
            $serviceDebug[] = [
                'name' => $name,
                'class' => get_class($service),
            ];
        }
        $containerOutput .= CLITableBuilder::init(
            $serviceDebug,
            ['Name', 'Class'],
            false,
            10
        );
        CLIShellColor::commandOutput($containerOutput.PHP_EOL, 'white', 'green');
    }
}
