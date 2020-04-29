<?php

namespace Application\Forms;

use Application\Models\CarModel;
use Application\Models\ExpenseModel;
use Core\Form\AbstractForm;

class DeleteExpenseForm extends AbstractForm
{
    private $expenseId;
    private $year;

    public function __construct($expenseId, $year)
    {
        $this->expenseId = $expenseId;
        $this->year = $year;

        parent::__construct();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setTarget(
            "/expense/remove/id/{$this->expenseId}/year/{$this->year}"
        );

        $this->addElement(
            'hidden',
            'id',
            [
                'required' => true
            ],
            $this->expenseId
        );

        $this->addElement(
            'hidden',
            'year',
            [
                'required' => true
            ],
            $this->year
        );

        $this->addElement(
            'button',
            'submit',
            [
                'required'  => false,
                'label'     => 'Yes'
            ]
        );

        $this->addElement(
            'button',
            'cancel',
            [
                'required'  => false,
                'label'     => 'No',
                'onclick'   => 'window.location=\'/statistics\''
            ]
        );
    }

}