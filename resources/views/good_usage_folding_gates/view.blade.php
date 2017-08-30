@extends('master')

@section('content')
<a href="{{ route('good_usage_folding_gate') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
  <h1>Penggunaan Barang Folding Gate</h1>
      <form id="folding-gate-add" method="GET" action="#" role="form">
      <label or="Nama">Nomor Order</label>
      <input class="form-control"
             value="FG-<?php echo $header['folding_gate_order_id'] ?>"
             type="text" readonly>
      <table id="mytable" class="table table-striped">
          <thead>
              <th>Qty</th>
              <th>Nama Barang</th>
              <th>Size</th>
              <th>Satuan</th>
          </thead>
          <tbody>
              <?php
              foreach($content as $key => $child_value)
              {
                ?>
                <tr>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['qty'] ?>" readonly>
                  </td>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['ItemName'] ?>" readonly>
                  </td>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['size'] ?>" readonly>
                  </td>
                  <td>
                      <input type="text" class="form-control" value="<?php echo $child_value['UnitName'] ?>" readonly>
                  </td>
              </tr>
              <?php
                }
              ?>
          </tbody>
      </table>

      Rincian Penggunaan:
      <section class="tabs-section">
        <div role="tabpanel" class="tab-pane" id="realization">
            <br/>
              

              
              <table id="tableRequest" class="table table-striped">
                  <thead> 
                    <div class="row m-t-lg">
                      <div class="col-md-5"><label class="form-label">Kode Barang</label></div>
                      <div class="col-md-5"><label class="form-label">Panjang (meters)</label></div>
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
