<?php

namespace Application\Forms;

use Application\Models\CarModel;
use Core\Form\AbstractForm;

class CarForm extends AbstractForm
{
    private $carId;
    private $userId;
    private $carModel;

    public function __construct($userId = null, $carId = null)
    {
        $this->userId = $userId;
        $this->carId = $carId;
        $this->carModel = new CarModel();

        parent::__construct();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setName('car-form');
        $this->setClasses(
            ['car-edit-form', 'car-form']
        );

        $this->addElement(
            'hidden',
            'car-user-id',
            [
                'required' => false,
            ]
        );

        $this->addElement(
            'hidden',
            'car-id',
            [
                'required' => false,
            ]
        );

        $this->addElement(
            'text',
            'brand',
            [
                'required' => true,
                'label' => 'Brand: ',
                'placeholder' => 'Wolkswagen'
            ]
        );

        $this->addElement(
            'text',
            'model',
            [
                'required' => true,
                'label' => 'Model: ',
                'placeholder' => 'Golf'
            ]
        );

        $this->addElement(
            'number',
            'year',
            [
                'required' => true,
                'label' => 'Year: ',
                'placeholder' => '2015'
            ]
        );

        $this->addElement(
            'text',
            'color',
            [
                'required' => true,
                'label' => 'Color: ',
                'placeholder' => 'Black'
            ]
        );

        $this->addElement(
            'number',
            'mileage',
            [
                'required' => true,
                'label' => 'Mileage: ',
                'placeholder' => 151000
            ]
        );

        $this->addElement(
            'select',
            'fuel_id1',
            [
                'options' => $this->getFuelOptions(),
                'required' => true,
                'label' => 'Fuel'
            ]
        );

        $this->addElement(
            'select',
            'fuel_id2',
            [
                'options' => $this->getFuelOptions(1),
                'required' => false,
                'label' => 'Secondary Fuel: '
            ]
        );

        $this->addElement(
            'textarea',
            'notes',
            [
                'required' => false,
                'label' => 'Notes',
                'placeholder' => 'Additional notes...'
            ]
        );

        if ($this->_checkEdit()) {
            $this->addElement(
                'hidden',
                'uid',
                [
                    'required' => true,
                ],
                $this->userId
            );

            $this->addElement(
                'hidden',
                'cid',
                [
                    'required' => true,
                ],
                $this->carId
            );
        }

        $this->addElement(
            'button',
            'submit',
            [
                'required' => false,
                'label' => 'Submit:'
            ]
        );
    }

    private function getFuelOptions($secondary = null)
    {
        $fuels = $this->carModel->getFuels($secondary);
        $result = [];
        if (null !== $secondary) {
            $result[''] = 'None';
        }
        foreach ($fuels as $fuel) {
            $result[$fuel['ID']] = $fuel['Name'];
        }
        return $result;
    }

    private function _checkEdit() : bool
    {
        if (!empty($this->userId) && !empty($this->carId)) {
            return true;
        }

        return false;
    }
}