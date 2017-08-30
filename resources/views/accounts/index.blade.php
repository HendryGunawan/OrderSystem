@extends('master')

@section('content')
<a href="{{ route('account_add') }}">
   <input type="button" class="btn1" value="Akun Baru" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Akun</h1>
      <table class="table table-bordered" id="account-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
  </div>
</div>    

<script>
$(function() {
    $('#account-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                  url: '{{ route('datatable_account') }}',
              },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'RoleName', name: 'RoleName' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  return '<a class="btn2" href="{{ route('account_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('account_delete') }}?id=' + full.id + '">HAPUS</a>'
                          }}
        ],
        initComplete: function () {
            // drawCallBack();
        }
    });
});
</script>
@endsection