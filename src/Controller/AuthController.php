<?php

namespace Nazdrave\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

use Nazdrave\Model\UserModel;

class AuthController extends BaseController {

    public function login(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Вход');
        $this->data['email'] = '';
        if ($request->isPost()) {
            $validator = $this->ci->get('validation');
            $validator->add([
                'email' => 'required | email',
                'password' => 'required | minlength(3)',
            ]);
            if ($validator->validate($request->getParsedBody())) {

                $email = trim($request->getParam('email'));
                $password = trim($request->getParam('password'));

                $this->data['email'] = $email;
                $userModel = new UserModel($this->ci);

                $user = $userModel->login($request->getParam('email'), $request->getParam('password'));
                if ($user) {
                    $this->session->set('id', $user->id);
                    $this->session->set('email', $user->email);
                    $this->session->set('level', $user->level);
                    // set cookie
                    return $response->withRedirect('/user');
                }
                $this->data['errors'] = [__('Невалидни email/парола')];
            } else {
                $this->data['errors'] = $validator->getMessages();
            }
        }

        return $this->render($response, 'auth/login.html', $this->data);
    }

    public function register(Request $request, Response $response, Array $args) {
        $this->data['page_title'] = __('Регистрация');
        $this->data['email'] = '';
        if ($request->isPost()) {
            $validator = $this->ci->get('validation');
            $validator->add([
                'email' => 'required | email',
                'password' => 'required | minlength(3)',
            ]);
            if ($validator->validate($request->getParsedBody())) {
                $userModel = new UserModel($this->ci);
                $email = $request->getParam('email');
                $password = $request->getParam('password');
                $id = $userModel->register($email, $password);
                if ($id) {
                    $this->session->set('id', $id);
                    $this->session->set('email', $email);
                    $this->session->set('level', 0);
                    return $response->withRedirect('/user');
                }
            } else {
                $this->data['errors'] = $validator->getMessages();
            }
        }
        return $this->render($response, 'auth/register.html', $this->data);
    }

    public function logout(Request $request, Response $response, Array $args) {
        $this->ci->get('session')->destroy();
        return $response->withRedirect('/');
    }

}
