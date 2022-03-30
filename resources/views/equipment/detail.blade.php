@extends('adminlte::page')

@section('title', 'Equipment')

@section('content_header')
    <h1>Equipment</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div>
        <div class="h1">
            {{ $equipment->name }}
        </div>
        <dl class="row">
            <dt class="col-sm-3">Price</dt>
            <dd class="col-sm-9">${{ $equipment->price }}</dd>

            <dt class="col-sm-3">Manufacturer</dt>
            <dd class="col-sm-9">
                <a href="{{ route('manufacturer.show',['manufacturer'=>$equipment->manufacturer->id]) }}">
                    {{ $equipment->manufacturer->name }}
                </a>
            </dd>

            <dt class="col-sm-3">GHz</dt>
            <dd class="col-sm-9">{{ $equipment->ghz }}</dd>

            <dt class="col-sm-3">Ram</dt>
            <dd class="col-sm-9">{{ $equipment->ram }}</dd>

            <dt class="col-sm-3">Category</dt>
            <dd class="col-sm-9">{{ ucwords($equipment->category) }}</dd>
        </dl>
    </div>
    <span style="float:right; margin-bottom: 10px;">
        <a href="{{ route('note.create')}}?equipment={{$equipment->id}} " class="btn btn-primary">Create Note</a>
        <a href="{{ route('equipment.edit', ['equipment'=>$equipment->id]) }} " class="btn btn-warning">Update</a>
        <a href="{{ route('equipment.destroy',['equipment'=>$equipment->id]) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('submit-form').submit();">
        Delete</a>
        <!-- This is ugly but who even cares anymore -->
        <form id="submit-form" action="{{ route('equipment.destroy',['equipment'=>$equipment->id]) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </span>

    <table id="table" class="table table-bordered" style=" margin-bottom:10px;">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Service</th>
          <th>Software</th>
          <th>Content</th>
          <th style="width: 150px">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($equipment->notes AS $note)
        <tr>
            <td>{{ $note->id }}</td>
            <td>{{ $note->service }}</td>
            <td>{{ $note->software }}</td>
            <td>{{ $note->content }}</td>

            <td>
                <span>
                <a class="btn btn-default btn-sm" href="{{ route('note.show',['note'=>$note->id]) }}">View</a>
                <a class="btn btn-danger btn-sm"  href="{{ route('note.destroy',['note'=>$note->id]) }}" onclick="event.preventDefault(); document.getElementById('note-submit-{!! $note->id !!}').submit();">Delete</a>


                <form id="note-submit-{{ $note->id }}" action="{{ route('note.destroy',['note'=>$note->id]) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                </span>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>


  </div>
</div>
@stop