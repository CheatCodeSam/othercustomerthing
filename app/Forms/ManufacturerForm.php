<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;


class ManufacturerForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required',
                'label' => 'Brand Name'
            ])
            ->add('tech_email', Field::EMAIL, [
                'rules' => 'required',
                'label' => 'Tech Support E-Mail'
            ])
            ->add('tech_phone', Field::TEL, [
                'rules' => 'required',
                'label' => 'Tech Support Phone Number'
            ])
            ->add('sales_email', Field::EMAIL, [
                'rules' => 'required',
                'label' => 'Sales Support E-Mail'
            ])
            ->add('sales_phone', Field::TEL, [
                'rules' => 'required',
                'label' => 'Sales Support Phone Number'
            ])
            ->add('submit', 'submit',[
                'label' => 'Submit'
            ]);
    }
}
