@extends('template.plantilla')
@section('content')
	@include('flash::message')
	<title>Editar Conductor | Cercafe</title>
	<div class="panel panel-danger">
		<div class="panel-heading" id="titulo">
			<h4 style="font-size: 25px;" align="center"><i class="fa fa-user" aria-hidden="true"></i> Editar Conductor</h4>
		</div>
		<div class="panel-body">
			{!!Form::open(['route'=> ['admin.conductores.update', $conductor], 'class'=>'form-horizontal', 'method'=>'PUT'])!!}
				<input type="hidden" name="_token" class="form-control" value="{{ csrf_token() }}">
				<div class="form-group">
					{!!Form::label('nombre_conductor', 'Placa: ', ['class'=>'col-lg-4 control-label'])!!}
					<div class="col-lg-4">
						{!!Form::text('nombre_conductor', $conductor->nombre, ['class'=>'form-control', 'placeholder' => '...', 'cols' => '30', 'rows' => '10'])!!}
					</div>
				</div>
				<div class="form-group">
					{!!Form::label('telefono_conductor', 'Capacidad en Ton: ', ['class'=>'col-lg-4 control-label'])!!}
					<div class="col-lg-4">
						{!!Form::text('telefono_conductor', $conductor->telefono, ['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="form-group col-lg-12 col-xs-12">
					<ul class="list-inline" align="center">
						<li><a href="javascript:history.go(-1);" type="button" class="btn btn-danger btn-md">Cancelar</a></li>
						<li>{!!Form::submit('Editar Conductor', array('class'=>'btn btn-info btn-md'))!!}</li>
					</ul>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection