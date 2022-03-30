<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;



class InvoiceForm extends Form
{
    public function buildForm()
    {
        $this->
            add('customer_id', Field::NUMBER, [
                'rules' => 'required',
                'label' => 'User ID'
            ])
            ->add('purchase_date', Field::DATE, [
                'rules' => 'required',
                'label' => 'Purchase Date'
            ])
            ->add('submit', 'submit',[
                'label' => 'Submit'
            ]);
    }
}
