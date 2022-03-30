<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Equipment;

use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\InvoiceForm;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.list', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(InvoiceForm::class, [
            'method' => 'POST',
            'url' => route('invoice.store'),
        ]);
        $user = $request->get('user', 0);
        $form->modify('customer_id', "number", [
            'default_value' => $user,
        ]);
        
        return view('invoice.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(InvoiceForm::class);
        $form->redirectIfNotValid();
        $invoice = Invoice::create($form->getFieldValues());
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
        $invoice = Invoice::find($id);
        return view('invoice.detail', compact('invoice'));
    }


    public function deleteItem($invoiceID, $itemID) {

        $invoice = Invoice::find($invoiceID);

        $invoice->equipments()->detach($itemID);

        return redirect('/invoice/' . $invoiceID);
    }

    public function addItem($invoiceID, $itemID) {
        $invoice = Invoice::find($invoiceID);

        $invoice->equipments()->attach($itemID);

        return redirect('/invoice/' . $invoiceID);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $invoice = Invoice::find($id);

        $form = $formBuilder->create(InvoiceForm::class, [
            'method' => 'PUT',
            'url' => route('invoice.update', ['invoice'=>$invoice->id]),
            'model' => $invoice,
        ]);
        return view('invoice.create', compact('form'));
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
        $form = $formBuilder->create(InvoiceForm::class);
        $form->redirectIfNotValid();

        $invoice = Invoice::find($id);
        $invoice->update($form->getFieldValues());

        return redirect('/invoice/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::destroy($id);
        return redirect('/invoice');
    }
}
