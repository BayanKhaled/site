<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>DataTables example - Child rows (show extra / detailed information)</title>
	<link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
	<link rel="stylesheet" type="text/css" href="https://datatables.net/media/css/site-examples.css?_=6a23f3bca2453d0655063d05483e97a4">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<style type="text/css" class="init">
	
td.details-control {
	background: url('../resources/details_open.png') no-repeat center center;
	cursor: pointer;
}
tr.shown td.details-control {
	background: url('../resources/details_close.png') no-repeat center center;
}

	</style>
	<script type="text/javascript" src="https://datatables.net/media/js/site.js?_=d58481521385e8ff25e2cf33809b8be4"></script>
	<script type="text/javascript" src="https://datatables.net/media/js/dynamic.php?comments-page=examples%2Fapi%2Frow_details.html" async></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://datatables.net/examples/resources/demo.js"></script>
	<script type="text/javascript" class="init">
	

/* Formatting function for row details - modify as you need */
function format ( d ) {
	// `d` is the original data object for the row
	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
		'<tr>'+
			'<td>Full name:</td>'+
			'<td>'+d.name+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Extension number:</td>'+
			'<td>'+d.extn+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Extra info:</td>'+
			'<td>And any further details here (images etc)...</td>'+
		'</tr>'+
	'</table>';
}

$(document).ready(function() {
	var table = $('#example').DataTable( {
		"ajax": "https://datatables.net/examples/ajax/data/objects.txt",
		"columns": [
			{
				"className":      'details-control',
				"orderable":      false,
				"data":           null,
				"defaultContent": ''
			},
			{ "data": "name" },
			{ "data": "position" },
			{ "data": "office" },
			{ "data": "salary" }
		],
		"order": [[1, 'asc']]
	} );
	
	// Add event listener for opening and closing details
	$('#example tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table.row( tr );

		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			// Open this row
			row.child( format(row.data()) ).show();
			tr.addClass('shown');
		}
	} );
} );


	</script>
</head>
<body class="wide comments example">
	<a name="top" id="top"></a>
	<div class="fw-background">
		<div></div>
	</div>
	<div class="fw-container">
		<div class="fw-header">
			<div class="nav-master">
				<div class="nav-item active">
					<a href="/">DataTables</a>
				</div>
				<div class="nav-item">
					<a href="https://editor.datatables.net">Editor</a>
				</div>
				<div class="nav-item">
					<a href="https://cloudtables.com">CloudTables</a>
				</div>
			</div>
			<div class="nav-search">
				<div class="nav-item i-manual">
					<a href="/manual">Manual</a>
				</div>
				<div class="nav-item i-download">
					<a href="/download">Download</a>
				</div>
				<div class="nav-item i-user">
					<div class="account"></div>
				</div>
				<div class="nav-item search">
					<form action="/q/" method="get">
						<input type="text" name="q" placeholder="Search . . ." autocomplete="off">
					</form>
				</div>
			</div>
		</div>
		<div class="fw-nav">
			<div class="nav-main">
				<ul><li class="sub-active sub"><a href="/examples/index">Examples</a><ul><li class=""><a href="/examples/basic_init">Basic initialisation</a></li><li class=""><a href="/examples/advanced_init">Advanced initialisation</a></li><li class=""><a href="/examples/styling">Styling</a></li><li class=""><a href="/examples/data_sources">Data sources</a></li><li class="active"><a href="/examples/api">API</a></li><li class=""><a href="/examples/ajax">Ajax</a></li><li class=""><a href="/examples/server_side">Server-side</a></li><li class=""><a href="/examples/plug-ins">Plug-ins</a></li></ul></li><li class=" sub"><a href="/manual/index">Manual</a></li><li class=" sub"><a href="/reference/index">Reference</a></li><li class=" sub"><a href="/extensions/index">Extensions</a></li><li class=" sub"><a href="/plug-ins/index">Plug-ins</a></li><li class=""><a href="/blog/index">Blog</a></li><li class=""><a href="/forums/index">Forums</a></li><li class=""><a href="/support/index">Support</a></li><li class=""><a href="/faqs/index">FAQs</a></li><li class=""><a href="/download/index">Download</a></li><li class=""><a href="/purchase/index">Purchase</a></li></ul>
			</div>
			<div class="mobile-show">
				<a><i>Show site navigation</i></a>
			</div>
		</div>
		<div class="fw-body">
			<div class="content">
				<h1 class="page_title">Child rows (show extra / detailed information)</h1>
				<div class="info">
					<p>The DataTables API has a number of methods for attaching child rows to a <em>parent</em> row in the DataTable. This can be used to show additional
					information about a row, useful for cases where you wish to convey more information about a row than there is space for in the host table.</p>
					<p>The example below makes use of the <a href="//datatables.net/reference/api/row().child"><code class="api" title=
					"DataTables API method">row().child</code></a> methods to first check if a row is already displayed, and if so hide it (<a href=
					"//datatables.net/reference/api/row().child.hide()"><code class="api" title="DataTables API method">row().child.hide()</code></a>), otherwise show it (<a href=
					"//datatables.net/reference/api/row().child.show()"><code class="api" title="DataTables API method">row().child.show()</code></a>). The content of the child
					row in this example is defined by the <code>format()</code> function, but you would replace that with whatever content you wanted to show, possibly including,
					for example, <a href="https://www.datatables.net/blog/2017-03-31">an Ajax call to the server</a> to obtain any extra information.</p>
				</div>
				<div class="demo-html">
					<table id="example" class="display" style="width:100%">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Salary</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Salary</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<ul class="tabs">
					<li class="active">Javascript</li>
					<li>HTML</li>
					<li>CSS</li>
					<li>Ajax</li>
					<li>Server-side script</li>
					<li class="comment-count">Comments</li>
				</ul>
				<h2>Other examples</h2>
				<div class="toc">
					<div class="toc-group">
						<h3><a href="../basic_init/index.html">Basic initialisation</a></h3>
						<ul class="toc">
							<li>
								<a href="../basic_init/zero_configuration.html">Zero configuration</a>
							</li>
							<li>
								<a href="../basic_init/filter_only.html">Feature enable / disable</a>
							</li>
							<li>
								<a href="../basic_init/table_sorting.html">Default ordering (sorting)</a>
							</li>
							<li>
								<a href="../basic_init/multi_col_sort.html">Multi-column ordering</a>
							</li>
							<li>
								<a href="../basic_init/multiple_tables.html">Multiple tables</a>
							</li>
							<li>
								<a href="../basic_init/hidden_columns.html">Hidden columns</a>
							</li>
							<li>
								<a href="../basic_init/complex_header.html">Complex headers (rowspan and colspan)</a>
							</li>
							<li>
								<a href="../basic_init/dom.html">DOM positioning</a>
							</li>
							<li>
								<a href="../basic_init/flexible_width.html">Flexible table width</a>
							</li>
							<li>
								<a href="../basic_init/state_save.html">State saving</a>
							</li>
							<li>
								<a href="../basic_init/alt_pagination.html">Alternative pagination</a>
							</li>
							<li>
								<a href="../basic_init/data_rendering.html">Data rendering</a>
							</li>
							<li>
								<a href="../basic_init/scroll_y.html">Scroll - vertical</a>
							</li>
							<li>
								<a href="../basic_init/scroll_y_dynamic.html">Scroll - vertical, dynamic height</a>
							</li>
							<li>
								<a href="../basic_init/scroll_x.html">Scroll - horizontal</a>
							</li>
							<li>
								<a href="../basic_init/scroll_xy.html">Scroll - horizontal and vertical</a>
							</li>
							<li>
								<a href="../basic_init/comma-decimal.html">Language - Comma decimal place</a>
							</li>
							<li>
								<a href="../basic_init/language.html">Language options</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../advanced_init/index.html">Advanced initialisation</a></h3>
						<ul class="toc">
							<li>
								<a href="../advanced_init/events_live.html">DOM / jQuery events</a>
							</li>
							<li>
								<a href="../advanced_init/dt_events.html">DataTables events</a>
							</li>
							<li>
								<a href="../advanced_init/column_render.html">Column rendering</a>
							</li>
							<li>
								<a href="../advanced_init/length_menu.html">Page length options</a>
							</li>
							<li>
								<a href="../advanced_init/dom_multiple_elements.html">Multiple table control elements</a>
							</li>
							<li>
								<a href="../advanced_init/complex_header.html">Complex headers with column visibility</a>
							</li>
							<li>
								<a href="../advanced_init/object_dom_read.html">Read HTML to data objects</a>
							</li>
							<li>
								<a href="../advanced_init/html5-data-attributes.html">HTML5 data-* attributes - cell data</a>
							</li>
							<li>
								<a href="../advanced_init/html5-data-options.html">HTML5 data-* attributes - table options</a>
							</li>
							<li>
								<a href="../advanced_init/language_file.html">Language file</a>
							</li>
							<li>
								<a href="../advanced_init/defaults.html">Setting defaults</a>
							</li>
							<li>
								<a href="../advanced_init/row_callback.html">Row created callback</a>
							</li>
							<li>
								<a href="../advanced_init/row_grouping.html">Row grouping</a>
							</li>
							<li>
								<a href="../advanced_init/footer_callback.html">Footer callback</a>
							</li>
							<li>
								<a href="../advanced_init/dom_toolbar.html">Custom toolbar elements</a>
							</li>
							<li>
								<a href="../advanced_init/sort_direction_control.html">Order direction sequence control</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../styling/index.html">Styling</a></h3>
						<ul class="toc">
							<li>
								<a href="../styling/display.html">Base style</a>
							</li>
							<li>
								<a href="../styling/no-classes.html">Base style - no styling classes</a>
							</li>
							<li>
								<a href="../styling/cell-border.html">Base style - cell borders</a>
							</li>
							<li>
								<a href="../styling/compact.html">Base style - compact</a>
							</li>
							<li>
								<a href="../styling/hover.html">Base style - hover</a>
							</li>
							<li>
								<a href="../styling/order-column.html">Base style - order-column</a>
							</li>
							<li>
								<a href="../styling/row-border.html">Base style - row borders</a>
							</li>
							<li>
								<a href="../styling/stripe.html">Base style - stripe</a>
							</li>
							<li>
								<a href="../styling/bootstrap.html">Bootstrap 3</a>
							</li>
							<li>
								<a href="../styling/bootstrap4.html">Bootstrap 4</a>
							</li>
							<li>
								<a href="../styling/bootstrap5.html">Bootstrap 5 (Preview)</a>
							</li>
							<li>
								<a href="../styling/foundation.html">Foundation</a>
							</li>
							<li>
								<a href="../styling/semanticui.html">Semantic UI</a>
							</li>
							<li>
								<a href="../styling/jqueryUI.html">jQuery UI ThemeRoller</a>
							</li>
							<li>
								<a href="../styling/material.html">Material Design (Tech. preview)</a>
							</li>
							<li>
								<a href="../styling/uikit.html">UIKit 3 (Tech. preview)</a>
							</li>
							<li>
								<a href="../styling/bulma.html">Bulma (Tech. preview)</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../data_sources/index.html">Data sources</a></h3>
						<ul class="toc">
							<li>
								<a href="../data_sources/dom.html">HTML (DOM) sourced data</a>
							</li>
							<li>
								<a href="../data_sources/ajax.html">Ajax sourced data</a>
							</li>
							<li>
								<a href="../data_sources/js_array.html">Javascript sourced data</a>
							</li>
							<li>
								<a href="../data_sources/server_side.html">Server-side processing</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="./index.html">API</a></h3>
						<ul class="toc active">
							<li>
								<a href="./add_row.html">Add rows</a>
							</li>
							<li>
								<a href="./multi_filter.html">Individual column searching (text inputs)</a>
							</li>
							<li>
								<a href="./multi_filter_select.html">Individual column searching (select inputs)</a>
							</li>
							<li>
								<a href="./highlight.html">Highlighting rows and columns</a>
							</li>
							<li class="active">
								<a href="./row_details.html">Child rows (show extra / detailed information)</a>
							</li>
							<li>
								<a href="./select_row.html">Row selection (multiple rows)</a>
							</li>
							<li>
								<a href="./select_single_row.html">Row selection and deletion (single row)</a>
							</li>
							<li>
								<a href="./form.html">Form inputs</a>
							</li>
							<li>
								<a href="./counter_columns.html">Index column</a>
							</li>
							<li>
								<a href="./show_hide.html">Show / hide columns dynamically</a>
							</li>
							<li>
								<a href="./api_in_init.html">Using API in callbacks</a>
							</li>
							<li>
								<a href="./tabs_and_scrolling.html">Scrolling and Bootstrap tabs</a>
							</li>
							<li>
								<a href="./regex.html">Search API (regular expressions)</a>
							</li>
							<li>
								<a href="./highcharts.html">HighCharts Integration</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../ajax/index.html">Ajax</a></h3>
						<ul class="toc">
							<li>
								<a href="../ajax/simple.html">Ajax data source (arrays)</a>
							</li>
							<li>
								<a href="../ajax/objects.html">Ajax data source (objects)</a>
							</li>
							<li>
								<a href="../ajax/deep.html">Nested object data (objects)</a>
							</li>
							<li>
								<a href="../ajax/objects_subarrays.html">Nested object data (arrays)</a>
							</li>
							<li>
								<a href="../ajax/orthogonal-data.html">Orthogonal data</a>
							</li>
							<li>
								<a href="../ajax/null_data_source.html">Generated content for a column</a>
							</li>
							<li>
								<a href="../ajax/custom_data_property.html">Custom data source property</a>
							</li>
							<li>
								<a href="../ajax/custom_data_flat.html">Flat array data source</a>
							</li>
							<li>
								<a href="../ajax/defer_render.html">Deferred rendering for speed</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../server_side/index.html">Server-side</a></h3>
						<ul class="toc">
							<li>
								<a href="../server_side/simple.html">Server-side processing</a>
							</li>
							<li>
								<a href="../server_side/custom_vars.html">Custom HTTP variables</a>
							</li>
							<li>
								<a href="../server_side/post.html">POST data</a>
							</li>
							<li>
								<a href="../server_side/ids.html">Automatic addition of row ID attributes</a>
							</li>
							<li>
								<a href="../server_side/object_data.html">Object data source</a>
							</li>
							<li>
								<a href="../server_side/row_details.html">Row details</a>
							</li>
							<li>
								<a href="../server_side/select_rows.html">Row selection</a>
							</li>
							<li>
								<a href="../server_side/jsonp.html">JSONP data source for remote domains</a>
							</li>
							<li>
								<a href="../server_side/defer_loading.html">Deferred loading of data</a>
							</li>
							<li>
								<a href="../server_side/pipeline.html">Pipelining data to reduce Ajax calls for paging</a>
							</li>
						</ul>
					</div>
					<div class="toc-group">
						<h3><a href="../plug-ins/index.html">Plug-ins</a></h3>
						<ul class="toc">
							<li>
								<a href="../plug-ins/api.html">API plug-in methods</a>
							</li>
							<li>
								<a href="../plug-ins/sorting_auto.html">Ordering plug-ins (with type detection)</a>
							</li>
							<li>
								<a href="../plug-ins/sorting_manual.html">Ordering plug-ins (no type detection)</a>
							</li>
							<li>
								<a href="../plug-ins/range_filtering.html">Custom filtering - range search</a>
							</li>
							<li>
								<a href="../plug-ins/dom_sort.html">Live DOM ordering</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fw-footer">
		<div class="skew"></div>
		<div class="skew-bg"></div>
		<div class="copyright">
			<h4>DataTables</h4>
			<p>DataTables designed and created by <a href="//sprymedia.co.uk">SpryMedia Ltd</a>.<br>
			© 2007-2020 <a href="/license/mit">MIT licensed</a>. <a href="/privacy">Privacy policy</a>. <a href="/supporters">Supporters</a>.<br>
			SpryMedia Ltd is registered in Scotland, company no. SC456502.</p>
		</div>
	</div>
	<script type="text/javascript">
				  var _gaq = _gaq || [];
				  _gaq.push(['_setAccount', 'UA-365466-5']);
				  _gaq.push(['_trackPageview']);

				  (function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				  })();
	</script>
</body>
</html>