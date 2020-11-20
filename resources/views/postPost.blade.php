@section('additionalInfo')
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<script src="{{ url('/') }}/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
@include('admin.layout.header')
@include('admin.layout.nav')
@include('admin.layout.menu')




@section('buttonDashbord')
<div class="card card-primary justify-content-md-center">
<div class="card-header">
	<h3 class="card-title">General Elements</h3>
</div>
<div class="col-sm-6">
<div class="card-body">
@if ($errors->all())
<div class="alert alert-danger">
@foreach($errors->all() as $error)
  <li>{{ $error }}</li>
@endforeach
</div>
@endif


{{ Form::open(array('url' => '/post', 'method' => 'POST')) }}
    <div class="col-sm-6">
	    <div class="form-group">
	      	{{ Form::label('Technician', 'Technician')  }}
			{{ Form::select('sports[]', $cars,null,['multiple'=>'multiple','id'=>'sports','class' => 'select2 select2-hidden-accessible','data-placeholder' => 'Select a State','style' => 'width: 100%;', 'data-select2-id' => '7', 'aria-hidden' => 'true'])  }}
	    </div>
	</div>

	
	<div class="col-sm-6">
		<div class="form-group">
			<label for="title">Title</label>
			<input class="form-control is-valid" name="title" type="text" id="title">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="desc">Desc</label>
			<input class="form-control is-valid" name="desc" type="text" id="desc">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="date">Date</label>
			<input class="form-control is-valid" name="date" type="text" id="date">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="rate">Rate</label>
			<input class="form-control is-valid" name="rate" type="text" id="rate">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="actor">Actor</label>
			<select class="form-control" name="actor_id">
				<option value="33">Lizzie Murphy</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
		{{ Form::label('actor', 'Actor')  }}
		{{ Form::select('actor_id', App\Models\actor::pluck('name', 'id'),null,['class' => 'form-control'])  }}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
		{{ Form::submit('save' ,array('class' => 'btn btn-info'))  }}
		</div>
	</div>
	
	
{{ Form::close() }}
</div>		
</div>
</div>

@endsection

@include('admin.layout.wrapper')


@section('additionalFooter')
<script src="{{ url('/') }}/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<script>
$('.select2').select2({
      theme: 'bootstrap4'
    })
$('.select3').select2()
</script>

@endsection
@include('admin.layout.footer')