<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Nazdrave\Model\UserModel;

class UserController extends BaseController {

    public function home(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Наздраве');
        return $this->render($response, 'user/home.html', $this->data);
    }
}
