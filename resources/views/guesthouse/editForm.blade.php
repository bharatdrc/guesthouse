@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Region</div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => 'updateguesthouse/'.$guesthouse->id,'files' => true,'class'=>'form-horizontal','method'=>'PUT')) }}
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#guesthouse" role="tab" data-toggle="tab">Guesthouse General</a>
                            </li>
                            <li><a href="#appartment" role="tab" data-toggle="tab">Appartments</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="guesthouse">

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Guesthouse name</label>

                                    <div class="col-md-6">

                                        {{ Form::text('name', $guesthouse->name ,array('class'=>'form-control','id'=>'name')) }}

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('sender_name') ? ' has-error' : '' }}">
                                    <label for="sender_name" class="col-md-4 control-label">Guesthouse Admin
                                        name</label>
                                    <div class="col-md-6">

                                        {{ Form::text('sender_name', $guesthouse->sender_name ,array('class'=>'form-control','id'=>'sender_name')) }}

                                        @if ($errors->has('sender_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sender_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('sender_email') ? ' has-error' : '' }}">
                                    <label for="sender_email" class="col-md-4 control-label">Guesthouse Admin
                                        email</label>
                                    <div class="col-md-6">

                                        {{ Form::email('sender_email', $guesthouse->sender_email ,array('class'=>'form-control','id'=>'sender_email')) }}

                                        @if ($errors->has('sender_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sender_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="image" class="col-md-4 control-label">Guesthouse Image</label>
                                    <div class="col-md-6">
                                        @foreach($guesthouse->images as $image)

                                            <img src="{{url('/')}}/imgs/{{$image->image_name}}" width="100px"
                                                 height="100px">
                                        @endforeach
                                        {{ Form::file('image',array('class'=>'form-control','id'=>'image')) }}

                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('gallery') ? ' has-error' : '' }}">
                                    <label for="gallery" class="col-md-4 control-label">Guesthouse gallery</label>
                                    <div class="col-md-6">
                                        @foreach($guesthouse->galleries as $image)

                                            <img src="{{url('/')}}/imgs/{{$image->image_name}}" width="100px"
                                                 height="100px">
                                        @endforeach

                                        {{ Form::file('gallery[]',array('class'=>'form-control','id'=>'gallery','multiple'=>1)) }}

                                        @if ($errors->has('gallery'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gallery') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                    <label for="city_id" class="col-md-4 control-label">City</label>

                                    <div class="col-md-6">
                                        {{ Form::select('city_id',$citiesArray , $guesthouse->city_id, ['class' => 'form-control']) }}

                                        @if ($errors->has('city_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="appartment">
                                @if(Form::old('appartments'))
                                    @foreach(old('appartments') as $key => $val)
                                        <div class="appartmentRow" id="cloned_{{$key}}">

                                            {{ Form::hidden('appartments['.$key.'][appartment_id]', $val['appartment_id']) }}
                                            <div class="form-group{{ $errors->has('appartments.'.$key.'.name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">Apparment name</label>

                                                <div class="col-md-6">

                                                    {{ Form::text('appartments['.$key.'][name]', old('appartments.'.$key.'.name') ,array('class'=>'form-control','id'=>'name')) }}

                                                    @if ($errors->has('appartments.'.$key.'.name'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('appartments.'.$key.'.name') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('appartments.'.$key.'.image') ? ' has-error' : '' }}">
                                                <label for="image" class="col-md-4 control-label">Appartment Image</label>
                                                <div class="col-md-6">

                                                    {{ Form::file('appartments['.$key.'][image]',array('class'=>'form-control','id'=>'image')) }}

                                                    @if ($errors->has('appartments.'.$key.'.image'))
                                                        <span class="help-block">
													<strong>{{ $errors->first('appartments.'.$key.'.image') }}</strong>
												</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('appartments.'.$key.'.gallery') ? ' has-error' : '' }}">
                                                <label for="gallery" class="col-md-4 control-label">Appartment gallery</label>
                                                <div class="col-md-6">

                                                    {{ Form::file('appartments['.$key.'][gallery][]',array('class'=>'form-control','id'=>'gallery','multiple'=>1)) }}

                                                    @if ($errors->has('appartments.'.$key.'.gallery'))
                                                        <span class="help-block">
													<strong>{{ $errors->first('appartments.'.$key.'.gallery') }}</strong>
												</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($guesthouse->appartments as $key => $val)

                                        <div class="appartmentRow" id="cloned_{{$key}}">
                                            {{ Form::hidden('appartments['.$key.'][appartment_id]', $val->id) }}
                                            <div class="form-group{{ $errors->has('appartments.'.$key.'.name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">Apparment name</label>

                                                <div class="col-md-6">

                                                    {{ Form::text('appartments['.$key.'][name]', $val->name ,array('class'=>'form-control','id'=>'name')) }}

                                                    @if ($errors->has('appartments.'.$key.'.name'))
                                                        <span class="help-block">
                                                    <strong>{{ $errors->first('appartments.'.$key.'.name') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('appartments.'.$key.'.image') ? ' has-error' : '' }}">
                                                <label for="image" class="col-md-4 control-label">Appartment Image</label>
                                                <div class="col-md-6">
                                                    @foreach($val->images as $image)

                                                        <img src="{{url('/')}}/imgs/{{$image->image_name}}" width="100px"
                                                             height="100px">
                                                    @endforeach
                                                    {{ Form::file('appartments['.$key.'][image]',array('class'=>'form-control','id'=>'image')) }}

                                                    @if ($errors->has('appartments.'.$key.'.image'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('appartments.'.$key.'.image') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('appartments.'.$key.'.gallery') ? ' has-error' : '' }}">
                                                <label for="gallery" class="col-md-4 control-label">Appartment gallery</label>
                                                <div class="col-md-6">
                                                    @foreach($val->galleries as $image)

                                                        <img src="{{url('/')}}/imgs/{{$image->image_name}}" width="100px"
                                                             height="100px">
                                                    @endforeach
                                                    {{ Form::file('appartments['.$key.'][gallery][]',array('class'=>'form-control','id'=>'gallery','multiple'=>1)) }}

                                                    @if ($errors->has('appartments.'.$key.'.gallery'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('appartments.'.$key.'.gallery') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                    @endforeach
                                @endif
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <a href="javascript:void(0);" id="addMore" class="btn btn-primary">
                                                Add More
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                Add Guesthouse
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $("#addMore").on("click", function () {
            var i = parseInt($(".appartmentRow").last().attr('id').replace('cloned_', ''));

            var newRow = $(".appartmentRow").last().clone().attr('id',"cloned_"+parseInt(i+1));

            newRow.find(':input').val('');
            newRow.find(':input').each(function() {

                $(this).attr('name', $(this).attr('name').replace(i, parseInt(i+1)));
            });

            newRow.insertAfter(".appartmentRow:last");
        });
    </script>
@endsection
