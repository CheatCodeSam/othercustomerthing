@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
    <h1>Customer</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div>
        <div class="h1">
            {{ $customer->fullname }}
        </div>
        <dl class="row">
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $customer->email }}</dd>

            <dt class="col-sm-3">Phone Number</dt>
            <dd class="col-sm-9">{{ $customer->phonenumber }}</dd>
        </dl>
    </div>
    <span style="float:right; margin-bottom: 10px">
        <a href="{{ route('customer.edit', ['customer'=>$customer->id]) }} " class="btn btn-warning">Update</a>
        <a href="{{ route('customer.destroy',['customer'=>$customer->id]) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('submit-form').submit();">
        Delete</a>
        <!-- This is ugly but who even cares anymore -->
        <form id="submit-form" action="{{ route('customer.destroy',['customer'=>$customer->id]) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </span>
    <table id="table" class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">ID</th>
          <th>Items</th>
          <th>Total</th>
          <th>Purchase Date</th>
          <th style="width: 40px">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customer->invoices AS $invoice)
        <tr>
          <td>{{ $invoice->id }}</td>
          <td>{{ $invoice->number_of_items() }}</td>
          <td>${{ $invoice->total_price() }}</td>
          <td>{{ $invoice->purchase_date }}</td>
          <td><a class="btn btn-default btn-sm" href="{{ route('invoice.show',['invoice'=>$invoice->id]) }}">View</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop