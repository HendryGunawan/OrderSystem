@extends('master')

@section('content')
<a href="{{ route('good_receipt_folding_gate') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Hapus Penerimaan Barang Folding Gate</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('good_receipt_folding_gate_delete_post') }}" role="form">
      {{ csrf_field() }}
          <div class="zip-code-group form-group">
              <label for="satuan">Nama Barang</label>
              <input type="hidden" name="id" value="{{$id}}" readonly></input>
              <div class="input-container">
                  <input name="item_id" class="form-control" type="text" value="{{$name}}" readonly></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Tebal (mm)</label>
              <div class="input-container">
                  <input name="thick" class="form-control" type="text" value="{{rtrim(rtrim(number_format($thick, 10, ".", ","), '0'), '.')}}" readonly></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Lebar (mm)</label>
              <div class="input-container">
                  <input name="width" class="form-control" type="text" value="{{rtrim(rtrim(number_format($width, 10, ".", ","), '0'), '.')}}" readonly></input>
              </div>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Berat (Kg)</label>
              <div class="input-container">
                  <input name="weight" class="form-control" type="text" value="{{rtrim(rtrim(number_format($weight, 10, ".", ","), '0'), '.')}}" readonly></input>
              </div>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Hapus</span>
          </button>
      </form>
  </div>
</div>

@endsection