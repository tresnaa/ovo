<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
    	$this->tag->prependTitle('OVO');

        // Add some local CSS resources
        $this->assets->addCss('assets/css/bootstrap.min.css');
        $this->assets->addCss('assets/css/style.css');

        // And some local JavaScript resources
        $this->assets->addJs('assets/js/query-3.3.1.slim.min.js');
        $this->assets->addJs('assets/js/bootstrap.min.js');

    }
}
