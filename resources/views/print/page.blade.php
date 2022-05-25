<div class="no-print">
        <hr/>
        <div class="form-group">
          <label for="page" class="col-sm-1 control-label">Page :</label>
          <div class="col-xs-2">
            <select id="page" class="form-control">
                <option value="p1" selected="selected">Page 1</option>
                <option value="p2">Page 2</option>
                <option value="p3">Page 3</option>
                <option value="p4">Page 4</option>
            </select>
          </div>
        </div>

        <div class="form-group col-xs-2">
        <button class="form-control print-link no-print btn btn-primary" onclick="jQuery('#print').print()">{{ trans('button.print') }}</button>
        </div>
    </div>