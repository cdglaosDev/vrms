

 <div class="modal fade" id="vehicleModal"  tabindex="-1" role="dialog"  aria-labelledby="transferModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="position: fixed;top: -28px;display: block;left: 82px;">
    <div class="modal-content" style="width:1180px;height:690px">
        <div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">
        <h3 style="margin-top:-8px; font-size: 19px; border-bottom:none">
		ທະບຽນລົດ ຄຳເຕືອນ ຂໍ້ມູນທັງໝົດເປັນສ່ວນຕົວ ຫ້າມອອກສື່ ອອນລາຍ ນອກຈາກໄດ້ຮັບການອະນຸຍາດເທົ່ານັ້ນ
        <ul class="nav nav-tabs pt-2" style="width: 104%">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" aria-current="page" href="#vehicleInfo">ຂໍ້ມູນ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#log">ປະຫວັດການປ່ຽນແປງ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#document">ເອກະສານອ້າງອີງ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tenant-info">ຂໍ້ມູນຜູ້ເຊົ່າ</a>
            </li>
        </ul>
	    </h3>
        
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">
        <div class="tab-content clearfix">
                <div class="tab-pane active" id="vehicleInfo">
                    @include('vrms2.vehicle.info', ['data' => $data])
                </div>
                <div class="tab-pane" id="log">
                    <h3>Change Log</h3>
                </div>
                <div class="tab-pane" id="document">
                @include('vrms2.vehicle.VehDoc') 
                </div>
                <div class="tab-pane ml-5" id="tenant-info">
                    <form action="{{ route('vehicle-tenant.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-1">
                                    <label for="validationCustom01">{{ trans('common.name')}}:</label>
                                    <input type="hidden" name="vehicle_id" id="vehicle_id" value="">
                                    <input type="text" class="form-control"  value="" placeholder="Enter Name" name="tenant_name" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('common.province')}}:</label>
                                    <select name="province_code" class="form-control" id="tenant_province" required>
                                        <option value="" disabled>Select Province</option>
                                        @foreach($data['provinces'] as $pro)
                                        <option value="{{$pro->province_code}}">{{ $pro->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('common.district')}}:</label>
                                    <select class="form-control" name="district_code"  required="required" id="tenant_district">
                                        <option value="" selected disabled hidden>--Select District--</option>
                                    </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
                                    <input type="text" class="form-control"  value="" placeholder="Enter Village" name="village" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.tel')}}:</label>
                                    <input type="number" class="form-control"  value="" placeholder="Enter Phone" name="phone" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.note')}}:</label>
                                    <textarea name="note"  class="form-control" cols="3" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 mt-5"><input type="file" name="image"></div>
                        </div>
                        <div class="col-md-12 col-sm-12 text-right mt-2">
                            <button class="btn btn-success btn-sm">{{ trans('button.save')}}</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
  </div>
</div>
 </div>

 @push('page_scripts')
<script type="text/javascript">
   var dist_url = "{{url('getDistrict')}}";
</script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
@endpush

