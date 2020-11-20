@include('admin.layout.header')
@include('admin.layout.nav')
@include('admin.layout.menu')



@section('content')
<div class="card">
	<div class="card-header">
	<h3 class="card-title">DataTable For Admins</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
{!! $html->table(
		['class' => 'table table-bordered'], true
) !!}

</div> 
</div> 
@endsection

@push('js')
    {!! $html->scripts() !!}
@endpush


@include('admin.layout.wrapper')
@include('admin.layout.footer')
