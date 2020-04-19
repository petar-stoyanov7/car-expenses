<?php

namespace Application\Forms;

use Core\Form\AbstractForm;

class UserForm extends AbstractForm
{
    private $userId;
    private $username;

    public function __construct($userId = null, $username = null)
    {
        $this->userId = $userId;
        $this->username = $username;

        parent::__construct();
    }

    public function init()
    {
        $this->setMethod('post');

        $this->addElement(
            'text',
            'username',
            [
                'required'      => true,
                'label'         => 'Username: ',
                'placeholder'   => 'only latin characters',
            ],
            $this->username
        );

        if ($this->_checkEdit()) {
            $this->addElement(
                'password',
                'old-password',
                [
                    'required'      => true,
                    'label'         => 'Current password: ',
                    'placeholder'   => 'Required!'
                ]
            );
        }

        $this->addElement(
            'password',
            'password1',
            [
                'required'      => true,
                'label'         => 'Password: ',
                'placeholder'   => 'minimum six characters'
            ]
        );

        $this->addElement(
            'password',
            'password2',
            [
                'required'      => true,
                'label'         => 'Repeat password: ',
                'placeholder'   => 'minimum six characters'
            ]
        );

        $this->addElement(
            'email',
            'email1',
            [
                'required'  => true,
                'label'     => 'Email: ',
            ]
        );

        $this->addElement(
            'email',
            'email1',
            [
                'required'      => true,
                'label'         => 'Email: ',
                'placeholder'   => 'valid e-mail only'
            ]
        );

        $this->addElement(
            'email',
            'email2',
            [
                'required'      => true,
                'label'         => 'Repeat email: ',
                'placeholder'   => 'valid e-mail only'
            ]
        );

        $this->addElement(
            'text',
            'firstname',
            [
                'required' => true,
                'label' => 'First name: '
            ]
        );

        $this->addElement(
            'text',
            'lastname',
            [
                'required'  => true,
                'label'     => 'Last name: '
            ]
        );

        $this->addElement(
            'text',
            'city',
            [
                'required'  => true,
                'label'     => 'City: '
            ]
        );

        $this->addElement(
            'select',
            'sex',
            [
                'required'  => true,
                'label'     => 'Sex: ',
                'options'   => [
                    'male'      => 'Male',
                    'female'    => 'Female'
                ]
            ]
        );

        $this->addElement(
            'checkbox',
            'check',
            [
                'required'  => true,
                'label'     => 'I agree with the terms and conditions'
            ],
            true
        );

        if ($this->_checkEdit()) {
            $this->addElement(
                'hidden',
                'id',
                ['required' => true],
                $this->userId
            );

            $this->disableElement('username');

            $this->getElementByName('password1')->setPlaceholder(
                'enter new password'
            );
            $this->getElementByName('password2')->setPlaceholder(
                'repeat new password'
            );
            $this->removeElements([
                'email2',
                'check'
            ]);
        }

        $this->addElement(
            'button',
            'submit',
            [
                'required'  => false,
                'label'     => 'Submit'
            ]
        );

    }

    private function _checkEdit() : bool
    {
        if (!empty($this->userId) && !empty($this->username)) {
            return true;
        }

        return false;
    }
}