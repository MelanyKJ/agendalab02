@section('title', __('Contactos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-id-card"></i>
							Agenda de Contactos </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fas fa-id-card"></i>  Agregar Contactos
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.contactos.create')
						@include('livewire.contactos.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Edad</th>
								<th>Cumpleaños</th>
								<th>Direccion</th>
								<th>Telefono</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($contactos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->apellido }}</td>
								<td>{{ $row->edad }}</td>
								<td>{{ $row->cumpleaños }}</td>
								<td>{{ $row->direccion }}</td>
								<td>{{ $row->telefono }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>
									<a class="dropdown-item" onclick="confirm('Confirm Delete Contacto id {{$row->id}}? \nDeleted Contactos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
					{{ $contactos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
