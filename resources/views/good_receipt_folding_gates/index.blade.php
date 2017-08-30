@extends('master')

@section('content')
<a href="{{ route('good_receipt_folding_gate_add') }}">
   <input type="button" class="btn1" value="+ Baru" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Penerimaan Barang Folding Gate</h1>
      <table class="table table-bordered" id="good-receipt-folding-gate-table">
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
    $('#good-receipt-folding-gate-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_good_receipt_folding_gate') }}',
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
                  return '<a class="btn2" href="{{ route('good_receipt_folding_gate_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('good_receipt_folding_gate_delete') }}?id=' + full.id + '">HAPUS</a>'
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