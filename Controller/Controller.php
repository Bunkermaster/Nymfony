<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 03/04/16
 * Time: 15:00
 */

namespace Controller;


use Exception\ViewNotFoundException;
use Helper\Response;

/**
 * Class Controller
 * @package Controller
 */
abstract class Controller
{
    /**
     * @param $view
     * @param array $data
     * @param int $status
     * @param array $headers
     * @throws ViewNotFoundException
     * @return Response
     */
    protected function render($view, $data = [], $status = null, $headers = null)
    {
        if (!file_exists(APP_VIEW_DIR.$view)) {
            throw new ViewNotFoundException('View '.$view.' not found.');
        }
        ob_start();
        extract($data);
        require APP_VIEW_DIR.$view;
        $output = ob_get_contents();
        ob_end_clean();
        
        return new Response($output, $status, $headers);
    }
}
