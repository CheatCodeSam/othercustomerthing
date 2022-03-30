<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\CustomerForm;



class CustomerController extends Controller
{
    /**
     * List View
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.list', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CustomerForm::class, [
            'method' => 'POST',
            'url' => route('customer.store')
        ]);
        return view('customer.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CustomerForm::class);
        $form->redirectIfNotValid();
        Customer::create($form->getFieldValues());
        return $this->index();
    }

    /**
     * Detail View
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        // Lazy Loading
        $customer->invoices;
        return view('customer.detail', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $customer = Customer::find($id);

        $form = $formBuilder->create(CustomerForm::class, [
            'method' => 'PUT',
            'url' => route('customer.update', ['customer'=>$customer->id]),
            'model' => $customer,
        ]);
        return view('customer.create', compact('form'));
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
        $form = $formBuilder->create(CustomerForm::class);
        $form->redirectIfNotValid();

        $customer = Customer::find($id);
        $customer->update($form->getFieldValues());

        return redirect('/customer/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect('/customer');
    }
}
