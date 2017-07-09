<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Nazdrave\Model\DrinkModel;

class DrinkController extends BaseController {

    public function list(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Всички напитки');
        $drinkModel = new DrinkModel($this->ci);
        $this->data['list'] = $drinkModel->getList($drinkModel->getTableName());
        return $this->render($response, 'drink/list.html', $this->data);
    }

    public function single(Request $request, Response $response, Array $args) {
        $id = intval($args['id']);
        $drinkModel = new DrinkModel($this->ci);
        $drink = $drinkModel->get($drinkModel->getTableName(), $id);
        if (!$drink) {
            return $response->withStatus(404);
        }
        $this->data['page_title'] = $drink->name;
        $this->data['item'] = $drink;
        return $this->render($response, 'drink/single.html', $this->data);
    }

}
