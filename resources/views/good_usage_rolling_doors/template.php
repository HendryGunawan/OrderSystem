<script id="form-add-request-tmpl" type="text/x-handlebars-template">
   <div class="row m-t-lg rows form_tmpl" data-id="{{index}}" id="tmpl-{{index}}">

      <div class="col-md-3">
        <div class="form-group">
          <div class="form-control-wrapper">
            <select name="detail[{{index}}][item_code]" class="form-control item_code" id="order-{{index}}" required">
                <option value="" selected="selected"></option>
                <?php
                  foreach ($option as $value) {
                      echo '<option value="'.$value['item_code'].'">'.$value['item_code'].'</option>';
                  }
                ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <div class="form-control-wrapper">
            <input class="form-control amount_real-{{index}}"
                   id="quota-{{index}}"
                   type="text" readonly>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <div class="form-control-wrapper">
            <input class="form-control amount_real-{{index}}"
                   name="detail[{{index}}][length]"
                   id="length-{{index}}"
                   type="number" min=0 max=5 step="0.001" required>
          </div>
        </div>
      </div>
       <div class="col-md-3">
        <div class="form-group">
          <div class="form-control-wrapper">
            <input type="button" class="btn btn-inline btn-danger btn-sm ladda-button delete" id="action_delete-{{index}}" data-style="expand-left" value="Delete">          
          </div>
        </div>
      </div>
    </div>
</script>