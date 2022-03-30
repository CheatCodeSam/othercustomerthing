<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

use App\Models\Manufacturer;



function getManufacuters() {
    $retVal = array();
    $manufacuters = Manufacturer::where('id' ,'>' ,0)->get();
    foreach($manufacuters as $manufacuter) {
        $retVal[strval($manufacuter["id"])] = strval($manufacuter["name"]);
    }
    return $retVal;
}

class EquipmentForm extends Form
{
    public function buildForm()
    {
        $this->add('name', Field::TEXT, [
            'rules' => 'required',
            'label' => 'Name'
        ])
        ->add('price', Field::NUMBER, [
            'rules' => 'required',
            'label' => 'Price'
        ])
        ->add('ghz', Field::TEXT, [
            'rules' => 'required',
            'label' => 'GHz'
        ])
        ->add('ram', Field::TEXT, [
            'rules' => 'required',
            'label' => 'Ram'
        ])
        ->add('category', Field::SELECT, [
            'rules' => 'required',
            'label' => 'Category',
            'choices' => ['desktop' => "Desktop", 'laptop' => "Laptop", 'tablet' => 'Tablet'],
            'empty_value' => '=== Select Category ==='
        ])
        ->add('manufacturer_id', Field::SELECT, [
            'rules' => 'required',
            'label' => 'Manufacturer',
            'choices' => getManufacuters(),
            'empty_value' => '=== Select Manufacturer ==='
        ])
        ->add('submit', 'submit',[
            'label' => 'Submit'
        ]);
    }
}
