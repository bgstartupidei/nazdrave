<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends BaseController {

    public function index(Request $request, Response $response, Array $args) {
        return $this->render($response, 'home/index.html', $this->data);
    }

    public function sitemap(Request $request, Response $response, Array $args) {
        return $this->render($response, 'home/sitemap.xml', $this->data);
    }

}
