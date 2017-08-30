@extends('master')

@section('content')
<a href="{{ route('folding_gate_sparepart_order') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Hapus Pesanan Folding Gate Sparepart</h1>
      <form id="folding-gate-sparepart-order-add" method="POST" action="{{ route('folding_gate_sparepart_order_delete_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Date">Tanggal</label>
              <input type="hidden" value="<?php echo $parent['id'] ?>" name="id"></input>
              <input name="date" type="text" class="form-control" id="datetimepicker2" maxlength="10" value="<?php echo date('d-m-Y', strtotime($parent['date'])) ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Nama</label>
              <input name="name" class="form-control" type="text" maxlength="255" value="<?php echo $parent['name'] ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Address">Alamat</label>
              <input name="address" class="form-control" type="text" maxlength="255" value="<?php echo $parent['address'] ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Phone">Nomor Telepon</label>
              <input name="phone" class="form-control" type="text" maxlength="255" value="<?php echo $parent['phone_number'] ?>" readonly required></input>
          </div>

          <table id="mytable" class="table table-striped">
              <thead>
                  <th>Qty</th>
                  <th>Nama Barang</th>
                  <th>Harga/Satuan</th>
                  <th>Size</th>
                  <th>Satuan</th>
              </thead>
              <tbody>
                  <?php
                  foreach($child as $key => $child_value)
                  {
                    ?>
                    <tr data-id="<?php echo $key ?>">
                      <td>
                          <input type="text" id="fee-3" class="form-control" name="order[<?php echo $key ?>][qty]" value="<?php echo $child_value['qty'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" class="form-control" name="order[<?php echo $key ?>][FoldingGateSparepartName]" min="0" value="<?php echo $child_value['ItemName'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="price-<?php echo $key ?>" class="form-control" name="order[<?php echo $key ?>][price]" min="0" value="<?php echo $child_value['price'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="fee-4" class="form-control" name="order[<?php echo $key ?>][size]" value="<?php echo $child_value['size'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="unit-<?php echo $key ?>" class="form-control" value="<?php echo $child_value['UnitName'] ?>" readonly>
                      </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
          </table>
        
          
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">HAPUS</span>
          </button>
      </form>
  </div>
</div>

@endsection
