@extends('master')

@section('content')
<a href="{{ route('rolling_door_add') }}">
   <input type="button" class="btn1" value="Baru" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Rolling Door Items</h1>
      <table class="table table-bordered" id="rolling-door-table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga/Satuan</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>    

<script>
$(function() {
    $('#rolling-door-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_rolling_door') }}',
              },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'UnitName', name: 'UnitName' },
            { data: 'price', name: 'price' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  return '<a class="btn2" href="{{ route('rolling_door_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('rolling_door_delete') }}?id=' + full.id + '">HAPUS</a>'
                          }}
        ],
        initComplete: function () {
            // drawCallBack();
        }
    });
});

</script>
@endsection