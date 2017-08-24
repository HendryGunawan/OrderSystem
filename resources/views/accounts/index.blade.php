@extends('master')

@section('content')
<a href="{{ route('account_add') }}">
   <input type="button" class="btn1" value="New Account" />
</a>

<div class="container">
   @include('flash::message')
  <div id="Checkout" class="inline">

      <h1>Accounts</h1>
      <table class="table table-bordered" id="account-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
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
            { data: 'role', name: 'role' },
            {
                field: 'operate',
                align: 'center',
                mRender: function (data, type, full) {
                  return '<a class="btn2" href="{{ route('account_edit') }}?id=' + full.id + '">EDIT</a>\
                          <a class="btn2" href="{{ route('account_delete') }}?id=' + full.id + '">DELETE</a>'
                          }}
        ],
        initComplete: function () {
            // drawCallBack();
        }
    });
});
</script>
@endsection