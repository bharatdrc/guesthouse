@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">List Guesthouse</div>
				<div class="panel-body">

			   @if(count($guesthouses)>0)
				<table class="table table-striped task-table">

						<!-- Table Headings -->
						<thead>
							<th>Guesthouse</th>
							<th>City</th>
							<th>Image</th>
							<th>Gallery</th>
							<th>&nbsp;</th>
						</thead>

						<!-- Table Body -->
						<tbody>
							@foreach($guesthouses as $guesthouse)
								<tr>
									<td class="table-text">
										<div>
											{{$guesthouse->name}}
										</div>
									</td>
									<td class="table-text">
										<div>
											{{$guesthouse->city->name}}
										</div>
									</td>
									<td class="table-text">
										<div>
										@foreach($guesthouse->images as $image)

											<img src="{{url('/')}}/imgs/{{$image->image_name}}" width="100px" height="100px" >
										@endforeach
										</div>
									</td>
									<td class="table-text">
										<div>
										@foreach($guesthouse->galleries as $image)

											<img src="{{url('/')}}/imgs/{{$image->image_name}}" width="100px" height="100px" >
										@endforeach
										</div>
									</td>
									<td class="text-right">
										 <form action="{{ url('guesthouseeditedit/'.$guesthouse->id) }}" method="GET">
											{!! csrf_field() !!}
											
											<button type="submit" class="btn btn-danger">
												<i class="fa fa-trash"></i> Edit
											</button>

										 </form>
										 <form action="{{ url('guesthouse/'.$guesthouse->id) }}" method="POST">
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
