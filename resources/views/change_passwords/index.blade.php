@extends('master')

@section('content')

<div class="container">
@include('flash::message')
  <div id="Checkout" class="inline">
      <h1>Ganti Password</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('change_password_save') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Nama">Password Lama</label>
              <input name="OldPassword" class="form-control" type="password" maxlength="255"></input>
          </div>
          <div class="form-group">
              <label or="Nama">Password Baru</label>
              <input name="NewPassword" class="form-control" type="password" maxlength="255"></input>
          </div>
          <div class="form-group">
              <label or="Nama">Konfirmasi Password Baru</label>
              <input name="ConfirmNewPassword" class="form-control" type="password" maxlength="255"></input>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Simpan</span>
          </button>
      </form>
  </div>
</div>

@endsection