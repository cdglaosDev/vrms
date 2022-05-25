<style>
   #PasswordModal .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -21px;
      position: relative;
      z-index: 2;
      margin-right: 10px;
    }
</style>
<div class="modal modal-static fade" id="PasswordModal" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <div class="col-md-11 text-center">
          <h3>{{trans('title.change_pass')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ url('/customer/change-password')}}">
            @csrf
        <div class="modal-body">
            <div class="row pb-3">
                <div class="col-md-12">
                    <label for="current_password">{{trans('common.current_password')}}:</label>
                   <input id="current-password" type="password" class="form-control" name="password" autocomplete="current-password" placeholder="Enter Current Password" required>
                   <span toggle="#current-password" class="fa fa-eye field-icon current-password"></span>
               </div>
            </div>
            
            <div class="row pb-3">
                <div class="col-md-12">
                   <label for="new_password">{{trans('common.new_password')}}:</label>
                    <input id="password-field" type="password" class="form-control" name="new_password" autocomplete="current-password" placeholder="Enter New Password" required>
                    <span toggle="#password-field" class="fa fa-eye field-icon password"></span>
                </div>
            </div>
    
            <div class="row pb-3">
                <div class="col-md-12">
                    <label for="new_confirm_password">{{trans('common.confirm_password')}}:</label>
                    <input id="password-field1" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" placeholder="Enter New Confirmation Password" required>
                    <span toggle="#password-field1" class="fa fa-eye field-icon confirm-password"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{url('customer')}}" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</a>
            <button class="btn btn-success btn-sm" id="login-form-submit">{{trans('button.update')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>
