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
        $title = "Добави автомобил";
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
            $this->carModel->add_car($car);
            display_warning("Автомобилът е добавен успешно!");
            header("refresh:1;url=/account/profile");
        }

        $viewParams = [
            'fuelList' => $this->getFuelOptions(),
        ];
        View::render('add-car.php', $viewParams);
    }

    public function editAction($params)
    {
        if (isset($params['cid'])) {
            $carId = $params['cid'];
            $car = $this->carModel->get_car_by_id($carId);
            if (!empty($_POST)) {
                $userId = $this->carModel->get_uid_by_cid($carId);
                $values = nullify($_POST);
                $car_edit = new Car($userId,$car['Brand'],$car['Model'],$car['Year'],$values['color'],$values['mileage'],$car['Fuel_ID'],$values['fuel_id2'],$values['notes']);
                $this->carModel->edit_car($car_edit, $car['ID']);
                
                display_warning("Промените са направени успешно!");
                header("refresh:1;url=/account/profile");
            }

            $viewParams = [
                'car'       => $car,
                'fuelList'  => $this->getFuelOptions(),
            ];
            View::render('edit-car.php', $viewParams);
        } else {
            header('Location: /account/profile');
        }
    }

    public function deleteAction($params)
    {
        $title = "Изтриване на автомобил";
        if (isset($params['cid'])) {
            $carId = isset($params['cid']) ? $params['cid']  : NULL;
            $car = $this->carModel->get_car_by_id($carId);
            if (isset($_POST['id']) && (isset($_POST['choice']) && $_POST['choice'] === 'yes')) {
                $this->carModel->remove_car_by_id($_POST['id']);
                header("Location: /account/profile");
            }
            $viewParams = [
                'car'   => $car,
                'carId' => $carId,
            ];
            View::render('delete-car.php', $viewParams);
        } else {
            header('Location: /account/profile');
        }
    }

    private function getFuelOptions()
    {
        if (!empty($uid)) {
            $fuel_list = $this->carModel->get_user_fuel_types($uid);
        } else {
            $fuel_list = $this->carModel->get_fuels();
        }
        return $fuel_list;
    }
}