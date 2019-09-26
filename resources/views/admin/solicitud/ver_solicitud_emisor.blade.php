@extends('template.plantilla')
@section('content')
		<div class="container" >
			<meta charset="utf-8">
			<title>Mi Solicitud | Cercafe</title>
			@include('flash::message') 
			
			<div class="row">
				<div class="col-md-12">
					<h3 style="color: #df0101;"> <strong> {{$solicitud->id}} - {{$solicitud->asunto}} </strong> </h3>
				</div>
			
				<div class="col-md-4">
					@if($estados->nombre_estado == 'En Tramite')
						<strong>Estado:</strong> <strong class="text-primary">{{$estados->nombre_estado}}</strong>
					@elseif($estados->nombre_estado == 'Tramitado')
						<strong>Estado:</strong> <strong style="color: #8BC34A;">{{$estados->nombre_estado}}</strong>
					@elseif($estados->nombre_estado == 'No Tramitado')
						<strong>Estado:</strong> <strong class="text-danger">{{$estados->nombre_estado}}</strong>
					@endif
				</div>	
				<div class="col-md-4">
					@if($solicitud->prioridad == '1')
						<strong>Prioridad:</strong> <span style="color: brown;">Baja</span>

						@elseif($solicitud->prioridad == '2')
							<strong>Prioridad:</strong> <span style="color: #2E9AFE;"><strong>Normal</strong></span>
						@elseif($solicitud->prioridad == '3')
							<strong>Prioridad:</strong> <span style="color: green;"><strong>Media</strong></span>
						@elseif($solicitud->prioridad == '4')
							<strong>Prioridad:</strong> <span style="color: orange;"><strong>Alta</strong></span>
						@elseif($solicitud->prioridad == '5')
							<strong>Prioridad:</strong> <span style="color: red;"><strong>Urgente</strong></span>				
					@endif
				</div>
				<div class="col-md-4">
					<strong>Fecha:</strong> <strong class="text-danger">{{$solicitud->fecha_envio}}</strong>
				</div>	
				<br>
				<br>
				<div class="col-md-12">
					<strong>Descripcion:</strong> {{$solicitud->descripcion_solicitud}}
				</div>	
				
				<div class="col-md-12">				
					@if($solicitud->path != null)
						<a href="{{ route('admin.solicitudes.downloadAdjunto', $solicitud->path) }}" class="btn btn-danger">
							<span> 
								<strong>Descargar Adjunto</strong>
							</span>
						</a>
					@endif
				</div> 
			
				<div class="col-md-12">	
					{!!Form::open(['route'=> 'admin.contesta.store','class'=>'form-horizontal', 'method'=>'POST','style'=>'background: #fafafa;'])!!}
						<fieldset>
							<input type="hidden" name="_token" class="form-control" value="{{ csrf_token() }}">
							
							{!!Form::hidden('solicitud_id', $solicitud->id, ['class'=>'form-control', 'placeholder' => '...', 'required', 'readonly'])!!}

							{!!Form::hidden('asunto_respuesta', $solicitud->asunto, ['class'=>'form-control', 'placeholder' => '...', 'required', 'readonly'])!!}

							@foreach($agentes as $agente)
									@if($agente->email == $solicitud->agente)
										<div class="col-md-4"> 
											{!!Form::hidden('para_agente', $agente->email, ['class'=>'form-control', 'placeholder' => '...', 'required', 'readonly'])!!}
										</div>
									@endif
							@endforeach

							{!!Form::hidden('redactor', Auth::User()->nombre_completo, ['class'=>'form-control', 'placeholder' => '...', 'required', 'readonly'])!!}
							
							{!!Form::hidden('fecha_redaccion',$date, ['class'=>'form-control', 'readonly'])!!}

							<br>
							{!!Form::textarea('descripcion_respuesta', null, ['class'=>'form-control', 'placeholder' => '...', 'required', 'style' => 'margin-bottom: 1em;'])!!}

							@if($estados->nombre_estado == 'Tramitado')
								<div class="col-md-12 control-label">
									
									<a href="javascript:history.go(-1);" class="btn btn-info">Regresar</a><br/><br/>
								</div>
							@elseif($estados->nombre_estado == 'No Tramitado')
								
									<a href="javascript:history.go(-1);" class="btn btn-info">Regresar</a><br/><br/>
								</div>
							@else
								<div class="col-md-12 control-label">
									{!!Form::submit('Contestar', array('class'=>'btn btn-success'))!!}
									<a href="javascript:history.go(-1);" class="btn btn-info">Regresar</a><br/><br/>
								</div>
							@endif
						</fieldset>
					{!! Form::close() !!}
				</div>
		
				<div class="col-md-12">
					<legend><span style="color: #df0101; font-size:25px;">Historial de Respuestas:</span></legend>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-responsive">
								<thead style="background-color: #df0101;">
									<tr  style="color: white;">
										<th>solicitud #</th>
										<th>id</th>
										<th>Usuario</th>
										<th>Fecha de redacción</th>
										<th>Descripción</th>
									</tr>
								</thead> 
								<tbody>
									@foreach($respuestas as $respuesta)
										@if($solicitud->id == $respuesta->solicitud_id)
											<tr>
												<td>{{ $respuesta->solicitud_id }}</td>
												<td>{{ $respuesta->id }}</td>
												@if($respuesta->redactor == Auth::User()->nombre_completo)
													<td><strong class="text-primary">{{ $respuesta->redactor }}</strong></td>
												@else
													<td><strong>{{ $respuesta->redactor }}</strong></td>
												@endif
												<td>{{ $respuesta->fecha_redaccion }}</td>
												<td>
													{!!Form::textarea('descripcion_respuesta', $respuesta->descripcion_respuesta, ['class'=>'form-control', 'style'=>'height:80px;', 'readonly'])!!}
												</td>
											</tr>
										@endif
									@endforeach
								</tbody>
							</table>
						</div>		
					</div>
				</div>
			</div>
@endsection