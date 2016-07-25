@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $lobby->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="list-group">
                @foreach ($state->nations as $nationid => $nationdata)
                @if ($nationid > 4)
                  <a href="#" class="list-group-item col-md-4 {{ trans('serverstate.submitted_'.$nationdata['submitted'].'_class') }}" style="border-radius: 4px;">
                    @if (!empty($nations[$nationid]['flag']))
                     <img src="{{ asset('assets/mods/'.$nations[$nationid]['flag'].'.png') }}" class="pull-left" />
                     @else
                     <img src="/img/flagok.png" class="pull-left" />
                     @endif
                    <h4 class="list-group-item-heading">{{ $signupsById[$nationid]->name or '???' }}</h4>
                    <p class="list-group-item-text"><small>{{ $nationid }}: {{ $nations[$nationid]['name'] }} - {{ trans('games.era_'.$nations[$nationid]['era']) }}</small></p>
                    <p class="list-group-item-text"><small>{{ $nations[$nationid]['epithet'] }}</small></p>
                    <p class="list-group-item-text"><small>{{ trans('serverstate.nationstatus_'.$nationdata['status']) }}&nbsp;{{ trans('serverstate.submitted_'.$nationdata['submitted']) }}&nbsp;{{ trans('serverstate.connected_'.$nationdata['connected']) }}</small></p>
                  </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <br />
    <div class="row">
    	<div class="col-md-12">
    	 @if (Auth::check())
    		    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#signupmodal">
                      Sign up
                    </button>


            <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signuplabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="signuplabel">Sign up</h4>
                  </div>
                  <div class="modal-body">
                  {!! Form::open(['url' => '/games', 'class' => 'form-horizontal']) !!}
                  		<div class="form-group">
			                {!! Form::label('password', trans('lobbies.password'), ['class' => 'col-sm-3 control-label']) !!}
			                <div class="col-sm-6">
			                    {!! Form::text('password', null, ['class' => 'form-control']) !!}
			                </div>
			            </div>
                  	    <div class="form-group">
		                {!! Form::label('nationmod', trans('lobbies.nationmod'), ['class' => 'col-sm-3 control-label']) !!}
			                <div class="col-sm-6">
			                    {!! Form::select('nationmod', [0 => trans('lobbies.nationmod_core')], 1, ['class' => 'form-control']) !!}
			                </div>
		            	</div>
			            <select id="nation-image-picker" class="image-picker show-labels show-html" name="nation">
                        @foreach(Snek\Nation::where('implemented_by', null)->get() as $nation)
                                <option data-nation-epithet="{{ $nation->epithet }}" data-img-src="http://placekitten.com/64/64" value="{{ $nation->nation_id }}">{{ $nation->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  {!! Form::close() !!}
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Sign up</button>
                  </div>
                </div>
              </div>
            </div>
        @endif
    	</div>
    </div>
    <br />
    <div class="row">
    	<div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th>ID.</th><td>{{ $lobby->id }}</td>
                    </tr>
                    <tr><th> {{ trans('lobbies.name') }} </th><td> {{ $lobby->name }} </td></tr><tr><th> {{ trans('lobbies.description') }} </th><td> {{ $lobby->description }} </td></tr><tr><th> {{ trans('lobbies.server_address') }} </th><td> {{ $lobby->server_address }} </td></tr>
                </tbody>
                <tfoot>
                   {{-- <tr>
                        <td colspan="2">
                            <a href="{{ url('lobbies/' . $lobby->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Lobby"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                             {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['lobbies', $lobby->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Lobby',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ));!!}
                            {!! Form::close() !!} 
                        </td>
                    </tr>--}}
                </tfoot>
            </table>
        </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
function populatenations(id)
{
	$.get('/json/lobbies/nations/'+id, '', function (data) {
		$('#nation-image-picker option').remove();  
		var $select = $('#nation-image-picker');
		$.each(data,function(key, nation) 
		{
			if (nation.flag != null && nation.flag.length > 0)
			{
				$select.append('<option data-nation-epithet='+ nation.epithet +' data-img-src="/assets/mods/' + nation.flag + '.png" value=' + nation.nation_id + '>' + nation.name + '</option>');
			}
		    else
		    {
		    	$select.append('<option data-nation-epithet='+ nation.epithet +' data-img-src="http://placekitten.com/64/64" value=' + nation.nation_id + '>' + nation.name + '</option>');
		    }
		});
		$('#nation-image-picker').imagepicker({show_label: true});
	})
}

$.get('/json/lobbies/nationmods', '', function (data) {
	$("#nationmod").select2({
	  minimumResultsForSearch: Infinity,
	  data: $.map(data, function (obj) {
		  obj.text = obj.text || obj.name; // replace name with the property used for the text

		  return obj;
		}),
	  width: '100%'
	}).on('select2:select', function (e) { 
		console.log(e);
		populatenations(e.params.data.id);
	});
}, 'json');


</script>
           <script src="{{ asset('/js/image-picker.min.js') }}"></script>
            <link rel="stylesheet" href="{{ asset('/css/image-picker.css') }}">
            <script>
                $(document).ready(function() {
					$('#nation-image-picker').imagepicker({show_label: true});
                });
            </script>
            <style>
            .overflow-auto {
                max-height: calc(100vh - 210px);
                overflow-y: auto;
            }
    </style>
@endsection