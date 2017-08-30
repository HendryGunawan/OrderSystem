@extends('master')

@section('content')
<a href="{{ route('good_usage_folding_gate') }}">
   <input type="button" class="btn1" value="Kembali" />
</a>

<div class="container">
  <div id="Checkout" class="inline">

      <h1>Hapus Penggunaan Barang Folding Gate</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('good_usage_folding_gate_delete_post') }}" role="form">
      {{ csrf_field() }}
      <input type="hidden" name='id' value="{{$header['id']}}"></input>
      <section class="tabs-section">
        <div role="tabpanel" class="tab-pane" id="realization">
            <br/>
              <label or="Nama">Nomor Pesanan</label>
              <input class="form-control"
                     value="FG-<?php echo $header['folding_gate_order_id'] ?>"
                     type="text" readonly>

              
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
                                       type="text" readonly>
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

          <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
              <span class="align-middle">Hapus</span>
          </button>
      </form>
  </div>
</div>
@endsection
