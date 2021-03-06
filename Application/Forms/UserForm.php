<?php

namespace Application\Forms;

use Core\Form\AbstractForm;
use Core\Form\Element;

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
        $this->setName('account-edit-form');
        $this->setClasses('user-form');

        $this->addElement(
            'hidden',
            'user-id',
            [
                'required' => true,
            ],
            $this->userId
        );

        $this->addElement(
            'text',
            'username',
            [
                'required'      => true,
                'label'         => 'Username: ',
                'placeholder'   => 'only latin characters',
                'validators'       => [
                    Element::VALIDATOR_LATIN_CHARS_AND_NUM
                ],
                'filters'   => [
                    Element::FILTER_STRING_TRIM
                ]
            ],
            $this->username
        );

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
                'label'         => 'Confirm password: ',
                'placeholder'   => 'minimum six characters'
            ]
        );

        $this->addElement(
            'email',
            'email1',
            [
                'required'  => true,
                'label'     => 'Email: ',
                'placeholder'   => 'valid e-mail only'
            ]
        );

        $this->addElement(
            'email',
            'email2',
            [
                'required'      => true,
                'label'         => 'Confirm email: ',
                'placeholder'   => 'valid e-mail only'
            ]
        );

        $this->addElement(
            'text',
            'firstname',
            [
                'required'  => true,
                'label'     => 'First name: ',
                'validator' => [
                    Element::VALIDATOR_CHARS_ONLY
                ],
                'filters'   => [
                    Element::FILTER_UCFIRST,
                    Element::FILTER_STRING_TRIM
                ]
            ]
        );

        $this->addElement(
            'text',
            'lastname',
            [
                'required'  => true,
                'label'     => 'Last name: ',
                'validator'   => [
                    Element::VALIDATOR_CHARS_ONLY
                ],
                'filters'   => [
                    Element::FILTER_UCFIRST,
                    Element::FILTER_STRING_TRIM
                ]
            ]
        );

        $this->addElement(
            'text',
            'city',
            [
                'required'  => true,
                'label'     => 'City: ',
                'filters'   => [
                    Element::FILTER_UCFIRST,
                    Element::FILTER_STRING_TRIM
                ]
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
                'label'     => 'I agree with the terms and conditions',
                'validators'    => [
                    Element::VALIDATOR_IS_TRUE
                ]
            ],
            1
        );

        $this->createFieldset(
            'User : ',
            [
                'username',
                'password1',
                'password2',
                'email1',
                'email2'
            ]
        );

        $this->createFieldset(
            'User data: ',
            [
                'firstname',
                'lastname',
                'city',
                'sex'
            ]
        );

        $this->addElement(
            'button',
            'submit',
            [
                'required'      => false,
                'label'         => 'Submit',
            ]
        );
    }

    public function validate(array $values) : bool
    {
        if (empty($values['check'])) {
            $values['check'] = 0;
        }
        return parent::validate($values);
    }
}