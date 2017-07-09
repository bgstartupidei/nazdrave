<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

use Nazdrave\Model\DrinkModel;
use Nazdrave\Model\ProducerModel;
use Nazdrave\Model\VenueModel;


class HomeController extends BaseController {

    public function index(Request $request, Response $response, Array $args) {
        return $this->render($response, 'home/index.html', $this->data);
    }

    public function sitemap(Request $request, Response $response, Array $args) {
        $drinkModel = new DrinkModel($this->ci);
        $this->data['drinks'] = $drinkModel->getList($drinkModel->getTableName());

        $producerModel = new ProducerModel($this->ci);
        $this->data['producers'] = $producerModel->getList($producerModel->getTableName());

        $venueModel = new VenueModel($this->ci);
        $this->data['venues'] = $venueModel->getList($venueModel->getTableName());

        return $this->render($response, 'home/sitemap.xml', $this->data);
    }

}
