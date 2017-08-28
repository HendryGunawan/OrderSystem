@extends('master')

@section('content')
<a href="{{ route('folding_gate_order') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <h1>Edit Folding Gate Order</h1>
      <form id="folding-gate-order-edit" method="POST" action="{{ route('folding_gate_order_edit_post') }}" role="form" onsubmit="return checkform();">
      {{ csrf_field() }}
          <div class="form-group">
              <label or="Date">Date</label>
              <input type="hidden" value="<?php echo $parent['id'] ?>" name="id"></input>
              <input name="date" type="text" class="form-control" id="datetimepicker2" maxlength="10" value="<?php echo date('d-m-Y', strtotime($parent['date'])) ?>"  required></input>
          </div>
          <div class="form-group">
              <label or="Nama">Name</label>
              <input name="name" class="form-control" type="text" maxlength="255" value="<?php echo $parent['name'] ?>"  required></input>
          </div>
          <div class="form-group">
              <label or="Address">Address</label>
              <input name="address" class="form-control" type="text" maxlength="255" value="<?php echo $parent['address'] ?>"  required></input>
          </div>
          <div class="form-group">
              <label or="Phone">Phone Number</label>
              <input name="phone" class="form-control phone-number" type="text" maxlength="255" value="<?php echo $parent['phone_number'] ?>" required></input>
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
                  foreach($child as $key => $child_value)
                  {
                    ?>
                    <tr data-id="<?php echo $key ?>">
                      <td>
                          <select name="order[<?php echo $key ?>][folding_gate_id]" class="form-control ItemName" onclick="checkprice(this)" <?php echo $key==0? 'required':''?>>
                              <option value=""></option>
                              <?php
                                foreach ($option as $value) 
                                {
                                    if($child_value['folding_gate_id'] == $value['id'])
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
                      </td>
                      <td>
                          <input type="number" id="price-<?php echo $key ?>" class="form-control" name="order[<?php echo $key ?>][price]" min="<?php echo $child_value['MinPrice'] ?>" value="<?php echo $child_value['price'] ?>"  <?php echo $key==0? 'required':''?>>
                      </td>
                      <td>
                          <input type="text" id="unit-<?php echo $key ?>" class="form-control" value="<?php echo $child_value['UnitName'] ?>" readonly>
                      </td>
                      <td>
                          <input type="text" id="fee-3" class="form-control" name="order[<?php echo $key ?>][qty]" value="<?php echo $child_value['qty'] ?>" <?php echo $key==0? 'required':''?>>
                      </td>
                      <td>
                          <input type="text" id="fee-4" class="form-control" name="order[<?php echo $key ?>][size]" value="<?php echo $child_value['size'] ?>" <?php echo $key==0? 'required':''?>>
                      </td>
                  </tr>
                  <?php
                    }
                  ?>
                  <?php
                  for($i=count($child)+1;$i<=12;$i++)
                  {
                    ?>
                    <tr data-id="<?php echo $i ?>">
                      <td>
                          <select name="order[<?php echo $i ?>][folding_gate_id]" class="form-control ItemName" onclick="checkprice(this)">
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
function checkform()
{
  var data = document.getElementsByClassName("ItemName");
  var array_check = new Array();

  for (var i = 0, len = data.length; i < len; i++) 
  {
    if(data[i].value == '')
    {
      continue;
    }
    if($.inArray(data[i].value, array_check) != -1)
    {
      alert('Duplicate data found. Please check again before submit');
      return false;
    }
    else
    {
      array_check.push(data[i].value);
    }
    
  }
  return true;
}

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

$(".phone-number").keydown(function (e) {
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    return false;
  }
});
</script>

@endsection
