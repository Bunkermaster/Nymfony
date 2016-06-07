<?php
namespace Helper;

/**
 * Class ArtefactBuilder
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class ArtefactBuilder
{
    /**
     * Create controller CLI
     */
    public static function generateController()
    {
        CLIShellColor::mecho(
            'welcome to the Controller generation assistant.'.PHP_EOL,
            'green',
            'black'
        );
        // Get controller name
        $controllerName = readline("Enter controller name [suffixed with Controller] : ");
        $controllerName = preg_replace("/\W/", "", $controllerName);
        if ($controllerName === '') {
            CLIShellColor::mecho(
                'Please enter a valid Controller name (only alphabetical characters).'.PHP_EOL,
                'black',
                'red'
            );
            return;
        }
        $loader = new \Twig_Loader_Filesystem(APP_CORE_DIR.'builder/templates/');
        $twig = new \Twig_Environment($loader, array(
            'cache' => APP_CACHE_DIR,
        ));
        $methodList = [];
        while (($oneMethod = readline("Enter action name, leave blank to stop adding methods [suffixed with Action] : ")) != '') {
            $methodList[] = preg_replace("/\W/", "", $oneMethod);
        }
        $controllerCode = $twig->render('controller.php.twig', [
            'controllerName' => $controllerName,
            'methods' => $methodList
        ]);
        // create the controller file and write the generated code in it
        $controllerDirectory = APP_ROOT_DIR."Controller/";
        $controllerFile = $controllerDirectory.$controllerName.'.php';
        $controllerArtefact = '';
        if (!is_writable($controllerDirectory)) {
            throw new \Exception('Controller directory is not writable.');
        }
        if (!is_writable(APP_VIEW_DIR)) {
            throw new \Exception('View directory is not writable.');
        }
        touch($controllerFile);
        if (!file_put_contents($controllerFile, $controllerCode)) {
            throw new \Exception('Problem writing Controller file.');
        }
        echo $controllerFile." created.".PHP_EOL;
        // generate the views referenced in the newly created controller actions
        foreach ($methodList as $aMethod) {
            $methodFile = APP_VIEW_DIR.$controllerName."/".self::getArtefactName($aMethod).".html.twig";
            touch($methodFile);
            if (!file_put_contents($methodFile, '{% extends "base.html.twig" %}'.PHP_EOL)) {
                throw new \Exception('Problem writing Controller file.');
            }
            echo $methodFile." created.".PHP_EOL;
        }
        echo "Generation complete, happy coding!".PHP_EOL;
    }

    /**
     * get just the artefact name from controller or action full name
     * @param string $fullName
     * @param string $type
     * @return string
     */
    public static function getArtefactName($fullName, $type)
    {
        return substr($fullName, 0, - strlen($type));
    }
}
