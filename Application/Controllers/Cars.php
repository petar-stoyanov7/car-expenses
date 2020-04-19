<?php

namespace Application\Controllers;

use Application\Forms\CarForm;
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
        $form = new CarForm();
        $form->setTarget('/cars/add/uid/'.$userId);
        $form->setMethod('post');
        $form->setClasses('edit-car');
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
            'title' => 'Добави автомобил',
            'form'  => $form
        ];
        View::render('cars/add-car.php', $viewParams);
    }

    public function editAction($params)
    {
        if (isset($params['cid'])) {
            $carId = $params['cid'];
            $userId = $this->carModel->getUserIdByCarId($carId);
            $form = new CarForm($userId, $carId);
            $form->setClasses('edit-car');
            $form->setTarget('/cars/edit/cid/'.$carId);
            $car = $this->carModel->getCarById($carId);
            $formValues = [
                'brand'     => $car['Brand'],
                'model'     => $car['Model'],
                'year'      => $car['Year'],
                'color'     => $car['Color'],
                'mileage'   => $car['Mileage'],
                'fuel_id1'  => $car['Fuel_ID'],
                'fuel_id2'  => $car['Fuel_ID2'],
                'notes'     => $car['Notes']
            ];
            $form->populate($formValues);

            if (!empty($_POST)) {

                $car_edit = new Car(
                    $userId,
                    $_POST['brand'],
                    $_POST['model'],
                    $_POST['year'],
                    $_POST['color'],
                    $_POST['mileage'],
                    $_POST['fuel_id1'],
                    $_POST['fuel_id2'],
                    $_POST['notes']
                );
                $this->carModel->editCar($car_edit, $car['ID']);
                
                display_warning("Промените са направени успешно!");
                header("refresh:1;url=/account/profile");
            }

            $viewParams = [
                'form'      => $form,
                'title'     => 'Edit car'
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

    public function listUserCarsAction()
    {
        if (isset($_POST['userid'])) {
            $result = [];
            $cars = $this->carModel->listCarsByUserId($_POST['userid']);
            foreach ($cars as $car) {
                $result[
                    $car['ID']] = [
                        'brand' => $car['Brand'],
                        'model' => $car['Model'],
                        'year' => $car['Year'],
                        'color' => $car['Color'],
                        'fuels' => [
                            $car['Fuel_ID'],
                            $car['Fuel_ID2']
                        ],
                        'mileage' => $car['Mileage']
                ];
            }
            echo json_encode($result);
            die();
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