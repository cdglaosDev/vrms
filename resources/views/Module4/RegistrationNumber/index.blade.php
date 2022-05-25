@extends('vrms2.layouts.master')
@section('reg_no','active')
@section('content') 
@include('vrms2.mod4-submenu') 
<h3>{{ trans('module4.license_no_control') }}</h3>
@include('flash')

<style>
.tb-alpabet,.tb-alpabet td {
    border: 1px solid black;
    text-align: center
}

.tb-alpabet {
    width: 100%;
    border-collapse: collapse;
}

.alpabet-head {
    background-color: red;color:#fff
}

form .form-control {
    height: 100% !important;
}
</style>
  
    <div class="card-body">
        <form class="form-row justify-content-start mt-3">
            <div class="col-2">
                <select name="vehicle_kind" class="form-control h-100">
                    <option value="">{{ trans('module4.control_veh_kind')}}</option>
                    @foreach ($vehicle_kind as $item)
                    <option value="{{$item->id}}" @if(request()->get('vehicle_kind') != null) @if($item->id == request()->get('vehicle_kind')) selected @endif @endif>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select name="province" class="form-control h-100">
                    <option value="">{{ trans('common.province') }}</option>
                    @foreach ($province as $item)
                    <option value="{{ str_pad($item->id, 2, '0', STR_PAD_LEFT) }}" @if(request()->get('province') != null) @if($item->id == request()->get('province')) selected @endif @endif>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <input type="text" name="licensenum" id="licensenum" class="form-control h-100" maxlength="7" placeholder="{{ trans('module4.reg_no') }}" value="@if(request()->get('licensenum') != null) {{ request()->get('licensenum') }} @endif">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success btn-sm" onclick="return validate()">{{ trans('button.search') }}</button>
            </div>
        </form>

        <div class="row justify-content-start">
            @foreach ($alpabet_charfirst as $index1 => $item1)
                @php($ifirst=0)
                @php($irow=0)
                @php($iforrow=0)
                <div class="col-2 col-xxl-2 mt-3">
                    <table class="tb-alpabet">
                        @foreach ($alpabet as $index2 => $item2)
                            @if($item2->name_first == $item1->name1)
                                @php($irow++)
                                
                                @php($classcolor="")
                                @if($item2->status_name == 'Uses')
                                    @php($classcolor="linktosub bg-green")
                                @elseif($item2->status_name == 'Full')
                                    @php($classcolor="linktosub bg-orange")
                                @elseif($item2->status_name == 'Available')
                                    @php($classcolor="linktosub bg-yellow")
                                @endif
                                
                                @if($irow == 1) <tr> @endif
                                @if($ifirst==0)
                                    <td class="alpabet-head">{{$item1->name1}}</td>
                                    <td class="{{$classcolor}}" @if($classcolor != '') onclick="window.location.href='{{ url('sub-license-number-control-1').'/'.$item2->province_code.'/'.$item2->vehicle_kind_code.'/'.$item2->id }}'" @endif>{{$item2->name}}</td>
                                    @php($irow++)
                                    @php($iforrow++)
                                @else
                                    <td class="{{$classcolor}}" @if($classcolor != '') onclick="window.location.href='{{ url('sub-license-number-control-1').'/'.$item2->province_code.'/'.$item2->vehicle_kind_code.'/'.$item2->id }}'" @endif>{{$item2->name}}</td>
                                @endif
                                @if($irow == 7) </tr>@endif

                                @php($ifirst++)
                                @php($iforrow++)
                                @if($iforrow == 7)  @php($irow=0) @php($iforrow=0 ) @endif
                            @endif
                        @endforeach
                    </table>
                </div>
            @endforeach
        </div>

    </div>
    </div>

    <div class="modal fade" id="approveconfirm" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body text-center">
                <div class="row m-3">
                <div class="col-12">
                    <h4 id="msgreturn"></h4>
                </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-sm" data-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
@endsection

@push('page_scripts')

 <script type="text/javascript">
    //========================== Check space for Search License No. =========================
   $('#licensenum').keyup(function() {
      var code = $(this).val().split(" ").join("");
      if (code.length > 0) {
         code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
      }
      $(this).val(code);
   });
   //=======================================================================================

   $('#myTable').DataTable({bFilter: false});

   function validate() {

        if (
            $("select[name=vehicle_kind]").val() == '' && 
            $("select[name=province]").val() == '' && 
            $("input[name=licensenum]").val() == ''
        ){
            return false
        }
        else if (
            $("select[name=vehicle_kind]").val() != '' && 
            $("select[name=province]").val() == ''
        ){
            $("#msgreturn").html('plase select province')
            $('#approveconfirm').modal('toggle');
            return false
        }
        else if (
            $("select[name=vehicle_kind]").val() == '' && 
            $("select[name=province]").val() != ''
        ){
            $("#msgreturn").html('plase select vehicle kind')
            $('#approveconfirm').modal('toggle');
            return false
        }
        else if (
            $("select[name=vehicle_kind]").val() == '' && 
            $("select[name=province]").val() == '' && 
            $("select[name=licensenum]").val() != ''
        ){
            $("#msgreturn").html('plase select province,vehicle kind')
            $('#approveconfirm').modal('toggle');
            return false
        }

    }
</script>
@endpush