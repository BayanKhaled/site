@include('admin.layout.header')
@include('admin.layout.nav')
@include('admin.layout.menu')


@section('title')
{{$title}}
@endsection
@section('content')
<div class="card">
	<div class="card-header">
	<h3 class="card-title">DataTable For Admins</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
{!! $dataTable->table([
		'class' => 'table table-bordered table-striped dataTable dtr-inline'
	]) !!}

</div> 
</div> 



@endsection

@push('js')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush

@include('admin.layout.wrapper')
@include('admin.layout.footer')
