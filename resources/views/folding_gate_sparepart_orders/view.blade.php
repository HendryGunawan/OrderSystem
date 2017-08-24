@extends('master')

@section('content')
<a href="{{ route('folding_gate_sparepart_order') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>View Folding Gate Sparepart Order</h1>
      <form id="folding-gate-sparepart-order-view" method="POST" action="#" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Date">Date</label>
              <input type="hidden" value="<?php echo $parent['id'] ?>" name="id"></input>
              <input name="date" type="text" class="form-control" id="datetimepicker2" maxlength="10" value="<?php echo date('d-m-Y', strtotime($parent['date'])) ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Name</label>
              <input name="name" class="form-control" type="text" maxlength="255" value="<?php echo $parent['name'] ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Address">Address</label>
              <input name="address" class="form-control" type="text" maxlength="255" value="<?php echo $parent['address'] ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Phone">Phone Number</label>
              <input name="phone" class="form-control" type="text" maxlength="255" value="<?php echo $parent['phone_number'] ?>" readonly required></input>
          </div>
          <div class="form-group">
              <label or="Phone">Grand Total</label>
              <input name="grand_total" class="form-control" type="text" maxlength="255" value="<?php echo number_format($parent['grand_total']) ?>" readonly required></input>
          </div>

          <table id="mytable" class="table table-striped">
              <thead>
                  <th>Item Name</th>
                  <th>Price/Unit</th>
                  <th>Unit</th>
                  <th>Qty</th>
                  <th>Size</th>
                  <th>Subtotal</th>
              </thead>
              <tbody>
                  <?php
                  foreach($child as $key => $child_value)
                  {
                    ?>
                    <tr data-id="<?php echo $key ?>">
                      <td>
                          <input type="text" class="form-control" name="order[<?php echo $key ?>][FoldingGateSparepartName]" min="0" value="<?php echo $child_value['ItemName'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="price-<?php echo $key ?>" class="form-control" name="order[<?php echo $key ?>][price]" min="0" value="<?php echo number_format($child_value['price']) ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="unit-<?php echo $key ?>" class="form-control" value="<?php echo $child_value['UnitName'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="fee-3" class="form-control" name="order[<?php echo $key ?>][qty]" value="<?php echo $child_value['qty'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="fee-4" class="form-control" name="order[<?php echo $key ?>][size]" value="<?php echo $child_value['size'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="fee-4" class="form-control" name="order[<?php echo $key ?>][size]" value="<?php echo number_format($child_value['price'] * $child_value['qty'] * $child_value['size']) ?>" readonly>
                      </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
          </table>
      </form>
  </div>
</div>

@endsection
