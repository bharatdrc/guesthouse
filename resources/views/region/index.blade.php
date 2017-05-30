@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">List Region</div>
				<div class="panel-body">

			   @if(count($regions)>0)
				<table class="table table-striped task-table">

						<!-- Table Headings -->
						<thead>
							<th>Region</th>
							<th>&nbsp;</th>
						</thead>

						<!-- Table Body -->
						<tbody>
							@foreach($regions as $region)
								<tr>
									<td class="table-text">
										<div>
											{{$region->name}}
										</div>
									</td>
									<td class="text-right">
										 <form action="{{ url('regionedit/'.$region->id) }}" method="GET">
											{!! csrf_field() !!}
											
											<button type="submit" class="btn btn-danger">
												<i class="fa fa-trash"></i> Edit
											</button>

										 </form>
										 <form action="{{ url('region/'.$region->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="btn btn-danger">
												<i class="fa fa-trash"></i> Delete
											</button>

										 </form>
									</td>
									
								</tr>

							@endforeach

						</tbody>
				  </table>
					
			   @endif
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
