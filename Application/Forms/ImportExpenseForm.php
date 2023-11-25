<?php

namespace Application\Forms;

use Application\Models\CarModel;
use Application\Models\ExpenseModel;
use Application\Models\PartsModel;
use Core\Form\AbstractForm;

class ImportExpenseForm extends AbstractForm
{
    private $userId;
    private $carModel;


    public function __construct(
        $userId = null,
        $expenseTypes = null
    )
    {
        $this->userId = $userId;
        $this->carModel = new CarModel();

        parent::__construct();
    }


    public function init()
    {
        $this->setMethod('post');
        $this->setName('import-expense-form');
        $this->setOptions(
            [
                'classes' => ['expense-form']
            ]
        );

        if (null !== $this->userId) {
            $this->addElement(
                'hidden',
                'user-id',
                ['required' => true],
                $this->userId
            );
        }


        $this->addElement(
            'select',
            'car-import-id',
            [
                'label'     => 'Car:',
                'required'  => true,
                'options'   => $this->getUserCars()
            ]
        );

        $this->addElement(
            'file',
            'csv-file',
            [
                'label'     => false,
                'required'  => true,
                'accept'    => '.csv'
            ]
        );

        $this->addElement(
            'button',
            'submit',
            [
                'label'     => 'Import',
                'required'  => false,
                'classes'   => ['submit'],
            ]
        );
    }


    private function getUserCars()
    {
        $result = [];
        if (null === $this->userId) {
            return ['' => 'Fake car'];
        } else {
            $cars = $this->carModel->listCarsByUserId($this->userId);
        }
        foreach ($cars as $car) {
            $result[$car['ID']] = "{$car['Brand']} {$car['Model']}";
        }

        return $result;
    }

}