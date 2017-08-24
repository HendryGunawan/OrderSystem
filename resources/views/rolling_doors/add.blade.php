@extends('master')

@section('content')
<a href="{{ route('rolling_door') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Add Rolling Door Item</h1>
      <form id="rolling_door-add" method="POST" action="{{ route('rolling_door_add_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Nama">Item Name</label>
              <input name="name" class="form-control" type="text" maxlength="255"></input>
          </div>
          <div class="form-group">
              <label for="satuan">Unit</label>
              <select name="unit_id" class="form-control">
                <?php
                foreach ($option as $value) {
                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
                ?>
              </select>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Price</label>
              <div class="input-container">
                  <input name="price" class="form-control" type="text" maxlength="10"></input>
              </div>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Submit</span>
          </button>
      </form>
  </div>
</div>

@endsection