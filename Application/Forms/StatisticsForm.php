<?php

namespace Application\Forms;

use Core\Form\AbstractForm;

class StatisticsForm extends AbstractForm
{
    private $cars;
    private $expenses;
    private $userId;

    public function __construct($cars, $expenses, $userId)
    {
        $this->cars = $cars;
        $this->expenses = $expenses;
        $this->userId = $userId;

        parent::__construct();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setTarget('/statistics');
        $this->setName('get-statistics-form');

        $this->addElement(
            'hidden',
            'user-id',
            [
                'required' => true
            ],
            $this->userId
        );

        $this->addElement(
            'select',
            'car',
            [
                'label' => 'Car: ',
                'required' => true,
                'options' => $this->getCarOptions()
            ]
        );

        $this->addElement(
            'select',
            'expense-type',
            [
                'label' => 'Expense type',
                'required' => true,
                'options' => $this->getExpenseOptions()
            ]
        );

        $this->addElement(
            'date',
            'from',
            [
                'label' => 'From',
                'required' => true,
            ],
            date('Y-m-d',strtotime('-1 year'))
        );

        $this->addElement(
            'date',
            'to',
            [
                'label' => 'To',
                'required' => true,
            ],
            date('Y-m-d')
        );

        $this->addElement(
            'button',
            'submit',
            [
                'label' => 'Display',
                'required' => false,
                'classes' => ['submit'],
            ]
        );

    }

    private function getCarOptions()
    {
        $result['all'] = 'All';
        foreach ($this->cars as $car) {
            $result[$car['ID']] = "{$car['Brand']} {$car['Model']}";
        }

        return $result;
    }

    private function getExpenseOptions()
    {
        $result['all'] = 'All';
        foreach ($this->expenses as $expense) {
            $result[$expense['ID']] = $expense['Name'];
        }

        return $result;
    }
}