@extends('master')

@section('content')
<a href="{{ route('good_usage_rolling_door') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
    <h1>View Good Usage Rolling Door Item</h1>
      <form id="rolling-door-view" method="GET" action="#" role="form">
      <label or="Nama">Order Number</label>
      <input class="form-control"
             value="FG-<?php echo $header['rolling_door_order_id'] ?>"
             type="text" readonly>
      <table id="mytable" class="table table-striped">
          <thead>
              <th>Item Name</th>
              <th>Unit</th>
              <th>Qty</th>
              <th>Size</th>
          </thead>
          <tbody>
              <?php
              foreach($content as $key => $child_value)
              {
                ?>
                <tr>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['ItemName'] ?>" readonly>
                  </td>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['UnitName'] ?>" readonly>
                  </td>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['qty'] ?>" readonly>
                  </td>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['size'] ?>" readonly>
                  </td>
              </tr>
              <?php
                }
              ?>
          </tbody>
      </table>

      Detail Usage:
      <section class="tabs-section">
        <div role="tabpanel" class="tab-pane" id="realization">
            <br/>              
              <table id="tableRequest" class="table table-striped">
                  <thead> 
                    <div class="row m-t-lg">
                      <div class="col-md-5"><label class="form-label">Item Code</label></div>
                      <div class="col-md-5"><label class="form-label">Length (meters)</label></div>
                    </div>
                  </thead>
                  <tbody>
                      <div class="detail">
                      <?php
                      foreach($child as $child_value)
                      {?>
                      <div class="row m-t-lg rows form_tmpl">
                        <div class="col-md-5">
                          <div class="form-group">
                            <div class="form-control-wrapper">
                              <input class="form-control"
                                     value="<?php echo $child_value['item_code'] ?>"
                                     type="text" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <div class="form-control-wrapper">
                              <input class="form-control"
                                     value="<?php echo $child_value['length'] ?>"
                                     type="text" required readonly>
                            </div>
                          </div>
                        </div>
                      </div>
                        <?php
                        }
                        ?>
                      </div>
                  </tbody>
                  
              </table>
        </div>
      </section>
      </form>
  </div>
</div>
@endsection
