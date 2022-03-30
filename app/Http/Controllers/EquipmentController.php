<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\EquipmentForm;


class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::all();
        return view('equipment.list', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(EquipmentForm::class, [
            'method' => 'POST',
            'url' => route('equipment.store')
        ]);
        return view('equipment.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(EquipmentForm::class);
        $form->redirectIfNotValid();
        Equipment::create($form->getFieldValues());
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::find($id);
        return view('equipment.detail', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $equipment = Equipment::find($id);

        $form = $formBuilder->create(EquipmentForm::class, [
            'method' => 'PUT',
            'url' => route('equipment.update', ['equipment'=>$equipment->id]),
            'model' => $equipment,
        ]);
        return view('equipment.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(EquipmentForm::class);
        $form->redirectIfNotValid();

        $equipment = Equipment::find($id);
        $equipment->update($form->getFieldValues());

        return redirect('/equipment/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipment::destroy($id);
        return redirect('/equipment');
    }
}
