@extends('master')

@section('content')
<a href="{{ route('folding_gate') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Add Folding Gate Item</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('folding_gate_add_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Nama">Nama Barang</label>
              <input name="name" class="form-control" type="text" maxlength="255"></input>
          </div>
          <div class="form-group">
              <label for="satuan">Satuan</label>
              <select name="unit_id" class="form-control">
                <?php
                foreach ($option as $value) {
                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
                ?>
              </select>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Harga Satuan</label>
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