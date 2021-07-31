@extends('layouts.app')
@section('title', 'Visitor')


@section('main-content')

<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>SL</th>
	  <th>IP</th>
	  <th>Date & Time</th>
	  <th>Visited Id</th>
    </tr>
  </thead>
  <tbody>
	@foreach ($visitor as $visitor)
	    <tr>
	      <th>{{ $loop -> index }}</th>
		  <th>{{ $visitor -> ip_address }}</th>
		  <th>{{ date("F, d, Y, g:i a", strtotime($visitor -> created_at)) }}</th>
		 <th>{{ $visitor -> id }}</th>
	    </tr>
		@endforeach
  </tbody>
</table>

</div>
</div>
</div>

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            // Datatable
            $('#serviecDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
            });

    </script>
@endsection
