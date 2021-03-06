<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

use Nazdrave\Model\DrinkModel;
use Nazdrave\Model\UserDrinkModel;
use Nazdrave\Model\VenueModel;
use Nazdrave\Model\ProducerModel;


class DrinkController extends BaseController {

    const MAX_RATING = 5;
    const LATEST_CHECKINS_COUNT = 30;

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
        $venueModel = new VenueModel($this->ci);
        $this->data['venues'] = $venueModel->getList($venueModel->getTableName(), 'name', 'asc');
        $producerModel = new ProducerModel($this->ci);
        $this->data['producers'] = $producerModel->getList($producerModel->getTableName(), 'name', 'asc');
        $userDrinkModel = new UserDrinkModel($this->ci);
        $this->data['checkins'] = $userDrinkModel->getLatestCheckins('drink_id', $drink->id, self::LATEST_CHECKINS_COUNT);
        $this->data['page_title'] = $drink->name;
        $this->data['item'] = $drink;
        return $this->render($response, 'drink/single.html', $this->data);
    }

    public function checkIn(Request $request, Response $response, Array $args) {
        if (!$this->logged) {
            return $response->withStatus(401);
        }
        if ($request->isPost()) {
            $validator = $this->ci->get('validation');
            $validator->add([
                'drink_id' => 'required',
                'venue_id' => 'required',
                'rating' => 'integer',
            ]);
            if ($validator->validate($request->getParsedBody())) {
                $userId = $this->data['user_id'];
                $drinkId = intval($request->getParam('drink_id'));
                $venueId = intval($request->getParam('venue_id'));
                $description = trim(strip_tags($request->getParam('description')));
                $rating = intval($request->getParam('rating'));
                $rating = $rating > self::MAX_RATING ? 0 : $rating;
                $rating = $rating < 0 ? 0 : $rating;

                $userDrinkModel = new UserDrinkModel($this->ci);
                $id = $userDrinkModel->checkIn($userId, $drinkId, $venueId, $description, $rating);
                if ($id) {
                    return $response->withRedirect('/drink/' . $drinkId . '/checkin#c' .$id, 302);
                }
            }
        }
        return $response->withRedirect('/', 302);
    }

    public function update(Request $request, Response $response, Array $args) {
        if ($this->data['level'] < 100) {
            return $response->withStatus(403);
        }
        $id = intval($request->getParam('id'));
        $name = $request->getParam('name');
        $producerId = $request->getParam('producer_id');
        $barcode = $request->getParam('barcode');
        $url = $request->getParam('url');
        $description = $request->getParam('description');
        $image = $request->getParam('image');

        $slug = $this->ci->get('slugify')->slugify($name);
        $newImage = $this->handleUpload($request, $slug, UPLOAD_BASE . '/drink');
        $image = $newImage ? $newImage : $image;

        $data = array(
            'name' => $name,
            'producer_id' => $producerId,
            'url' => $url,
            'barcode' => $barcode,
            'description' => $description,
            'image' => $image,
            'updated' => time(),
        );
        $drinkModel = new DrinkModel($this->ci);
        $id = $drinkModel->update($id, $data);
        return $response->withRedirect('/drink/' . $id . '/' .$slug, 302);
    }
}
