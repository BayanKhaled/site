<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel DataTables Editor</title>
        <!-- Bootstrap CSS -->
        <!--
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
		-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('css/editor.bootstrap.css')}}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
        <script src="{{asset('js/dataTables.editor.js')}}"></script>

        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

        <script src="{{asset('js/editor.bootstrap.min.js')}}"></script>
    </head>
    <body>
        <div class="container">
           {{$dataTable->table(['id' => 'actor'])}}	
         {{--    {{$dataTable->table()}}	--}}
        </div>

        
           <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
			<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
			<script src="/vendor/datatables/buttons.server-side.js"></script>
			
			<script>
				$(function() {
	                $.ajaxSetup({
	                    headers: {
	                        'X-CSRF-TOKEN': '{{csrf_token()}}'
	                    }
	                });

	                var editor = new $.fn.dataTable.Editor({
	                    ajax: "/actor",
	                    table: "#actor",
	                    display: "bootstrap",
	                    fields: [
	                        // {label: "Id:", name: "id"},
	                        {label: "Name:", name: "name"},
	                        {label: "Email:", name: "email"},
	                    ]
	                });

	                $('#actor').on('click', 'tbody td:not(:first-child)', function (e) {
	                    editor.inline(this);
	                });
	                {{$dataTable->generateScripts()}}

	            })
			</script> 
			{{-- {!! $dataTable->scripts() !!} --}}

			

    </body>

    {{-- --}}
</html>