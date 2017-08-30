@extends('master')

@section('content')
<a href="{{ route('rolling_door') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Hapus Rolling Door Item</h1>
      <form id="rolling_door-delete" method="POST" action="{{ route('rolling_door_delete_post') }}" role="form">
          {{ csrf_field() }}
          <input name="id" type="hidden" value="{{$id}}"></input>
          <div class="form-group">
              <label or="Nama">Nama Barang</label>
              <input name="name" class="form-control" type="text" maxlength="255" value="{{$name}}" readonly></input>
          </div>
          <div class="form-group">
              <label for="satuan">Satuan</label>
              <input name="unit_id" class="null card-image form-control" type="text" value="{{$UnitName}}" readonly></input>
          </div>
          <div class="zip-code-group form-group">
              <label for="satuan">Harga</label>
              <div class="input-container">
                  <input name="price" class="form-control" type="text" maxlength="10" value="{{$price}}" readonly></input>
              </div>
          </div>
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">HAPUS</span>
          </button>
      </form>
  </div>
</div>

@endsection