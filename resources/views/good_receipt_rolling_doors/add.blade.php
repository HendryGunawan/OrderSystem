@extends('master')

@section('content')
<a href="{{ route('good_receipt_rolling_door') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Tambah Penerimaan Barang Rolling Door</h1>
      <form id="rolling-door-add" method="POST" action="{{ route('good_receipt_rolling_door_add_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Nama">Nama Barang</label>
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
              <label for="satuan">Tebal (mm)</label>
              <div class="input-container">
                  <input name="thick" class="form-control" type="text" required></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Lebar (mm)</label>
              <div class="input-container">
                  <input name="width" class="form-control" type="text" required></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Berat (Kg)</label>
              <div class="input-container">
                  <input name="weight" class="form-control" type="text" required></input>
              </div>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Simpan</span>
          </button>
      </form>
  </div>
</div>

@endsection