
<div class="panel-group" id="accordion">
 <!--start User Management-->
<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#userMang">
        User Management
          </a>
      </h4>
    </div><!--/.panel-heading -->
<div id="userMang" class="panel-collapse collapse">
      <div class="panel-group ml-3" id="userMangList">
        <!--start staff -->
        <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#userMangList" href="#staff">
                    Staff
              </a>
            </div>
            <div id="staff" class="panel-collapse collapse">
                <div class="panel-body p-1 ml-2">
                  <label class="role-label all" >{{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('staff-all')->id, in_array(\App\Helpers\Helper::getAllType('staff-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'staff')")) }}
                                {{ \App\Helpers\Helper::getAllType('staff-all')->name }}
                  </label>
                  @foreach(\App\Helpers\Helper::getType('staff') as $value)
                    <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'staff')) }}
                      {{ $value->name }}
                    </label>
                  @endforeach
                </div>
            </div>
        </div>
        <!-- end staff -->
        <!--start Customer -->
        <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#userMangList" href="#customer">
                    Customer
              </a>
            </div>
            <div id="customer" class="panel-collapse collapse">
                <div class="panel-body p-1 ml-2">
                  <label class="role-label all" >{{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('customer-all')->id, in_array(\App\Helpers\Helper::getAllType('customer-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'customer')")) }}
                    {{ \App\Helpers\Helper::getAllType('customer-all')->name }}
                  </label>
                    @foreach(\App\Helpers\Helper::getType('customer') as $value)
                      <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'customer')) }}
                        {{ $value->name }}
                      </label>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- end Customer -->
          <!--start Api User -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#userMangList" href="#api-user">
                    Api User
              </a>
            </div>
            <div id="api-user" class="panel-collapse collapse">
                <div class="panel-body p-1 ml-2">
                  <label class="role-label all" >{{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('api-user-all')->id, in_array(\App\Helpers\Helper::getAllType('api-user-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'api-user')")) }}
                    {{ \App\Helpers\Helper::getAllType('api-user-all')->name }}
                  </label>
                  @foreach(\App\Helpers\Helper::getType('api-user') as $value)
                    <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'api-user')) }}
                      {{ $value->name }}
                    </label>
                  @endforeach
                </div>
            </div>
        </div>
        <!-- end Api User -->
        
        <div class="panel panel-default">
            <div class="panel-heading">
              <a class="collapsed" data-toggle="collapse" data-parent="#userMangList" href="#role">
                Role
                </a>
            </div><!--/.panel-heading -->
            <div id="role" class="panel-collapse collapse">
              <div class="panel-body p-1 ml-2">
                  <label class="role-label all" >{{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('role-all')->id, in_array(\App\Helpers\Helper::getAllType('role-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'role')")) }}
                      {{ \App\Helpers\Helper::getAllType('role-all')->name }}
                    </label>
                    @foreach(\App\Helpers\Helper::getType('role') as $value)
                    <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'role')) }}
                      {{ $value->name }}
                    </label>
                    @endforeach
              </div>
            </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <a class="collapsed" data-toggle="collapse" data-parent="#userMangList" href="#permission">
              Permission
              </a>
          </div>
          <div id="permission" class="panel-collapse collapse">
            <div class="panel-body p-1 ml-2">
            <label class="role-label all" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('permission-all')->id, in_array(\App\Helpers\Helper::getAllType('permission-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'permission')")) }}
                {{ \App\Helpers\Helper::getAllType('permission-all')->name }}
            </label>
                @foreach(\App\Helpers\Helper::getType('permission') as $value)
                <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'permission')) }}
                    {{ $value->name }}
                  </label>
                @endforeach
            </div>
          </div>
      </div>
      </div>
</div>
</div>
<!--end User Management-->
<!--start Financial Management-->
<div class="panel panel-default">
<div class="panel-heading">
  <h4 class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#finanMang">
  Financial Management
      </a>
  </h4>
</div><!--/.panel-heading -->
<div id="finanMang" class="panel-collapse collapse">

<div class="panel-group ml-3" id="finanList">

<div class="panel panel-default">
<div class="panel-heading">
<a data-toggle="collapse" data-parent="#finanList" href="#price-list">
Manage Price List
</a>
</div><!--/.panel-heading -->
<div id="price-list" class="panel-collapse collapse">
<div class="panel-body p-1 ml-2">
<label class="role-label all" >
  {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('price-list-all')->id, in_array(\App\Helpers\Helper::getAllType('price-list-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'price-list')")) }}
  {{ \App\Helpers\Helper::getAllType('price-list-all')->name }}
</label>
          @foreach(\App\Helpers\Helper::getType('price-list') as $value)
          <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'price-list')) }}
                {{ $value->name }}
              </label>
          @endforeach
</div>
</div>

</div>
          
<div class="panel panel-default">
    <div class="panel-heading">
      <a data-toggle="collapse" data-parent="#finanList" href="#price-item">
      Manage Price Item
      </a>
    </div><!--/.panel-heading -->
    <div id="price-item" class="panel-collapse collapse">
      <div class="panel-body p-1 ml-2">
      <label class="role-label all" >
        {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('price-item-all')->id, in_array(\App\Helpers\Helper::getAllType('price-item-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'price-item')")) }}
        {{ \App\Helpers\Helper::getAllType('price-item-all')->name }}
    </label>
         @foreach(\App\Helpers\Helper::getType('price-item') as $value)
        <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'price-item')) }}
            {{ $value->name }}
        </label>
        @endforeach
    
      </div>
    </div>
   
</div>

<!-- start price group -->
<div class="panel panel-default">
    <div class="panel-heading">
      <a data-toggle="collapse" data-parent="#finanList" href="#price-group">
      Price Item Group
      </a>
    </div><!--/.panel-heading -->
    <div id="price-group" class="panel-collapse collapse">
      <div class="panel-body p-1 ml-2">
      <label class="role-label all" >
        {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('price-group-all')->id, in_array(\App\Helpers\Helper::getAllType('price-group-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'price-group')")) }}
        {{ \App\Helpers\Helper::getAllType('price-group-all')->name }}
    </label>
                @foreach(\App\Helpers\Helper::getType('price-group') as $value)
                <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'price-group')) }}
                      {{ $value->name }}
                    </label>
                @endforeach
      </div>
    </div>
</div>
  <!-- end price group -->
    <!-- start Match Payment -->
<div class="panel panel-default">
    <div class="panel-heading">
      <a data-toggle="collapse" data-parent="#finanList" href="#match-payment">
      Match Payment
      </a>
    </div><!--/.panel-heading -->
    <div id="match-payment" class="panel-collapse collapse">
      <div class="panel-body p-1 ml-2">
      <label class="role-label all" >
        {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('match-payment-all')->id, in_array(\App\Helpers\Helper::getAllType('match-payment-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'match-payment')")) }}
        {{ \App\Helpers\Helper::getAllType('match-payment-all')->name }}
    </label>
                @foreach(\App\Helpers\Helper::getType('match-payment') as $value)
                <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'match-payment')) }}
                      {{ $value->name }}
                    </label>
                @endforeach
      </div>
    </div>
</div>
  <!-- end  Match Payment -->
      <!-- start Counter Match -->
  <div class="panel panel-default">
      <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#finanList" href="#counter-match">
        Service Counter Matching
        </a>
      </div><!--/.panel-heading -->
      <div id="counter-match" class="panel-collapse collapse">
        <div class="panel-body p-1 ml-2">
        <label class="role-label all" >
          {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('counter-match-all')->id, in_array(\App\Helpers\Helper::getAllType('counter-match-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'service-counter')")) }}
          {{ \App\Helpers\Helper::getAllType('counter-match-all')->name }}
      </label>
        @foreach(\App\Helpers\Helper::getType('counter-match') as $value)
        <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'service-counter')) }}
              {{ $value->name }}
            </label>
        @endforeach
        </div>
      </div>
      <label class="role-label" style="font-size: 13px;color:#323276;margin-left:0px;">
            {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('daily-report')->id, in_array(\App\Helpers\Helper::getAllType('daily-report')->id, $rolePermissions) ? true : false) }}
            {{ \App\Helpers\Helper::getAllType('daily-report')->name }}
    </label>
    <label class="role-label" style="font-size: 13px;color:#323276;margin-left:0px;">
            {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('summary-report')->id, in_array(\App\Helpers\Helper::getAllType('summary-report')->id, $rolePermissions) ? true : false) }}
            {{ \App\Helpers\Helper::getAllType('summary-report')->name }}
    </label>
  </div>
    <!-- end    start Counter Match -->
            
    </div>
</div>
  <!--end Financial Management-->
<!--start Table Management-->
<div class="panel-heading">
  <h4 class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#tableMang">
      Table Management
      </a>
  </h4>
</div>
<div id="tableMang" class="panel-collapse collapse">
  <div class="panel-body p-1 ml-2">
      <label class="role-label all" >
        {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod3_all')->id, in_array(\App\Helpers\Helper::getAllType('mod3_all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'my-table')")) }}
        {{ \App\Helpers\Helper::getAllType('mod3_all')->name }}
      </label>
      @foreach(\App\Helpers\Helper::getType('mod3_child') as $value)
      <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'my-table')) }}
          {{ $value->name }}
        </label>
      @endforeach
  </div>
</div>
<!--end Table Management-->

<!--start Vehicle Management-->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#vehicle-mang">
        Vehicle Management
        </a>
    </h4>
</div><!--/.panel-heading -->
<div id="vehicle-mang" class="panel-collapse collapse">
                                      
        <div class="panel-group ml-3" id="vehilceList">
          
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#appform">
                   Application Form
                    </a>
                </div><!--/.panel-heading -->
                <div id="appform" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('app-form-all')->id, in_array(\App\Helpers\Helper::getAllType('app-form-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'app-form')")) }}
                      {{ \App\Helpers\Helper::getAllType('app-form-all')->name }}
                  </label>
                            @foreach(\App\Helpers\Helper::getType('app-form') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'app-form')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#vehicles">
                    Vehicle
                    </a>
                </div><!--/.panel-heading -->
                <div id="vehicles" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-all')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'vehicle')")) }}
                      {{ \App\Helpers\Helper::getAllType('vehicle-all')->name }}
                  </label>
                            @foreach(\App\Helpers\Helper::getType('vehicle') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'vehicle')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
            </div>

          <!-- start price group -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#veh-transfer">
                   Vehicle Transfer
                    </a>
                </div><!--/.panel-heading -->
                <div id="veh-transfer" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-transfer-all')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-transfer-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'transfer')")) }}
                      {{ \App\Helpers\Helper::getAllType('vehicle-transfer-all')->name }}
                  </label>
                            @foreach(\App\Helpers\Helper::getType('vehicle-transfer') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'transfer')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
            </div>
            <!-- start vehicle technical -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#veh-technical">
                   Vehicle Inspection
                    </a>
                </div><!--/.panel-heading -->
                <div id="veh-technical" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-technical-all')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-technical-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'veh-tech')")) }}
                      {{ \App\Helpers\Helper::getAllType('vehicle-technical-all')->name }}
                  </label>

                            @foreach(\App\Helpers\Helper::getType('vehicle-technical') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'veh-tech')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
            </div>
            <!-- start Traffic polic -->
            <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#vehilceList" href="#traffic-police">
              Traffic Police
                </a>
            </div><!--/.panel-heading -->
            <div id="traffic-police" class="panel-collapse collapse">
                <div class="panel-body p-1 ml-2">
                    @foreach(\App\Helpers\Helper::getType('traffic-police') as $value)
                    <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'traffic-police')) }}
                            {{ $value->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            </div>
               <!-- start Document -->
               <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#doc-management">
                  Document Management
                    </a>
                </div><!--/.panel-heading -->
                <div id="doc-management" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('document-all')->id, in_array(\App\Helpers\Helper::getAllType('document-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'document-mang')")) }}
                      {{ \App\Helpers\Helper::getAllType('document-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('document') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'document-mang')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
            <!-- start registration number -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#register-no">
                   Registration Number
                    </a>
                </div><!--/.panel-heading -->
                <div id="register-no" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('registration-number-all')->id, in_array(\App\Helpers\Helper::getAllType('registration-number-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'reg_no')")) }}
                      {{ \App\Helpers\Helper::getAllType('registration-number-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('registration-number') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'reg_no')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
             <!-- start Lic No Control -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#lic-control">
                 License Number Control
                    </a>
                </div><!--/.panel-heading -->
                <div id="lic-control" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('lic-control-all')->id, in_array(\App\Helpers\Helper::getAllType('lic-control-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'lic-control')")) }}
                      {{ \App\Helpers\Helper::getAllType('lic-control-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('lic-control') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'lic-control')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
             <!-- start Alphabet Control -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#alphabet-control">
               Alphabet Control
                    </a>
                </div><!--/.panel-heading -->
                <div id="alphabet-control" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('alphabet-control-all')->id, in_array(\App\Helpers\Helper::getAllType('alphabet-control-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'alphabet-control')")) }}
                      {{ \App\Helpers\Helper::getAllType('alphabet-control-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('alphabet-control') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'alphabet-control')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
            <!-- start Lic No Sale -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#lic-sale">
                 License Number Sale
                    </a>
                </div><!--/.panel-heading -->
                <div id="lic-sale" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('lic-sale-all')->id, in_array(\App\Helpers\Helper::getAllType('lic-sale-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'lic-sale')")) }}
                      {{ \App\Helpers\Helper::getAllType('lic-sale-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('lic-sale') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'lic-sale')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
             <!-- start Lic No Not Sale -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#lic-not-sale">
                 License Number Not Sale
                    </a>
                </div><!--/.panel-heading -->
                <div id="lic-not-sale" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('lic-not-sale-all')->id, in_array(\App\Helpers\Helper::getAllType('lic-not-sale-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'lic-not-sale')")) }}
                      {{ \App\Helpers\Helper::getAllType('lic-not-sale-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('lic-not-sale') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'lic-not-sale')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>

            
             <!-- start Lic No Booking -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#lic-booking">
                 License Number Booking
                    </a>
                </div><!--/.panel-heading -->
                <div id="lic-booking" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('lic-booking-all')->id, in_array(\App\Helpers\Helper::getAllType('lic-booking-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'lic-booking')")) }}
                      {{ \App\Helpers\Helper::getAllType('lic-booking-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('lic-booking') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'lic-booking')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>

             <!-- start Lic History -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#lic-history">
                 License History
                    </a>
                </div><!--/.panel-heading -->
                <div id="lic-history" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('lic-history-all')->id, in_array(\App\Helpers\Helper::getAllType('lic-history-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'lic-history')")) }}
                      {{ \App\Helpers\Helper::getAllType('lic-history-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('lic-history') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'lic-history')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>

             <!-- start Lic No Present -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#lic-present">
                 License Number Present
                    </a>
                </div><!--/.panel-heading -->
                <div id="lic-present" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('lic-present-all')->id, in_array(\App\Helpers\Helper::getAllType('lic-present-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'lic-present')")) }}
                      {{ \App\Helpers\Helper::getAllType('lic-present-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('lic-present') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'lic-present')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>

             <!-- start divsion control -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#division-control">
                 Division No Control
                    </a>
                </div><!--/.panel-heading -->
                <div id="division-control" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('division-all')->id, in_array(\App\Helpers\Helper::getAllType('division-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'division-control')")) }}
                      {{ \App\Helpers\Helper::getAllType('division-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('division') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'division-control')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>

             <!-- start province control -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#province-control">
                Province No Control
                    </a>
                </div><!--/.panel-heading -->
                <div id="province-control" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('province-all')->id, in_array(\App\Helpers\Helper::getAllType('province-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'province-control')")) }}
                      {{ \App\Helpers\Helper::getAllType('province-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('province') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'province-control')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
             <!-- start Alphabet -->
             <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#alphabet">
              Alphabet
                    </a>
                </div><!--/.panel-heading -->
                <div id="alphabet" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('alphabet-all')->id, in_array(\App\Helpers\Helper::getAllType('alphabet-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'alphabet')")) }}
                      {{ \App\Helpers\Helper::getAllType('alphabet-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('alphabet') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'alphabet')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
            
            <!-- start Vehicle History -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#vehilceList" href="#v-history-status">
                Vehicle History
                    </a>
                </div><!--/.panel-heading -->
                <div id="v-history-status" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-history-all')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-history-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'v-history')")) }}
                      {{ \App\Helpers\Helper::getAllType('vehicle-history-all')->name }}
                  </label>

                  @foreach(\App\Helpers\Helper::getType('vehicle-history') as $value)
                  <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'v-history')) }}
                          {{ $value->name }}
                      </label>
                  @endforeach
                    </div>
                </div>
            </div>
                                       
    </div>
</div>
<!--end Vehicle Management-->
<!-- start vehicle Passport -->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#inspection">
       Technical Inspect
        </a>
    </h4>
</div><!--/.panel-heading -->

<div id="inspection" class="panel-collapse collapse">
                                      
        <div class="panel-group ml-3" id="inspectList">
                                      
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#inspection" href="#tech-inspect">
               Technical Inspect
                    </a>
                </div><!--/.panel-heading -->
                <div id="tech-inspect" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('inspect-all')->id, in_array(\App\Helpers\Helper::getAllType('inspect-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'inspect')")) }}
                      {{ \App\Helpers\Helper::getAllType('inspect-all')->name }}
                    </label>
                            @foreach(\App\Helpers\Helper::getType('inspect') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'inspect')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
             
            </div>
                                       
    </div>
</div>
<!-- start vehicle importer -->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#vehicle-import">
        Vehicle Import Management
        </a>
    </h4>
</div><!--/.panel-heading -->
<div id="vehicle-import" class="panel-collapse collapse">
                                      
        <div class="panel-group ml-3" id="importlist">
                                      
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#importlist" href="#import">
                   Import Application Lists
                    </a>
                </div><!--/.panel-heading -->
                <div id="import" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-importer-all')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-importer-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'import')")) }}
                      {{ \App\Helpers\Helper::getAllType('vehicle-importer-all')->name }}
                  </label>
                            @foreach( \App\Helpers\Helper::getType('vehicle-importer') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'import')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
            </div>
                                       
    </div>
</div>
<!-- end vehicle importer -->
<!-- start vehicle Passport -->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#vehicle-passport">
        Vehicle Passport (Register Lists)
        </a>
    </h4>
</div><!--/.panel-heading -->

<div id="vehicle-passport" class="panel-collapse collapse">
                                      
        <div class="panel-group ml-3" id="reg_list">
                                      
            <div class="panel panel-default">
                    <label class="role-label" style="font-size: 13px;color:#323276;margin-left:0px;">
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('new-register')->id, in_array(\App\Helpers\Helper::getAllType('new-register')->id, $rolePermissions) ? true : false) }}
                      {{ \App\Helpers\Helper::getAllType('new-register')->name }}
                    </label>
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#reg_list" href="#register">
                 Register Lists
                    </a>
                </div><!--/.panel-heading -->
                <div id="register" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-passbook-all')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-passbook-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'passport')")) }}
                      {{ \App\Helpers\Helper::getAllType('vehicle-passbook-all')->name }}
                    </label>
                            @foreach(\App\Helpers\Helper::getType('vehicle-passbook') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'passport')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
                <label class="role-label" style="font-size: 13px;color:#323276;margin-left:0px;">
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('passport-report')->id, in_array(\App\Helpers\Helper::getAllType('passport-report')->id, $rolePermissions) ? true : false) }}
                      {{ \App\Helpers\Helper::getAllType('passport-report')->name }}
                    </label>
            </div>
                                       
    </div>
</div>

<!-- end vehicle passport -->
 <!--start Table Management-->
 <div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#reportMang">
       Report And Statics
        </a>
    </h4>
    </div><!--/.panel-heading -->
    <div id="reportMang" class="panel-collapse collapse">
        <div class="panel-body p-1 ml-2">
              <label class="role-label all" >
              {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('report-all')->id, in_array(\App\Helpers\Helper::getAllType('report-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'report')")) }}
              {{ \App\Helpers\Helper::getAllType('report-all')->name }}
              </label>
              @foreach(\App\Helpers\Helper::getType('report') as $value)
              <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'report')) }}
                      {{ $value->name }}
                  </label>
              @endforeach
        </div>
    </div>
                                 
<!--end Report-->
<!-- start vehicle Passport -->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#setting">
        Setting
        </a>
    </h4>
</div><!--/.panel-heading -->

<div id="setting" class="panel-collapse collapse">
                                      
        <div class="panel-group ml-3" id="reg_list">
                                      
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#setting" href="#display-setting">
                Display Setting
                    </a>
                </div><!--/.panel-heading -->
                <div id="display-setting" class="panel-collapse collapse">
                    <div class="panel-body p-1 ml-2">
                    <label class="role-label all" >
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('display-setting-all')->id, in_array(\App\Helpers\Helper::getAllType('display-setting-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'display-setting')")) }}
                      {{ \App\Helpers\Helper::getAllType('display-setting-all')->name }}
                    </label>
                            @foreach(\App\Helpers\Helper::getType('display-setting') as $value)
                            <label class="role-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'display-setting')) }}
                                    {{ $value->name }}
                                </label>
                            @endforeach
                    </div>
                </div>
                <label class="role-label" style="font-size: 18px;color:#323276;margin-left:0px;">
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('smart-card-setting')->id, in_array(\App\Helpers\Helper::getAllType('smart-card-setting')->id, $rolePermissions) ? true : false) }}
                      {{ \App\Helpers\Helper::getAllType('smart-card-setting')->name }}
                </label>
                <label class="role-label" style="font-size: 18px;color:#323276;margin-left:0px;">
                      {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('smart-card-logo')->id, in_array(\App\Helpers\Helper::getAllType('smart-card-logo')->id, $rolePermissions) ? true : false) }}
                      {{ \App\Helpers\Helper::getAllType('smart-card-logo')->name }}
                </label>
            </div>
                                       
    </div>
</div>

<!--start User Manuage guide-->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#user-guide">
      User Manual Guide
        </a>
    </h4>
    </div><!--/.panel-heading -->
    <div id="user-guide" class="panel-collapse collapse">
    <div class="panel-body p-1 ml-2">
         @foreach(\App\Helpers\Helper::getType('user-guide') as $value)
         <label class="role-label">{{ Form::checkbox('permission[]',$value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'my-menu','id' => 'user-guide')) }}
             {{ $value->name }}
        </label>
         @endforeach
      </div>
</div> 
<!--start Display-->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#Display">
    Display
        </a>
    </h4>
    </div><!--/.panel-heading -->
    <div id="Display" class="panel-collapse collapse">
    <div class="panel-body p-1 ml-2">
         @foreach(\App\Helpers\Helper::getType('display') as $value)
         <label class="role-label">{{ Form::checkbox('permission[]',$value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'my-menu')) }}
             {{ $value->name }}
        </label>
         @endforeach
      </div>
</div> 
<!--start Annoucement-->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#annouce">
            Annoucement
        </a>
    </h4>
    </div><!--/.panel-heading -->
    <div id="annouce" class="panel-collapse collapse">
    <div class="panel-body p-1 ml-2">
        <label class="role-label all" >
            {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('annouce-all')->id, in_array(\App\Helpers\Helper::getAllType('annouce-all')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'annouce')")) }}
            {{ \App\Helpers\Helper::getAllType('annouce-all')->name }}
        </label>
         @foreach(\App\Helpers\Helper::getType('annouce') as $value)
         <label class="role-label">{{ Form::checkbox('permission[]',$value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'annouce')) }}
             {{ $value->name }}
        </label>
         @endforeach
      </div>
</div> 

<!--start Main Menu Management-->
<div class="panel-heading">
    <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#moduleMang">
       Main Menu Management
        </a>
    </h4>
    </div><!--/.panel-heading -->
    <div id="moduleMang" class="panel-collapse collapse">
    <label class="role-label allmenu">
        {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('all-menu')->id, in_array(\App\Helpers\Helper::getAllType('all-menu')->id, $rolePermissions) ? true : false, array('class' => 'name' ,'onclick'=>"javascript:checkAll(this,'main-menu')")) }}
        {{ \App\Helpers\Helper::getAllType('all-menu')->name }}
    </label>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('vehicle-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('vehicle-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'vehicle-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('vehicle-mainmenu')->name }}
            </label>
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('pricelist-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('pricelist-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'pricelist-mainmenu')")) }}
                {{ \App\Helpers\Helper::getAllType('pricelist-mainmenu')->name }}
            </label>
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod1-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('mod1-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod1-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('mod1-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('mod1-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'main-menu mod1-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod2-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('mod2-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod2-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('mod2-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('mod2-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'main-menu mod2-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod3-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('mod3-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod3-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('mod3-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('mod3-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'main-menu mod3-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod4-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('mod4-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod4-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('mod4-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('mod4-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'main-menu mod4-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod5-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('mod5-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod5-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('mod5-mainmenu')->name }}
            </label>
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('transfer-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('transfer-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'transfer-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('transfer-mainmenu')->name }}
            </label>
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod6-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('mod6-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod6-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('mod6-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('mod6-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'main-menu mod6-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
          <!-- start submenu -->
          <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('appform-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('appform-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'app-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('appform-mainmenu')->name }}
            </label>
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('display-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('display-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'display-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('display-mainmenu')->name }}
            </label>
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('mod2-screen')->id, in_array(\App\Helpers\Helper::getAllType('mod2-screen')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'mod2-screen')")) }}
                {{ \App\Helpers\Helper::getAllType('mod2-screen')->name }}
            </label>
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('inspect-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('inspect-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'inspect-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('inspect-mainmenu')->name }}
            </label>
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('traffic-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('traffic-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'traffic-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('traffic-mainmenu')->name }}
            </label>
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('anno-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('anno-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'anno-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('anno-mainmenu')->name }}
            </label>
        </div>
        <!-- start submenu -->
        <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('userguide-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('userguide-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'guide-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('userguide-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('userguide-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'guide-menu main-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('setting-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('setting-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'setting-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('setting-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('setting-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'setting-menu main-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label menu-title" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('report-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('report-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'report-menu')")) }}
                {{ \App\Helpers\Helper::getAllType('report-mainmenu')->name }}
            </label>
            @foreach(\App\Helpers\Helper::getType('report-submenu') as $value)
            <label class="role-label submenu">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'report-menu main-menu')) }}
                {{ $value->name }}
            </label>
            @endforeach
        </div>
         <!-- start submenu -->
         <div class="panel-body p-1 ml-2 menu-mang">
            <label class="role-label" >
                {{ Form::checkbox('permission[]', \App\Helpers\Helper::getAllType('action-mainmenu')->id, in_array(\App\Helpers\Helper::getAllType('anno-mainmenu')->id, $rolePermissions) ? true : false, array('class' => 'name main-menu' ,'onclick'=>"javascript:checkAll(this,'action')")) }}
                {{ \App\Helpers\Helper::getAllType('action-mainmenu')->name }}
            </label>
        </div>
</div>
                                 
<!--end Main Menu Management-->
 </div><!-- /.panel-group -->