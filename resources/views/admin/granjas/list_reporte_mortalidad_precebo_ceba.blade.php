@extends('template.plantilla')
@section('content')
	@include('flash::message')
	<title>Mortalidad | Cercafe</title>
	<div class="panel panel-default">
		<div class="panel-heading" id="titulo">
			<h4 style="font-size: 25px;"><i class="fa fa-list-alt" aria-hidden="true"></i> Reportes de Mortalidad</h4>
		</div>
		<br>
		<div class="container-fluid col-lg-12">
			{!!Form::open(['route'=> 'admin.filterMortalidadPreceboCeba.store', 'class'=>'form-inline', 'method'=>'POST'])!!}
				<h1>Filtrar Informacion:</h1>
				<div class="form-group">
					<input type="hidden" name="_token" class="form-control" value="{{ csrf_token() }}"> 
					<select name="granja" class="form-control" id="granja"> 
						@if(Auth::User()->rol_id == 7)
							<option value="">Seleccione Granja</option>
							@foreach($granjas as $granja)
								<option value="{{$granja->id}}">{{$granja->nombre_granja}}</option>	
							@endforeach
						@else
							<option value="">Seleccione Granja</option>
							@foreach($g_as as $g)
								@if($g->user_id == Auth::User()->id)
									@foreach($granjas as $granja)
										@if($g->granja_id == $granja->id)
											<option value="{{$granja->id}}">{{$granja->nombre_granja}}</option>
										@endif
									@endforeach
								@endif
							@endforeach
						@endif
					</select>
				</div>
				<div class="form-group">
					{!!Form::text('lote',null, ['class'=>'form-control', 'placeholder' => 'Ingrese el Lote'])!!}
				</div>
				<div class="form-group">
					{!!Form::text('fecha_desde_precebo',null, ['id' => 'date_picker_desde', 'class'=>'form-control', 'readonly', 'required', 'style' => 'cursor: pointer !important;', 'placeholder' => 'Desde'])!!}
				</div>
				<div class="form-group">
					{!!Form::text('fecha_hasta_precebo',null, ['id' => 'date_picker_hasta', 'class'=>'form-control', 'readonly', 'required', 'style' => 'cursor: pointer !important;', 'placeholder' => 'Hasta'])!!}
				</div>
				<div class="form-group">
					{!!Form::submit('Filtrar', array('class'=>'btn btn-success'))!!}
				</div>
				<div class="form-group pull-right">
					<a href="javascript:history.go(-1);" class="btn btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a>
					@if(Auth::User()->rol_id == 7)
						<a href="/intranetcercafe/public/admin/excelMortalidad" class="btn btn-success"><i>{!!Html::image('c.png','us',array('class' => 'imuser'))!!} </i> Exportar</a>
					@endif
				</div> 
			{!! Form::close() !!}
		</div>
		<div class="panel-body table-responsive">
			<table id="data_list" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
				<thead> 
					<tr style="color: white;">
						<td><strong>Acción</strong></td>
						<td><strong>Lote</strong></td>
						<td><strong>Granja</strong></td>
						<td><strong>Fecha</strong></td>
						<td><strong>Sexo del Porcino</strong></td>
						<td><strong>Posible Causa</strong></td>
					</tr>
				</thead>
				<tbody>
					@if(Auth::User()->rol_id == 7)
						@foreach($reportes as $reporte)
							<tr>
								<td>
									<a href="{{ route('admin.reporteMortalidad.destroy', $reporte->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Lote"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									<a href="{{ route('admin.reporteMortalidad.show', $reporte->id) }}" class="btn btn-default boton_ojo" data-toggle="tooltip" data-placement="top" title="Ver Información Adicional"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
								<td><strong>{{$reporte->lote}}</strong></td>
								<td>{{$reporte->nombre_granja}}</td>
								<td>{{$reporte->fecha}}</td>
								<td>{{$reporte->sexo_cerdo}}</td>
								<td>{{$reporte->causa}}</td>
							</tr>	
						@endforeach
					@else
						@foreach($g_as as $g)
							@if($g->user_id == Auth::User()->id)
								@foreach($reportes as $reporte)
									@if($g->granja_id == $reporte->granja_id)
										@foreach($granjas as $grs)
											@if($reporte->nombre_granja == $grs->nombre_granja)
												<tr>
													<td>
														<a href="{{ route('admin.reporteMortalidad.destroy', $reporte->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Lote"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														
														<a href="{{ route('admin.reporteMortalidad.show', $reporte->id) }}" class="btn btn-default boton_ojo" data-toggle="tooltip" data-placement="top" title="Ver Información Adicional"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
													</td>
													<td><strong>{{$reporte->lote}}</strong></td>
													<td>{{$reporte->nombre_granja}}</td>
													<td>{{$reporte->fecha}}</td>
													<td>{{$reporte->sexo_cerdo}}</td>
													<td>{{$reporte->causa}}</td>
												</tr>
											@endif
										@endforeach
									@endif
								@endforeach
							@endif
						@endforeach
					@endif
				</tbody>
			</table>			
		</div>
	</div>
@endsection