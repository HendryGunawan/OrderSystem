@extends('master')

@section('content')
<a href="{{ route('account') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Add Account</h1>
      <form id="account-add" method="POST" action="{{ route('account_add_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Nama">Name</label>
              <input name="name" class="form-control" type="text" maxlength="255" required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Username</label>
              <input name="email" class="form-control" type="text" maxlength="255" required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Password</label>
              <input name="password" class="form-control" type="password" maxlength="255" required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Confirm Password</label>
              <input name="password_confirm" class="form-control" type="password" maxlength="255" required></input>
          </div>
          <div class="form-group">
              <label for="satuan">Role</label>
              <select name="role_id" class="form-control">
                <?php
                foreach ($option as $value) {
                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
                ?>
              </select>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Submit</span>
          </button>
      </form>
  </div>
</div>

@endsection