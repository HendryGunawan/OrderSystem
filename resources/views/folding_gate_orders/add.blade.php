@extends('master')

@section('content')
<a href="{{ route('folding_gate_order') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Add Folding Gate Order</h1>
      <form id="folding-gate-order-add" method="POST" action="{{ route('folding_gate_order_add_post') }}" role="form">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Date">Date</label>
              <input name="date" type="text" class="form-control" id="datetimepicker2" maxlength="10" required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Name</label>
              <input name="name" class="form-control" type="text" maxlength="255" required></input>
          </div>
          <div class="form-group">
              <label or="Address">Address</label>
              <input name="address" class="form-control" type="text" maxlength="255" required></input>
          </div>
          <div class="form-group">
              <label or="Phone">Phone Number</label>
              <input name="phone" class="form-control" type="text" maxlength="255" required></input>
          </div>

          <table id="mytable" class="table table-striped">
              <thead>
                  <th>Item Name</th>
                  <th>Price/Unit</th>
                  <th>Unit</th>
                  <th>Qty</th>
                  <th>Size</th>
              </thead>
              <tbody>
                  <?php
                  for($i=1;$i<=12;$i++)
                  {
                    ?>
                    <tr data-id="<?php echo $i ?>">
                      <td>
                          <select name="order[<?php echo $i ?>][folding_gate_id]" class="form-control" onclick="checkprice(this)">
                              <option value="" selected="selected"></option>
                              <?php
                                foreach ($option as $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                }
                              ?>
                          </select>
                      </td>
                      <td>
                          <input type="number" id="price-<?php echo $i ?>" class="form-control" name="order[<?php echo $i ?>][price]" min="0">
                      </td>
                      <td>
                          <input type="text" id="unit-<?php echo $i ?>" class="form-control" readonly>
                      </td>
                      <td>
                          <input type="text" id="fee-3" class="form-control" name="order[<?php echo $i ?>][qty]">
                      </td>
                      <td>
                          <input type="text" id="fee-4" class="form-control" name="order[<?php echo $i ?>][size]">
                      </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
          </table>
        
          
          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Submit</span>
          </button>
      </form>
  </div>
</div>


<script>

function checkprice(row)
{
    var rownumber = row.parentNode.parentNode.getAttribute('data-id');
    var pricecomponent = "price-" + rownumber;
    var unitcomponent = "unit-" + rownumber;
    $.ajax({
        url: '{{ route("folding_gate_price") }}?id='+row.value,
        method: 'GET',
        dataType: 'JSON',
        // context: document.body,
        success: function(data){
          document.getElementById(pricecomponent).value=data.value;
          document.getElementById(unitcomponent).value=data.units;
          document.getElementById(pricecomponent).setAttribute('min', data.value);
        }
    });

}

$('#datetimepicker2').datetimepicker({ format: 'DD-MM-YYYY' });
</script>

@endsection
