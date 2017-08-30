@extends('master')

@section('content')
<a href="{{ route('folding_gate_sparepart') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Edit Folding Gate Sparepart Item</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('folding_gate_sparepart_edit_post') }}" role="form">
          {{ csrf_field() }}
          <input name="id" type="hidden" value="{{$content['id']}}"></input>
          <div class="form-group">
              <label or="Nama">Nama Barang</label>
              <input name="name" class="form-control" type="text" maxlength="255" value="{{$content['name']}}" required></input>
          </div>
          <div class="form-group">
              <label for="satuan">Satuan</label>
              <select name="unit_id" class="form-control">
                <?php
                foreach ($option as $value) {
                    if($value['id'] == $content['unit_id'])
                    {
                      echo '<option value="'.$value['id'].'" selected="selected">'.$value['name'].'</option>';
                    }
                    else
                    {
                      echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                    }
                    
                }
                ?>
              </select>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Harga</label>
              <div class="input-container">
                  <input name="price" class="form-control" type="text" maxlength="10" value="{{$content['price']}}" required></input>
              </div>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Simpan</span>
          </button>
      </form>
  </div>
</div>

@endsection