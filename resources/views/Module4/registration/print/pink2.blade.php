<style>
   #print-paper h3,
   #print-paper h4 {
      font-size: 25px;
   }

   #print-paper label,
   #print-paper span {

      font-size: 18px;
   }

   #print-paper input[type=checkbox] {
      transform: scale(1.25);
      margin-left: 5px;
   }

   #print-paper {
      line-height: 17px;
   }

   #print-paper .col-md-12 {
      width: 100%;
   }

   #print-paper .col-md-11 {
      width: 91.66666666666666%;
   }

   #print-paper .col-md-10 {
      width: 83.33333333333334%;
   }

   #print-paper .col-md-9 {
      width: 75%;
   }

   #print-paper .col-md-8 {
      width: 66.66666666666666%;
   }

   #print-paper .col-md-7 {
      width: 58.333333333333336%;
   }

   #print-paper .col-md-6 {
      width: 50%;
   }

   #print-paper .col-md-5 {
      width: 41.66666666666667%;
   }

   #print-paper .col-md-4 {
      width: 33.33333333333333%;
   }

   #print-paper .col-md-3 {
      width: 25%;
   }

   #print-paper .col-md-2 {
      width: 16.666666666666664%;
   }

   #print-paper .col-md-1 {
      width: 8.333333333333332%;
   }

   #print-paper .text-center {
      text-align: center;
   }

   #print-paper .mb-1 {
      margin-bottom: 0.25rem;
   }

   .print-paper1 {
      /* background-image: url(/images/pink2_16_1.jpg); */
      width: 1000px;

      height: 1400px;
      margin-top: 0px !important;
      padding-top: 0px !important;
   }

   @page vertical {
      size: A4 portrait;
      margin: 0 !important;
   }

   .printPink2 {
      page: vertical;
   }

   .div-chk {
      margin-top: -5px;
   }
</style>
@php
$steer_id =\App\Model\Steering::whereStatus(1)->get();
$gases =\App\Model\Gas::get();

@endphp

<div class="printPink2">
   <div class="card-body print-paper1" id="print-paper">
      <div class="row " style="height: 185px;">&nbsp;</div>
      <div class="row " style="height:15px">
         <div style="width:74%;">&nbsp;
         </div>
         <div style="width:25%;">

            @if(isset($vehicle->division_no))<span class="dot-line-notuse">{{$vehicle->division_no}} </span>@else<span> </span>@endif

         </div>
      </div>
      <div class="row" style="height:20px">
         <div style="width:23%;">&nbsp;</div>
         <div style="width: 20%;">
            @if(isset($vehicle->province_no))<span class="dot-line-notuse">{{$vehicle->province_no}}</span>@else<span></span>@endif
         </div>
      </div>

      <div class="row " style="height:130px;">&nbsp;</div>

      <div class="row" style="height:50px;">
         <div style="width: 48%;">&nbsp;</div>

         <div style="width: 20%; padding-top:15px;"> <span style="padding-left: 20px;font-size:28px">@if($vehicle->licence_no) <b>{{$vehicle->licence_no}} </b>@else<b></b>@endif </span></div>
         <div style="width: 33%;"><span class="dot-line-notuse">@if($vehicle->vehicle_kind_id) <b>{{$vehicle->vehicle_kind->name}} </b>@else<b></b>@endif </span></div>

      </div>

      <div class="row" style="height:33px;">
         <div style="width: 15%;">&nbsp;</div>
         <div style="width: 60%; padding-top: 10px;"> @if(isset($vehicle->owner_name))<span class="dot-line-notuse" style="padding-left: 20px;"><b>{{$vehicle->owner_name}}</b></span>
            @else<span></span>@endif
         </div>
      </div>
      <div class="row " style="height:35px;">
         <div style="width: 15%;">&nbsp;</div>
         <div style="width: 23%; padding-top:5px;"> @if($vehicle->village_name)<span class="dot-line-notuse" style="padding-left: 5px;"><b>&nbsp;{{$vehicle->village_name}} </b></span>@else <b></b> @endif</div>
         <div style="width: 5%;">&nbsp;</div>
         <div style="width: 22%;  padding-top:5px;"> @if($vehicle->district_code)<span class="dot-line-notuse" style="padding-left: 5px;"><b>&nbsp;{{$vehicle->district->name}}</b>
            </span> @else <b></b> @endif
         </div>
         <div style="width: 6%;">&nbsp;</div>
         <div style="width: 24%;"> @if($vehicle->province_code) <span class="dot-line-notuse" style="padding-left: 5px;"><b>&nbsp;{{ $vehicle->province->name}}</b>
            </span> @else <b></b> @endif
         </div>
      </div>
      <div class="row" style="height:28px;">
         <div style="width: 11%;">&nbsp;</div>
         <div style="width: 12%;"><span class="dot-line-notuse" style="padding-left: 5px;"><b>{{$vehicle->vtype->name ?? ''}}</b></span></div>
         <div style="width: 3%;">&nbsp;</div>
         <div style="width: 26%;"><span class="dot-line-notuse pl-2"><b>{{$vehicle->vbrand->name ?? ''}}</b></span></div>
         <div style="width: 3%;">&nbsp;</div>
         <div style="width: 9%; "><span class="dot-line-notuse pl-2"><b>{{$vehicle->vmodel->name ?? ''}}</b></span></div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 10%; "><span class="dot-line-notuse pl-3"><b>{{$vehicle->color->name ?? ''}}</b></span></div>
         <div style="width: 6%;">&nbsp;</div>
         <div style="width: 12%;"><span class="dot-line-notuse pl-3"><b>{{$vehicle->steering->name ?? ''}}</b></span></div>
      </div>
      <div class="row" style="height:25px;">
         <div style="width: 16%;">&nbsp;</div>
         <div class="div-chk" style="width: 9%;padding-left:12px;padding-top: 2px;">
            @if($vehicle->gas_id==1)
            <input type="checkbox" {{ $vehicle->gas_id==1 ?"checked":""}}>
            @endif
         </div>
         <div class="div-chk" style="width: 9%;padding-left:8px;padding-top: 2px;">
            @if($vehicle->gas_id==2)
            <input type="checkbox" {{ $vehicle->gas_id==2 ?"checked":""}}>
            @endif
         </div>
         <div class="div-chk" style="width: 8%; padding-left:9px;padding-top: 2px;">
            @if($vehicle->gas_id==3)
            <input type="checkbox" {{ $vehicle->gas_id==3 ?"checked":""}}>
            @endif
         </div>
         <div class="div-chk" style="width: 8%; padding-left:3px;padding-top: 2px;">
            @if($vehicle->gas_id==4)
            <input type="checkbox" {{ $vehicle->gas_id==4 ?"checked":""}}>
            @endif
         </div>

         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 14%;">@if($vehicle->motor_brand_id) <span class="dot-line-notuse pl-2"><b>{{$vehicle->moter_brand->name_en}}</b></span> @else <b></b> @endif</div>
         <div style="width: 5%;">&nbsp;</div>
         <div style="width: 5%; "> @if($vehicle->cylinder) <span class="dot-line-notuse pl-2"><b>{{$vehicle->cylinder}}</b> </span> @else &nbsp; @endif</div>
         <div style="width: 10%;">&nbsp;</div>
         <div style="width: 8%;padding-left:5px;"> @if($vehicle->cc) <span class="dot-line-notuse pl-3"><b>{{$vehicle->cc}}</b>
            </span>@else <b>&nbsp;</b> @endif</div>
      </div>
      <div class="row " style="height: 25px;">
         <div style="width: 9%;">&nbsp;</div>
         <div style="width: 38%; padding-top:8px;padding-left:20px;"> @if($vehicle->engine_no)<span class="dot-line-notuse" style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$vehicle->engine_no}}
            </span> @else <b></b> @endif</div>
         <div style="width: 6%;">&nbsp;</div>
         <div style="width: 42%; padding-top:6px;padding-left:20px;"> @if($vehicle->chassis_no)<span class="dot-line-notuse" style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$vehicle->chassis_no}}
            </span>@else <b></b> @endif</div>
      </div>
      <div class="row " style="height: 30px;">
         <div style="width: 19%;">&nbsp;</div>
         <div style="width: 12%;padding-top:10px;">
            @if($vehicle->width)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->width}}</b></span>&nbsp; @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 7%;">&nbsp;</div>
         <div style="width: 9%; padding-top:10px;padding-left:15px;">@if($vehicle->long)<span class="dot-line-notuse "><b>{{$vehicle->long}}</b></span>@else <b>&nbsp;</b> @endif</div>
         <div style="width: 6%;">&nbsp;</div>
         <div style="width: 10%;padding-top:10px;padding-left:15px;">@if($vehicle->height)<span class="dot-line-notuse"><b>{{$vehicle->height}}</b></span> @else @endif</div>
         <div style="width: 14%;">&nbsp;</div>
         <div style="width: 16%; padding-top:8px;padding-left:15px;"> @if($vehicle->seat ) <span class="dot-line-notuse"><b>&nbsp;{{$vehicle->seat}}</b></span> @else @endif</div>
      </div>
      <div class="row" style="height: 30px;">
         <div style="width: 13%;">&nbsp;</div>
         <div style="width: 18%; padding-top:10px;"> @if($vehicle->weight) <span class="dot-line-notuse"><b>&nbsp;{{$vehicle->weight}}</b></span>&nbsp; @else @endif </div>
         <div style="width: 14%;">&nbsp;</div>
         <div style="width: 18%; padding-top:10px;"> @if($vehicle->weight_filled)<span class="dot-line-notuse pl-3"><b>&nbsp;{{$vehicle->weight_filled ??''}}</b></span>&nbsp; @else @endif</div>
         <div style="width: 13%;">&nbsp;</div>
         <div style="width: 16%;padding-top:8px;"> @if($vehicle->total_weight) <span class="dot-line-notuse"><b>&nbsp;{{$vehicle->total_weight}}</b></span>&nbsp; @else @endif</div>
      </div>

      <div class="row " style="height: 30px;">
         <div style="width: 12%;">&nbsp;</div>
         <div style="width: 21%; padding-top:10px;"> @if($vehicle->axis) <span class="dot-line-notuse pl-3"><b>{{$vehicle->axis}}</b></span>&nbsp; @else @endif </div>
         <div style="width: 10%; ">&nbsp;</div>
         <div style="width: 24%; padding-top:10px;"> @if($vehicle->wheels) <span class="dot-line-notuse"><b>{{$vehicle->wheels}}</b></span>&nbsp; @else @endif</div>
         <div style="width: 10%;">&nbsp;</div>
         <div style="width: 22%; padding-top:10px;"> @if($vehicle->year_manufacture) <span class="dot-line-notuse"><b>{{$vehicle->year_manufacture}}</b></span> @else <b></b> @endif</div>
      </div>
      <div class="row " style="height:10px;">&nbsp;</div>
      <div class="row" style="height:60px;">
         <div style="width: 22%;">&nbsp;</div>
         <div style="width: 68%; padding-top:20px;padding-left: 78px;"><span style="font-size:28px;font-family:Saysettha OT;font-weight: bold;">@if($vehicle->engine_no){{$vehicle->engine_no}} @else<b>&nbsp;</b>@endif </span></div>
         <div style="width: 7%;">&nbsp;</div>

      </div>
      <br />
      <div class="row" style="height:60px;">
         <div style="width: 22%;">&nbsp;</div>
         <div style="width: 68%; padding-top:20px;padding-left: 78px;"><span style="font-size:28px;font-family:Saysettha OT;font-weight: bold;">@if($vehicle->chassis_no){{$vehicle->chassis_no}} @else<b>&nbsp;</b>@endif </span></div>
         <div style="width: 7%;">&nbsp;</div>
      </div>
      <div class="row" style="height:41px;">&nbsp;</div>

      <!-- ================================================ 1 ============================================ -->
      <div class="row " style="height:25px;">
         <div style="width: 31%;">&nbsp;</div>
         <div class="div-chk" style="width: 27%;padding-left: 4px;">
            @if($vehicle->import_permit_invest ==1)
            <input type="checkbox" value="" {{ $vehicle->import_permit_invest ==1?'checked':''}}>
            @endif
         </div>

         <div class="div-chk" style="width: 13%;padding-left: 7px;">
            @if($vehicle->import_permit_hsny ==1)
            <input type="checkbox" value="" {{ $vehicle->import_permit_hsny ==1?'checked':''}}>
            @endif
         </div>
         <div style="width: 12%;padding-left:5px;"> @if($vehicle->import_permit_no)<span class="dot-line-notuse"><b>{{$vehicle->import_permit_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;"> @if($vehicle->import_permit_date)<span class="dot-line-notuse"><b>{{$vehicle->import_permit_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>

      <!-- ================================================ 2 ============================================ -->
      <div class="row " style="height:25px;">
         <div style="width: 71%;">&nbsp;</div>
         <div style="width: 12%; padding-left:5px;"> @if($vehicle->industrial_doc_no)<span class="dot-line-notuse"><b>{{$vehicle->industrial_doc_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif </div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;"> @if($vehicle->industrial_doc_date)<span class="dot-line-notuse"><b>{{$vehicle->industrial_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>

      <!-- ================================================ 3 ============================================ -->
      <div class="row" style="height:30px;">
         <div style="width: 71%;">&nbsp;</div>
         <div style="width: 12%; padding-left:5px;padding-top:5px"> @if($vehicle->technical_doc_no)<span class="dot-line-notuse "><b>{{$vehicle->technical_doc_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif </div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;padding-top:5px;"> @if($vehicle->technical_doc_date)<span class="dot-line-notuse"><b>{{$vehicle->technical_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>

      <!-- ================================================ 4 ============================================ -->
      <div class="row" style="height:28px;">
         <div style="width: 71%;">&nbsp;</div>
         <div style="width: 12%; padding-left:5px;padding-top:5px;"> @if($vehicle->comerce_permit_no)<span class="dot-line-notuse"><b>{{$vehicle->comerce_permit_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif </div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;padding-top:5px;"> @if($vehicle->comerce_permit_date)<span class="dot-line-notuse"><b>{{$vehicle->comerce_permit_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>

      <!-- ================================================ 5 ============================================ -->
      <div class="row" style="height:29px;">
         <div style="width: 26%;">&nbsp;</div>
         <div class="div-chk" style="width: 14%; padding-left:10px;padding-top:11px">
            @if($vehicle->tax_10_40 ==1)
            <input type="checkbox" value="" {{ $vehicle->tax_10_40 ==1?'checked':''}}>
            @endif
         </div>
         <div class="div-chk" style="width: 8%;padding-left:5px;padding-top:10px">
            @if($vehicle->tax_exam ==1)
            <input type="checkbox" value="" {{ $vehicle->tax_exam ==1?'checked':''}}>
            @endif
         </div>
         <div class="div-chk" style="width: 8%;padding-left:8px;padding-top:10px">
            @if($vehicle->tax_12 ==1)
            <input type="checkbox" value="" {{ $vehicle->tax_12 ==1?'checked':''}}>
            @endif
         </div>
         <div class="div-chk" style="width: 15%;padding-left:15px;padding-top:9px">
            @if($vehicle->tax_50 ==1)
            <input type="checkbox" value="" {{ $vehicle->tax_50 ==1?'checked':''}}>
            @endif
         </div>
         <div style="width: 12%;padding-left:3px;padding-top:5px;"> @if($vehicle->tax_no)<span class="dot-line-notuse"><b>{{$vehicle->tax_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;padding-top:5px;"> @if($vehicle->tax_date)<span class="dot-line-notuse "><b>{{$vehicle->tax_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>

      <!-- ================================================ 6 ============================================ -->
      <div class="row " style="height:30px;">
         <div style="width: 22%;">&nbsp;</div>

         <div class="div-chk" style="width: 31%;padding-left:10px;padding-top:10px">
            @if($vehicle->tax_receipt ==1)
            <input type="checkbox" value="" {{ $vehicle->tax_receipt ==1?'checked':''}}>
            @endif
         </div>
         <div class="div-chk" style="width: 18%;padding-left:6px;padding-top:10px">
            @if($vehicle->tax_permit ==1)
            <input type="checkbox" value="" {{ $vehicle->tax_permit ==1?'checked':''}}>
            @endif
         </div>

         <div style="width: 12%;padding-left:5px;padding-top:5px;"> @if($vehicle->tax_payment_no)<span class="dot-line-notuse "><b>{{$vehicle->tax_payment_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;padding-top:5px;"> @if($vehicle->tax_payment_date)<span class="dot-line-notuse "><b>{{$vehicle->tax_payment_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>

      <!-- ================================================ 7 ============================================ -->
      <div class="row" style="height:30px;">
         <div style="width: 71%;">&nbsp;</div>
         <div style="width: 12%;padding-left:5px;padding-top:5px;"> @if($vehicle->police_doc_no)<span class="dot-line-notuse"><b>{{$vehicle->police_doc_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif </div>
         <div style="width: 4%;">&nbsp;</div>
         <div style="width: 12%;padding-top:5px;">@if($vehicle->police_doc_date)<span class="dot-line-notuse"><b>{{$vehicle->police_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <!-- ============================================================================================== -->
      <div class="row" style="height:120px;">&nbsp;</div>
      <div class="row" style="height:30px;">
         <div style="width: 67%;">&nbsp;</div>
         <div style="width: 14%;padding-top:4px;"> @if($vehicle->location) <span class="dot-line-notuse"><b>{{ $vehicle->location }}</b></span>, @else <b></b> @endif </div>
         <div style="width: 3%;">&nbsp;</div>
         <div style="width: 12%;">
            @if($vehicle->issue_date)
            <span class="dot-line-notuse"><b>{{$vehicle->issue_date}}</b> </span>
            @else <b></b> @endif
         </div>
      </div>
      <div class="row" style="height:30px;">
         <div class="col-md-12">

            <div class="row">
               <div class="col-md-4 col-md-offset-8">
                  <label for="test">&nbsp;</label>
                  <span style="color: #000;"><b></b>
                  </span>
               </div>
               <div class="col-md-4">
                  <label for="test">&nbsp; </label>
                  <span style="color: #000;"><b></b>
                  </span>
               </div>
               <div class="col-md-4">
                  <label for="test">&nbsp;</label>
                  <span style="color: #000;"><b></b>
                  </span>
               </div>
            </div>
            <br />
            <div class="row">
               <div class="col-md-8">&nbsp;
               </div>
               <div class="col-md-4">
                  <label for="test">&nbsp;</label> <br />
                  <label for="test">&nbsp;</label> <br />
                  <label for="test">&nbsp; </label> <br />
               </div>
            </div>
            <div class="row" style="position: fixed;bottom:1px">
               <div class="col-md-12">
                  <label for="test">Application Form version 1.0 Staff</label>
                  </span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>