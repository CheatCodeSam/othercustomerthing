<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notes;

use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\NotesForm;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(NotesForm::class, [
            'method' => 'POST',
            'url' => route('note.store')
        ]);

        $equipment = $request->get('equipment', -1);
        $form->modify('equipment_id', "number", [
            'default_value' => $equipment,
        ]);
        return view('note.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(NotesForm::class);
        $form->redirectIfNotValid();
        $note = Notes::create($form->getFieldValues());
        return redirect("equipment/" . $note->equipment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Notes::find($id);
        return view('note.detail', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Notes::find($id);
        $returnId = $note->equipment->id;
        Notes::destroy($id);
        return redirect('/equipment/' . $returnId);
    }
}
