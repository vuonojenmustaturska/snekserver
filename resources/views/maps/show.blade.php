@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $map->name }}</h1>
        <div class="row">
    <div class="table-responsive col-md-8">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th><td>{{ $map->id }}</td>
                </tr>
                <tr><th> {{ trans('maps.name') }} </th><td> {{ $map->name }} </td></tr><tr><th> {{ trans('maps.description') }} </th><td> {{ $map->description }} </td></tr><tr><th> {{ trans('maps.filename') }} </th><td> {{ $map->filename }} </td></tr>
                <tr><th> {{ trans('maps.provinces') }} </th><td> {{ $map->provinces }} </td><tr><th> {{ trans('maps.uploaded_by') }} </th><td> {{ $map->user->name }} </td></tr><tr></tr></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('maps/' . $map->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Map"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['maps', $map->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Map',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-4">
           <img src="{{ asset('/img/maps/'.$map->id.'-lg.png') }}" width="400" height="400" class="img-thumbnail"/>
    </div>
    </div>

</div>
@endsection