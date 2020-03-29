<?php

namespace Application\Controllers;

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

    public function addAction($params)
    {
        if (!empty($params['uid'])) {
            $userId = $params['uid'];
        } else {
            $userId = $_SESSION['user']['ID'];
        }
        if (!empty($_POST)) {
            $values = nullify($_POST);
            $car = new Car(
                $userId, 
                $values['brand'], 
                $values['model'], 
                $values['year'], 
                $values['color'], 
                $values['mileage'], 
                $values['fuel_id1'], 
                $values['fuel_id2'],
                $values['notes']
            );
            $this->carModel->addCar($car);
            display_warning("Автомобилът е добавен успешно!");
            header("refresh:1;url=/account/profile");
        }

        $viewParams = [
            'title'     => 'Добави автомобил',
            'fuelList'  => $this->getFuelOptions(),
            'fuelList2' => $this->getFuelOptions(true),
        ];
        View::render('cars/add-car.php', $viewParams);
    }

    public function editAction($params)
    {
        if (isset($params['cid'])) {
            $carId = $params['cid'];
            print_r($car);
            if (!empty($_POST)) {
                $userId = $this->carModel->getUserIdByCarId($carId);
                $values = nullify($_POST);
                $car_edit = new Car($userId,$car['Brand'],$car['Model'],$car['Year'],$values['color'],$values['mileage'],$car['Fuel_ID'],$values['fuel_id2'],$values['notes']);
                $this->carModel->editCar($car_edit, $car['ID']);
                
                display_warning("Промените са направени успешно!");
                header("refresh:1;url=/account/profile");
            }

            $viewParams = [
                'title'     => 'Редакция',
                'car'       => $car,
                'fuelList'  => $this->getFuelOptions(true),
            ];
            View::render('cars/edit-car.php', $viewParams);
        } else {
            header('Location: /account/profile');
        }
    }

    public function deleteAction($params)
    {
        if (isset($params['cid'])) {
            $carId = isset($params['cid']) ? $params['cid']  : NULL;
            $car = $this->carModel->getCarById($carId);
            if (isset($_POST['id']) && (isset($_POST['choice']) && $_POST['choice'] === 'yes')) {
                $this->carModel->removeCarById($_POST['id']);
                header("Location: /account/profile");
            }
            $viewParams = [
                'title' => "Изтриване на автомобил",
                'car'   => $car,
                'carId' => $carId,
            ];
            View::render('cars/delete-car.php', $viewParams);
        } else {
            header('Location: /account/profile');
        }
    }

    public function listCarsAction($params)
    {
        if (isset($params['user_id'])) {
            $viewParams = [
                'title'     => '',
                'carModel'  => $this->carModel,
                'userId'    => $params['user_id']
            ];

            View::render('cars/list-cars.php', $viewParams);
        } else {
            header('Location: /');
        }
    }

    private function getFuelOptions($secondary = null)
    {
        if (!empty($uid)) {
            $fuel_list = $this->carModel->getUserFuelTypes($uid, $secondary);
        } else {
            $fuel_list = $this->carModel->getFuels($secondary);
        }
        return $fuel_list;
    }
}