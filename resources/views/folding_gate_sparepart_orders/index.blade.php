@extends('master')

@section('content')
<a href="{{ route('folding_gate_sparepart_order_add') }}">
   <input type="button" class="btn1" value="+ New Order" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Folding Gate Sparepart Orders</h1>
      <table class="table table-bordered" id="folding-gate-sparepart-order-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Name</th>
                <th>Date</th>
                <th>Grand Total</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>    

<script>
$(function() {
    $('#folding-gate-sparepart-order-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_folding_gate_sparepart_order') }}',
              },
        columns: [
            { data: 'order_number', name: 'order_number' },
            { data: 'name', name: 'name' },
            { data: 'order_date', name: 'order_date' },
            { data: 'grand_total', name: 'grand_total' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  <?php
                  if(strtolower(Auth::user()->role->name) == 'super admin')
                  {
                  ?>

                  return '<a class="btn2" href="{{ route('folding_gate_sparepart_order_view') }}?id=' + full.id + '">VIEW</a>\
                          <a class="btn2" href="{{ route('folding_gate_sparepart_order_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('folding_gate_sparepart_order_delete') }}?id=' + full.id + '">DELETE</a>\
                          <a class="btn2" target="_blank" href="{{ route('print_folding_gate_sparepart_order') }}?id=' + full.id + '">PDF</a>'
                          }}
                  <?php
                  }
                  else
                  {
                    ?>
                  return '<a class="btn2" href="{{ route('folding_gate_sparepart_order_view') }}?id=' + full.id + '">VIEW</a>\
                        <a class="btn2" target="_blank" href="{{ route('print_folding_gate_sparepart_order') }}?id=' + full.id + '">PDF</a>'
                        }}

                  <?php
                  }
                  ?>
        ],
        initComplete: function () {
            // drawCallBack();
        }
    });
});
</script>
@endsection