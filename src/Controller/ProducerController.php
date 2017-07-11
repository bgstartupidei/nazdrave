<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Nazdrave\Model\ProducerModel;

class ProducerController extends BaseController {

    public function list(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Всички производители');
        $producerModel = new ProducerModel($this->ci);
        $this->data['list'] = $producerModel->getList($producerModel->getTableName());
        return $this->render($response, 'producer/list.html', $this->data);
    }

    public function single(Request $request, Response $response, Array $args) {
        $id = intval($args['id']);
        $producerModel = new ProducerModel($this->ci);
        $producer = $producerModel->get($producerModel->getTableName(), $id);
        if (!$producer) {
            return $response->withStatus(404);
        }
        $this->data['page_title'] = $producer->name;
        $this->data['item'] = $producer;
        return $this->render($response, 'producer/single.html', $this->data);
    }

    public function update(Request $request, Response $response, Array $args) {
        if ($this->data['level'] < 100) {
            return $response->withStatus(403);
        }
        $id = intval($request->getParam('id'));
        $name = $request->getParam('name');
        $url = $request->getParam('url');
        $description = $request->getParam('description');
        $image = $request->getParam('image');

        $slug = $this->ci->get('slugify')->slugify($name);
        $newImage = $this->handleUpload($request, $slug, UPLOAD_BASE . '/producer');
        $image = $newImage ? $newImage : $image;

        $data = array(
            'name' => $name,
            'url' => $url,
            'description' => $description,
            'image' => $image,
            'updated' => time(),
        );
        $producerModel = new ProducerModel($this->ci);
        $producerModel->update($id, $data);
        return $response->withRedirect('/producer/' . $id . '/' .$slug, 302);
    }
}
