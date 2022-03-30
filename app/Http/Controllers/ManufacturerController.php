<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ManufacturerForm;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('manufacturer.list', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(ManufacturerForm::class, [
            'method' => 'POST',
            'url' => route('manufacturer.store')
        ]);
        return view('manufacturer.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(ManufacturerForm::class);
        $form->redirectIfNotValid();
        Manufacturer::create($form->getFieldValues());
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
        $manufacturer = Manufacturer::find($id);
        // Lazy Loading
        return view('manufacturer.detail', compact('manufacturer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,  FormBuilder $formBuilder)
    {
        $manufacturer = Manufacturer::find($id);

        $form = $formBuilder->create(ManufacturerForm::class, [
            'method' => 'PUT',
            'url' => route('manufacturer.update', ['manufacturer'=>$manufacturer->id]),
            'model' => $manufacturer,
        ]);
        return view('manufacturer.create', compact('form'));
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
        $form = $formBuilder->create(ManufacturerForm::class);
        $form->redirectIfNotValid();

        $manufacturer = Manufacturer::find($id);
        $manufacturer->update($form->getFieldValues());

        return redirect('/manufacturer/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manufacturer::destroy($id);
        return redirect('/manufacturer');
    }
}
