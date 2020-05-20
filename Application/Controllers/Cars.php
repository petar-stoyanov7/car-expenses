<?php

namespace Application\Controllers;

use Application\Forms\CarForm;
use Application\Models\PartsModel;
use \Core\View;
use \Application\Models\StatisticsModel;
use \Application\Models\CarModel;
use \Application\Classes\Car;
use \Application\Models\ExpenseModel;

class Cars
{
    private $carModel;

    public function __construct()
    {
        $this->carModel = new CarModel();
    }
    
    public function indexAction()
    {
        header('Location: /');
    }

    public function processAction()
    {
        if (!empty($_POST)) {
            $data = nullify($_POST);
            $Car = new Car(
                $data['user-id'],
                $data['brand'],
                $data['model'],
                $data['year'],
                $data['color'],
                $data['mileage'],
                $data['fuel_id1'],
                $data['fuel_id2'],
                $data['notes']
            );
            if (!empty($_POST['car-id'])) {
                $this->carModel->editCar($Car, $_POST['car-id']);
                $modifiedCar = $this->carModel->getCarById($data['car-id']);
                echo json_encode(
                    [
                        'success'   => true,
                        'car'       => $modifiedCar
                    ]
                );
            } else {
                $newId = $this->carModel->addCar($Car);
                $newCar = $this->carModel->getCarById($newId);
                echo json_encode(
                    [
                        'success'   => true,
                        'car'       => $newCar
                    ]
                );
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function deleteAction($params)
    {
        $response = [];
        if (isset($_POST['car-id'])) {
            $carId = $_POST['car-id'];
            if (isset($_POST['delete-expenses']) && (int)$_POST['delete-expenses'] === 1) {
                $expenseModel = new ExpenseModel();
                $expenseModel->removeCarExpenses($carId);
            }
            $partsModel = new PartsModel();
            $partsModel->removeByCarId($carId);
            $this->carModel->removeCarById($carId);
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        echo json_encode($response);
        die();
    }

    public function listUserCarsAction()
    {
        if (isset($_POST['userid'])) {
            $result = [];
            $cars = $this->carModel->listCarsByUserId($_POST['userid']);
            foreach ($cars as $car) {
                $result[$car['ID']] = $car;
            }
            echo json_encode($result);
            die();
        }
    }
}