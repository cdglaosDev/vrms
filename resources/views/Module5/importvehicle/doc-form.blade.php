<div class="col-sm-12 col-md-12 md-offset-12">
   <table class="table table-bordered" id="app-document">
      <thead>
         <tr>
            <th width="400">{{ trans('app_form.doc_type')}}</th>
            <th>{{ trans('app_form.doc_filename')}}</th>
            <th>{{ trans('common.action')}}</th>
         </tr>
      </thead>
     <input type="hidden" class="duplicate_file" value="{{ trans('title.duplicate_file') }}">
      <tbody>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]" class="form-control" value="2" />
                  <h5>{{ trans('doc_type.lic_import_car') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]"  class="form-control" value="5" />
                  <h5>{{ trans('doc_type.import_good') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]"  class="form-control" value="4" />
                  <h5>{{ trans('doc_type.veh_lic_tech') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]" class="form-control" value="3" />
                  <h5>{{ trans('doc_type.lic_ministry') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]" class="form-control" value="6" />
                  <h5>{{ trans('doc_type.tax_return') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]" class="form-control" value="7" />
                  <h5>{{ trans('doc_type.tax_relief') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
         <tr class="attach_doc">
            <td>
               <div>
                  <input type="hidden" name="doc_type_id[]" class="form-control" value="8" />
                  <h5>{{ trans('doc_type.record') }}</h5>
               </div>
            </td>
            <td>
               <div>
                  <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
               </div>
            </td>
            <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
         </tr>
      </tbody>
   </table>
</div>
<div class="row mt-3 mx-0">
   <div class="col-md-9">
   </div>
   <div class="col-md-3 text-right">
      <button class="btn btn-success btn-sm addDoc"  onClick="return validate()">{{ trans('button.save')}}</button>
   </div>
</div>