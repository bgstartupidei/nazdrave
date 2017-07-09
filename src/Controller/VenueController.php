<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Nazdrave\Model\VenueModel;

class VenueController extends BaseController {

    public function list(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Всички заведения');
        $venueModel = new VenueModel($this->ci);
        $this->data['list'] = $venueModel->getList($venueModel->getTableName());
        return $this->render($response, 'venue/list.html', $this->data);
    }

    public function single(Request $request, Response $response, Array $args) {
        $id = intval($args['id']);
        $venueModel = new VenueModel($this->ci);
        $venue = $venueModel->get($venueModel->getTableName(), $id);
        if (!$venue) {
            return $response->withStatus(404);
        }
        $this->data['page_title'] = $venue->name;
        $this->data['item'] = $venue;
        return $this->render($response, 'venue/single.html', $this->data);
    }

}
