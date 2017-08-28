@extends('master')

@section('content')
<a href="{{ route('good_usage_select_order_number_folding_gate') }}">
   <input type="button" class="btn1" value="+ New" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Good Usage Folding Gate Items</h1>
      <table class="table table-bordered" id="good-usage-folding-gate-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>    

<script>
$(function() {
    $('#good-usage-folding-gate-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_good_usage_folding_gate') }}',
              },
        columns: [
            { data: 'order_number', name: 'item_code' },
            { data: 'created', name: 'created' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  <?php
                  if(strtolower(Auth::user()->role->name) == 'super admin')
                  {
                  ?>
                  return '<a class="btn2" href="{{ route('good_usage_folding_gate_view') }}?id=' + full.id + '">VIEW</a>\
                          <a class="btn2" href="{{ route('good_usage_folding_gate_delete') }}?id=' + full.id + '">DELETE</a>\
                          <a class="btn2" target="_blank" href="{{ route('print_good_usage_folding_gate') }}?id=' + full.id + '">PDF</a>'
                  <?php
                  }
                  else
                  {
                  ?>
                    return '<a class="btn2" href="{{ route('good_usage_folding_gate_view') }}?id=' + full.id + '">VIEW</a>';
                  <?php
                  }
                  ?>  
            }}
        ],
        initComplete: function () {
            // drawCallBack();
        }
    });
});
</script>
@endsection