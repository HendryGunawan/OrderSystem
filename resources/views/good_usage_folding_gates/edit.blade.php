@extends('master')

@section('content')
<a href="{{ route('good_usage_folding_gate') }}">
   <input type="button" class="btn1" value="Back" />
</a>

<div class="container">
  <div id="Checkout" class="inline">
      <label or="Nama">Order Number</label>
              <input class="form-control"
                     value="FG-<?php echo $header['folding_gate_order_id'] ?>"
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

     @include('good_usage_folding_gates.template')

      <h1>Edit Good Usage Folding Gate Item</h1>
      <form id="folding-gate-add" method="POST" action="{{ route('good_usage_folding_gate_edit_post') }}" role="form">
      {{ csrf_field() }}
      <input type="hidden" name='folding_gate_order_id' value={{ $header['id'] }}></input>
      <section class="tabs-section">
        <div role="tabpanel" class="tab-pane" id="realization">
            <a href="#" class="btn btn-inline btn-primary btn-sm btn-add" data-tmpl="#form-add-request-tmpl" data-style="expand-left">
              <i class="mdi mdi-plus-circle mdi-20px"></i>&nbsp;Add Item
            </a>

            <br/>
              
              <table id="tableRequest" class="table table-striped">
                  <thead> 
                    <div class="row m-t-lg">
                      <div class="col-md-3"><label class="form-label">Item Code</label></div>
                      <div class="col-md-3"><label class="form-label">Quota</label></div>
                      <div class="col-md-3"><label class="form-label">Length (meters)</label></div>
                      <div class="col-md-3 action"><label class="form-label">Action</label></div>
                    </div>
                  </thead>
                  <tbody>
                      <div class="detail">
                      <?php
                      foreach($child as $key=> $value)
                      {
                      ?>
                        <div class="row m-t-lg rows form_tmpl" data-id="{{$key}}" id="tmpl-{{$key}}">
                          <div class="col-md-3">
                            <div class="form-group">
                              <div class="form-control-wrapper">
                                <select name="detail[{{$key}}][item_code]" class="form-control" id="order-{{$key}}" required">
                                    <option value="" selected="selected"></option>
                                    <?php
                                      foreach ($option as $value1) 
                                      {
                                          if($value1['item_code'] == $value['item_code'])
                                          {
                                            echo '<option value="'.$value1['item_code'].'" selected="selected">'.$value1['item_code'].'</option>';
                                          }
                                          else
                                          {
                                            echo '<option value="'.$value1['item_code'].'">'.$value1['item_code'].'</option>';
                                          }
                                          
                                      }
                                    ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <div class="form-control-wrapper">
                                <input class="form-control amount_real-{{$key}}"
                                       id="quota-{{$key}}"
                                       type="text"  value="{{$value['quota']}}" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <div class="form-control-wrapper">
                                <input class="form-control amount_real-{{$key}}"
                                       name="detail[{{$key}}][length]"
                                       id="length-{{$key}}"
                                       value="{{$value['length']}}"
                                       type="number" min=0 max={{$value['quota']}} step="0.001" required>
                              </div>
                            </div>
                          </div>
                           <div class="col-md-3">
                            <div class="form-group">
                              <div class="form-control-wrapper">
                                <input type="button" class="btn btn-inline btn-danger btn-sm action-delete delete" id="action_delete-{{$key}}" data-style="expand-left" value="Delete">          
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
              <span class="align-middle">Submit</span>
          </button>
      </form>
  </div>
</div>



<script>
$('.action-delete').on('click', function (event) {
    event.preventDefault();
    fn._deleteForm($(this));
});

$('.btn-add').on('click', function(event){
    event.preventDefault();
    fn._addEvent($(this), $(this).data('tmpl'));
});

var fn = {
    _addEvent : function($elem, tmpl, callback){

        if (!tmpl) {
            return;
        }

        var self = this;
        var $targ = $elem.closest('section').find('.detail');
        var index = $targ.find('.form_tmpl:last-child');
        var check = $targ.find('tr').length;

        if($(index).length == 0) {
          index = 0;
        } else {
          index = $(index).data('id') + 1;
        }

        var templateDom = $(tmpl).html();
        
        var template = Handlebars.compile(templateDom);
        var context = {
            index: index
        };
        
        var html = template(context);

        $(html).appendTo($targ);

        $('#action_delete-'+index).on('click', function (event) {

            /*console.log('delete ya');*/
            self._deleteForm($(this), index);

        });

        $('#order-'+index).on('change', function(event){
            event.preventDefault();
            $.ajax({
                url: '{{ route("good_usage_get_quota_folding_gate") }}?id='+$(this).val(),
                method: 'GET',
                dataType: 'JSON',
                // context: document.body,
                success: function(data){
                    $("#quota-"+index).val(data);
                    $("#length-"+index).attr("max", data);
                }
            });
        });
    },

    _deleteForm: function($elem, index) {
        var arr = [];
        $('.form_tmpl').each(function(index, elem) {
            var val = $(elem).val();
            arr.push(val);
        });
        var sorted_arr = arr.slice().sort();
        var results = [];
        for (var i = 0; i < arr.length - 1; i++) {
            if (sorted_arr[i + 1] == sorted_arr[i]) {
                results.push(sorted_arr[i]);
            }
        }
        if (results.length === 0) {
            return false;
        } else {
            $elem.parent().parent().parent().parent().remove();
        }
    },
}

</script>
@endsection
