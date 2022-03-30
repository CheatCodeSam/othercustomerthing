<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class CustomerForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('fullname', Field::TEXT, [
                'rules' => 'required',
                'label' => 'Full Name'
            ])
            ->add('phonenumber', Field::TEXT, [
                'rules' => 'required|max:12',
                'label' => 'Phone Number'
            ])
            ->add('email', Field::TEXT, [
                'rules' => 'required',
                'label' => 'E-Mail'
            ])
            ->add('submit', 'submit',[
                'label' => 'Submit'
            ]);
    }
}
