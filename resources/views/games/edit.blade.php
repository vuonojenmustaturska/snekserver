@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $game->name }}</h1>

    {!! Form::model($game, [
        'method' => 'PATCH',
        'url' => ['/games', $game->id],
        'class' => 'form-horizontal'
    ]) !!}

            <div class="form-group {{ $errors->has('masterpw') ? 'has-error' : ''}}">
                {!! Form::label('masterpw', trans('games.masterpw'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('masterpw', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('masterpw', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('hours') ? 'has-error' : ''}}">
                {!! Form::label('hours', trans('games.hours'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('hours', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('hours', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection