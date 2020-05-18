<?php

namespace Application\Forms;

use Core\Form\AbstractForm;

class LoginForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setName('login-form');
        $this->setTarget('/account/login');
        $this->setOptions(
            [
                'classes' => ['login-form']
            ]
        );

        $this->addElement(
            'text',
            'login-username',
            [
                'required'      => true,
                'placeholder'   => 'Username'
            ]
        );

        $this->addElement(
            'password',
            'password',
            [
                'required'      => true,
                'placeholder'   => 'Password: '
            ]
        );

        $this->addElement(
            'button',
            'login-submit',
            [
                'required'  => false,
                'label'     => 'Login'
            ]
        );
    }
}