@extends('master')

@section('content')
<a href="{{ route('good_receipt_rolling_door_add') }}">
   <input type="button" class="btn1" value="+ Baru" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Penerimaan Barang Rolling Door</h1>
      <table class="table table-bordered" id="good-receipt-rolling-door-table">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tebal (mm)</th>
                <th>Lebar (mm)</th>
                <th>Berat (Kg)</th>
                <th>Panjang (m)</th>
                <th>Tanggal Dibuat</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>    

<script>
$(function() {
    $('#good-receipt-rolling-door-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_good_receipt_rolling_door') }}',
              },
        columns: [
            { data: 'item_code', name: 'item_code' },
            { data: 'name', name: 'name' },
            { data: 'thick', name: 'thick' },
            { data: 'width', name: 'width' },
            { data: 'weight', name: 'weight' },
            { data: 'length', name: 'length' },
            { data: 'date_created', name: 'date_created' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  <?php
                  if(strtolower(Auth::user()->role->name) == 'super admin')
                  {
                  ?>
                  return '<a class="btn2" href="{{ route('good_receipt_rolling_door_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('good_receipt_rolling_door_delete') }}?id=' + full.id + '">HAPUS</a>'
                  <?php
                  }
                  else
                  {
                  ?>
                    return '-';
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