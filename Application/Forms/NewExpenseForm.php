<?php

namespace Application\Forms;

use Application\Models\CarModel;
use Application\Models\ExpenseModel;
use Application\Models\PartsModel;
use Core\Form\AbstractForm;

class NewExpenseForm extends AbstractForm
{
    private $userId;
    private $expenseTypes;
    private $carModel;

    public function __construct(
        $userId = null,
        $expenseTypes = null
    )
    {
        $this->userId = $userId;
        if (null !== $expenseTypes) {
            $this->expenseTypes = $expenseTypes;
        } else {
            $expenseModel = new ExpenseModel();
            $this->expenseTypes = $expenseModel->getExpenses();
        }
        $this->carModel = new CarModel();

        parent::__construct();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setName('new-expense-form');
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
            'car-id',
            [
                'label'     => 'Car:',
                'required'  => true,
                'options'   => $this->getUserCars()
            ]
        );

        $this->addElement(
            'select',
            'expense-type',
            [
                'label'     => 'Expense type: ',
                'required'  => true,
                'options'   => $this->getExpenseOptions()
            ]
        );

        $this->addElement(
            'select',
            'fuel-type',
            [
                'label'     => 'Fuel type: ',
                'required'  => false,
                'options'   => $this->getFuelTypes(),
                'classes'   => 'optional-select'
            ]
        );

        $this->addElement(
            'select',
            'insurance-type',
            [
                'label'     => 'Insurance Type: ',
                'required'  => false,
                'options'   => $this->getInsuranceTypes(),
                'classes'   => 'optional-select'
            ]
        );

        $this->addElement(
            'select',
            'insurance-type',
            [
                'label'     => 'Insurance Type: ',
                'required'  => false,
                'options'   => $this->getInsuranceTypes(),
                'classes'   => 'optional-select'
            ]
        );

        $this->addElement(
            'text',
            'part-name',
            [
                'label'         => 'Parts list: ',
                'required'      => false,
                'placeholder'   => 'part1, part2, part3',
                'classes'       => 'optional-select',
            ]
        );

        $this->addElement(
            'multiselect',
            'replacement-part-name',
            [
                'label'     => 'Replacing parts: ',
                'required'  => false,
                'classes'   => 'optional-select',
                'options'   => $this->getUserParts()
            ]
        );

        $this->addElement(
            'date',
            'date',
            [
                'label'     => 'Date:',
                'required'  => true,
            ],
            date('Y-m-d')
        );

        $this->addElement(
            'number',
            'mileage',
            [
                'label'     => 'Mileage',
                'required'  => true
            ],
            $this->getDefaultMileage()
        );

        $this->addElement(
            'number',
            'liters',
            [
                'label'         => 'Liters',
                'required'      => false,
                'placeholder'   => 'Liters of fuel',
                'classes'       => 'optional-select'
            ]
        );

        $this->addElement(
            'number',
            'value',
            [
                'label'         => 'Value:',
                'required'      => true,
                'placeholder'   => 'Value of the expense'
            ]
        );

        $this->addElement(
            'textarea',
            'description',
            [
                'required'      => false,
                'placeholder'   => 'Additional info'
            ]
        );

        $this->addElement(
            'button',
            'submit',
            [
                'label'     => 'Add expense',
                'required'  => false,
                'classes'   => ['submit'],
            ]
        );
    }

    private function getExpenseOptions()
    {
        return $this->_normalize($this->expenseTypes);
    }

    private function getFuelTypes()
    {
        $fuelTypes = $this->carModel->getFuels();
        return $this->_normalize($fuelTypes);
    }

    private function getInsuranceTypes()
    {
        $expenseModel = new ExpenseModel();
        return $this->_normalize($expenseModel->getInsuranceList());
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

    /**
     * ugly hack. The real Mileage will be moded in JS with AJAX requests
     * @return mixed|null
     */
    private function getDefaultMileage()
    {
        if (null !== $this->userId) {
            $firstCar = $this->carModel->listCarsByUserId($this->userId)[0]['ID'];

            $result = $this->carModel->getMileageByCarId($firstCar);
            return $result[0]['Mileage'];
        }
        return null;
    }

    private function getUserParts()
    {
        $result = [];
        if (empty($this->userId)) {
            $result = [0 => 'None'];
        } else {
            $partsModel = new PartsModel();
            $parts = $partsModel->getPartsByUserId($this->userId);
            foreach ($parts as $part) {
                $result[$part['ID']] = $part['Name'];
            }
            $result[0] = 'None';
        }
        return $result;
    }

    private function _normalize($dbArray)
    {
        $result = [];
        foreach ($dbArray as $element)
        {
            $result[$element['ID']] = $element['Name'];
        }
        return $result;
    }

}