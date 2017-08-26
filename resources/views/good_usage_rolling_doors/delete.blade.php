@extends('master')

@section('content')
<a href="{{ route('good_usage_rolling_door') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">

      <h1>Delete Good Usage Rolling Door Item</h1>
      <form id="rolling-door-delete" method="POST" action="{{ route('good_usage_rolling_door_delete_post') }}" role="form">
      {{ csrf_field() }}
      <input type="hidden" name='id' value="{{$header['id']}}"></input>
      <section class="tabs-section">
        <div role="tabpanel" class="tab-pane" id="realization">
            <br/>
              <label or="Nama">Order Number</label>
              <input class="form-control"
                     value="FG-<?php echo $header['rolling_door_order_id'] ?>"
                     type="text" readonly>

              
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
              <span class="align-middle">Delete</span>
          </button>
      </form>
  </div>
</div>
@endsection
