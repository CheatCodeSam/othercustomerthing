@extends('adminlte::page')

@section('title', 'Notes')

@section('content_header')
    <h1>Notes</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div>
        <div class="h1">
            Note for {{ $note->equipment->name }}
        </div>
        <dl class="row">
            <dt class="col-sm-3">Service</dt>
            <dd class="col-sm-9">{{ $note->service }}</dd>

            <dt class="col-sm-3">Software</dt>
            <dd class="col-sm-9">
                    {{ $note->software }}

            </dd>
            <dt class="col-sm-3">Content</dt>
            <dd class="col-sm-9">{{ $note->content }}</dd>

        </dl>
    </div>
    <span style="float:right;">
        <a href="{{ route('note.destroy',['note'=>$note->id]) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('submit-form').submit();">
        Delete</a>
        <!-- This is ugly but who even cares anymore -->
        <form id="submit-form" action="{{ route('note.destroy',['note'=>$note->id]) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </span>
  </div>
</div>
@stop