@extends('master')

@section('content')
<a href="{{ route('good_receipt_folding_gate') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Add Good Receipt Folding Gate Item</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('good_receipt_folding_gate_add_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Nama">Item Name</label>
              <select name="item_id" class="form-control" required>
                <option value""></option>
                <?php
                foreach ($option as $value) {
                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
                ?>
              </select>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Thick (mm)</label>
              <div class="input-container">
                  <input name="thick" class="form-control" type="text" required></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Width (mm)</label>
              <div class="input-container">
                  <input name="width" class="form-control" type="text" required></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Weight (Kg)</label>
              <div class="input-container">
                  <input name="weight" class="form-control" type="text" required></input>
              </div>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Submit</span>
          </button>
      </form>
  </div>
</div>

@endsection