<?php

namespace Application\Forms;

use Core\Form\Form;

class NewExpenseForm extends Form
{
    const NAME = "test";
    const METHOD = "post";
    const TARGET = "kur";

    public function init()
    {
        $this->setName('test');
        $this->setMethod('post');
        $this->setTarget('#');
        $this->setOptions(['classes' => ['test', 'pest']]);

        $this->addElement(
            'text',
            'test',
            [
                'label' => 'This is test',
                'required' => true,
                'classes' => [
                    'test', 'blessed'
                ],
            ],
            'test value'
        );

        $this->addElement(
            'select',
            'test-select',
            [
                'label' => 'Test select',
                'required' => false,
                'classes' => ['asd', 'vgz'],
                'options' => ['test', 'pest', 'klessed']
            ],
            2
        );

        $this->addElement(
            'button',
            'submit',
            [
                'label' => 'Enter form',
                'required' => false,
                'classes' => ['kur', 'tate', 'banica'],
                'onClick' => 'alert("kur")'
            ]
        );
    }

}