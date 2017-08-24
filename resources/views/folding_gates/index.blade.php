@extends('master')

@section('content')
<a href="{{ route('folding_gate_add') }}">
   <input type="button" class="btn1" value="+ New Item" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Folding Gate Items</h1>
      <table class="table table-bordered" id="folding-gate-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Unit</th>
                <th>Price/Unit</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>    

<script>
$(function() {
    $('#folding-gate-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_folding_gate') }}',
              },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'UnitName', name: 'UnitName' },
            { data: 'price', name: 'price' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  return '<a class="btn2" href="{{ route('folding_gate_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('folding_gate_delete') }}?id=' + full.id + '">DELETE</a>'
                          }}
        ],
        initComplete: function () {
            // drawCallBack();
        }
    });
});
</script>
@endsection