@extends('master')

@section('content')
<a href="{{ route('account') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Hapus Akun</h1>
      <form id="account-edit" method="POST" action="{{ route('account_delete_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <input type="hidden" name="id" value="<?php echo $data['id']; ?> "></input>
              <label or="Nama">Nama</label>
              <input name="name" class="form-control" type="text" maxlength="255" value="<?php echo $data['name']; ?>" readonly></input>
          </div>
          <div class="form-group">
              <label or="Nama">Username</label>
              <input name="email" class="form-control" type="text" maxlength="255" value="<?php echo $data['email']; ?>" readonly></input>
          </div>
          <div class="form-group">
              <label for="satuan">Hak Akses</label>
              <input name="role_id" class="form-control" type="text" maxlength="255" value="<?php echo $data['RoleName']; ?>" readonly></input>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Hapus</span>
          </button>
      </form>
  </div>
</div>

@endsection