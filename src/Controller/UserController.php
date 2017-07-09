<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Nazdrave\Model\UserModel;
use Nazdrave\Model\UserDrinkModel;

class UserController extends BaseController {

    public function home(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Наздраве');
        $userDrinkModel = new UserDrinkModel($this->ci);
        $this->data['checkins'] = $userDrinkModel->getLatestCheckins('user_id', $this->data['user_id'], 30);
        return $this->render($response, 'user/home.html', $this->data);
    }
}
