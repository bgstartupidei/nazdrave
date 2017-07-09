<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class BaseController {

    protected $logged = false;
    protected $ci;
    protected $data = [];

    public function __construct(Container $ci) {
        $this->ci = $ci;
        $this->session = $this->ci->get('session');
        $this->setDefaults();
    }

    private function setDefaults() {
        $this->data['domain_name'] = $this->ci->get('settings')['domainName'];
        $this->data['logged'] = false;
        $this->data['user_id'] = 0;
        $this->data['email'] = 0;
        $this->data['level'] = 0;
        $this->data['site_name'] = __('Наздраве');
        $this->data['title'] = __('Наздраве');
        $this->data['page_title'] = '';
        $user_id = $this->session->get('id');
        if ($user_id) {
            $this->logged = true;
            $this->data['logged'] = $this->logged;
            $this->data['user_id'] = intval($user_id);
            $this->data['email'] = $this->session->get('email');
            $this->data['level'] = $this->session->get('level');
        }
    }

    public function render($response, $template, $data) {
        return $this->ci->get('view')->render($response, $template, $data);
    }

}
