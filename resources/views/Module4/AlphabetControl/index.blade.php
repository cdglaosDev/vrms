@extends('vrms2.layouts.master')
@section('alphabet_control','active')
@section('content')
@include('vrms2.mod4-submenu')
<style>
   .dataTables_info {
      padding-top: 5px;
      padding-right: 50vh;
   }

   #tbl_alphabet_ctrl th {
      padding-left: 0px;
   }

   #tbl_alphabet_ctrl td {
      padding: 2px 4px;
   }
</style>
@php
$alphabetControl = \App\Model\LicenseAlphabetControl::AlphabetControl();
@endphp
<h3>{{ trans('module4.alphabet_control') }}
   @can('Alphabet-Control-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body" style="padding-top: 0px;">
   <div class="table-responsive">
      <table id="tbl_alphabet_ctrl" class="table table-striped" style="width:100%">
         <thead>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <th>{{ trans('module4.no') }}</th>
               <th>{{ trans('module4.alphabet') }}</th>
               <th>{{ trans('module4.alphabet_next') }}</th>
               <th style="width: 15%;">{{ trans('common.province') }}</th>
               <th>{{ trans('module4.vehicle_group') }}</th>
               <th>{{ trans('module4.vehicle_kind') }}</th>
               <th>{{ trans('common.status') }}</th>
               <th>{{ trans('common.action') }}</th>
            </tr>
         </thead>

         <tfoot>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
         </tfoot>

         <tbody>
            @foreach($alphabet_control as $key=>$alphabet)
            <tr>
               <td>{{ ++$key }}</td>
               <td>{{$alphabet->licAlphabet-> name ?? ''}}</td>
               <td>{{$alphabet->licAlphabetNext-> name ?? ''}}</td>
               <td>{{$alphabet->province->name??''}}({{$alphabet->province->name_en ?? ''}})</td>
               <td>{{$alphabet->vehicleTypeGroup->name??''}}</td>
               <td>
                  {{$alphabet->vehicleKind->name ?? ''}}
               </td>
               <td>{{ $alphabet->licAlphaControlStatus->name ?? ''}}</td>
               <td>
                  @can('Alphabet-Control-Edit')
                  <a href="#" class="btn_edit" data-url="{{ route('alphabet-control.edit',['id'=>$alphabet->id])}}" 
                  data-id="{{ $alphabet->id }}" 
                     data-toggle="modal"  data-target="#editModel" data-backdrop="static" data-keyboard="false">
                     <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
                  @endcan
                  @can('Alphabet-Control-Delete')
                  <a href="#" class="delete_btn" data-toggle="modal" data-target="#deleteModel" 
                  data-backdrop="static" data-keyboard="false" data-id="{{$alphabet->id}}">
                  <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a>
                  @endcan
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>


   </div>
</div>
<!-- show role modal popup -->
<div class="modal fade" id="editModel" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
<!-- end show role modal popup -->
@include('Module4.AlphabetControl.Modal')
@include('delete')
@endsection
@push('page_scripts')
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
<script type="text/javascript">
   var base_url = "{{url('/alphabet-control')}}";

   //-----------------------------------------------------------------------------------
   /* Plugin API method to determine is a column is sortable */
   $.fn.dataTable.Api.register('column().searchable()', function() {
      var ctx = this.context[0];
      return ctx.aoColumns[this[0]].bSearchable;
   });

   function createDropdowns(api) {
      api.columns().every(function() {
         if (this.searchable()) {
            var that = this;
            var col = this.index();

            // Only create if not there or blank
            var selected = $('thead tr:eq(0) td:eq(' + col + ') select').val();
            if (selected === undefined || selected === '') {
               // Create the `select` element
               $('thead tr:eq(0) td')
                  .eq(col)
                  .empty();

               var text = "";
               if (col == 1) {
                  text = "{{ trans('module4.select_alphabet') }}";
               } else if (col == 3) {
                  text = "{{ trans('module4.select_province') }}";
               } else if (col == 4) {
                  text = "{{ trans('module4.select_type_group') }}";
               } else if (col == 5) {
                  text = "{{ trans('module4.select_vehicle_kind') }}";
               } else if (col == 6) {
                  text = "{{ trans('module4.select_status') }}";
               } else {
                  text = "-- Select --";
               }

               var select = $('<select><option value="">' + text + '</option></select>')

                  .appendTo($('thead tr:eq(0) td').eq(col))
                  .on('change', function() {
                     that.search($(this).val()).draw();
                     createDropdowns(api);
                  });

               api
                  .cells(null, col, {
                     search: 'applied'
                  })
                  .data()
                  .sort()
                  .unique()
                  .each(function(d) {
                     select.append($('<option>' + d + '</option>'));
                  });
            }
         }
      });
   }

   $(document).ready(function() {
      // Create the DataTable
      var table = $('#tbl_alphabet_ctrl').DataTable({
         fixedHeader: true,
         orderCellsTop: true,
         order: false,
         lengthMenu: [
            [25, 50, 75, 100],
            [25, 50, 75, 100]
         ],
         dom: '<"top">tr<"bottom"ilp><"clear">',
         columnDefs: [{
            searchable: false,
            targets: [0, 2, 7]
         }],
         initComplete: function() {
            createDropdowns(this.api());
         }
      });
   });
   //-----------------------------------------------------------------------------------

   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.btn_edit', function(e) {
      $('[name="province_code"]').val($(this).data('province_code')).change();
      $('[name="vehicle_type_group_id"]').val($(this).data('vehicle_type_group_id'));
      $('[name="license_alphabet_id"]').val($(this).data('license_alphabet_id')).change();
      $('[name="license_alphabet_control_status_id"]').val($(this).data('license_alphabet_control_status_id'));
      $('[name="vehicle_kind_code"]').val($(this).data('vehicle_kind_code'));
      $('[name="license_alphabet_next_id"]').val($(this).data('license_alphabet_next_id')).change();
      //document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var licAlphabet = $('#addModel .lic-alphabet');
      var province = $("#addModel .province");
      var vehicleKind = $("#addModel .vehicle_kind");
      var vtype = $("#addModel .vtype");
      var alphabetNext = $("#addModel .alphabet_next");
      var status = $("#addModel .status");
      var form = $("#newForm");
      checkLicenseAlphabet("0", licAlphabet, province, vehicleKind, vtype, alphabetNext, status, form);

   });

   // $('#update-form').click(function(e) {
   //    e.preventDefault();
   //    var licAlphabet = $('#editModel .lic-alphabet');
   //    var province = $("#editModel .province");
   //    var vehicleKind = $("#editModel .vehicle_kind");
   //    var vtype = $("#editModel .vtype");
   //    var alphabetNext = $("#editModel .alphabet_next");
   //    var status = $("#editModel .status");
   //    var form = $("#editform");
   //    checkLicenseAlphabet(licAlphabet, province, vehicleKind, vtype, alphabetNext, status, form);
   // });

   function checkLicenseAlphabet(id, licAlphabet, province, vehicleKind, vtype, alphabetNext, status, form) {
      var url = "/check-license-alphabet?veh_kind=" + vehicleKind.val() + "&province_code=" + province.val() 
      + "&vtype=" + vtype.val() + "&status=" + status.val() + "&alphabet=" + licAlphabet.val()
      + "&id=" + id;
      $.get(url, function(response) {
         if (licAlphabet.val() == '') {
            alert($('.lic-alphabet').attr('title'));
            licAlphabet.focus();
            return false;

         } else if (province.val() == null) {
            alert($('.province').attr('title'));
            province.focus();
            return false;

         } else if (vehicleKind.val() == null) {
            alert($(".vehicle_kind").attr('title'));
            vehicleKind.focus();
            return false;
         } else if (response.status == "used") {
            alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
            return false;
         } else if (vtype.val() == null) {
            alert($(".vtype").attr('title'));
            vtype.focus();
            return false;
         } else if (status.val() == null) {
            alert($(".status").attr('title'));
            status.focus();
            return false;
         } else if (alphabetNext.val() == null) {
            alert($(".alphabet_next").attr('title'));
            alphabetNext.focus();
            return false;
         } else if (alphabetNext.val() == licAlphabet.val()) {
            alert($('.alert-duplicate').text());
            return false;
         } else {
            form.submit();
         }
      });
   }

   $('.check-alphabet').click(function() {
      var province_code = $(".province").val();
      var vehicle_kind_code = $(".vehicle_kind").val();
      var vtype = $(".vtype").val();
      checkAlphabet(province_code, vehicle_kind_code, vtype);
   });

   function checkAlphabet(province_code, vehicle_kind_code, vtype) {
      if (province_code != null && vehicle_kind_code != null && vtype != null) {
         $.ajax({
            type: "GET",
            url: '/get-alphabet',
            data: {
               province_code: province_code,
               vehicle_kind_code: vehicle_kind_code,
               vtype: vtype
            },
            dataType: 'json',
            headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response) {
               if (response) {
                  $(".lic-alphabet").empty();
                  $(".lic-alphabet").append('<option value="" selected disabled hidden> Select</option>');
                  $.each(response, function(key, value) {
                     $(".lic-alphabet").append('<option value="' + key + '">' + value + '</option>');
                  });
                  $(".lic-alphabet").prop('disabled', false);
               } else {
                  $(".lic-alphabet").empty();
               }
            }
         });
      } else {
         $(".lic-alphabet").prop('disabled', true);
         alert('Need to choose Province, vehicle kind and vehicle type group.');
      }
   }
   $(".lic-alphabet").change(function(){
     $("#used_lic_alpha").val($(this).val());
   });
   // check alphabet next
   $('.check-alphabet-next').click(function() {
      var province_code = $(".province").val();
      var vehicle_kind_code = $(".vehicle_kind").val();
      var selected_alpha =  $("#used_lic_alpha").val();
      var vtype = $(".vtype").val();
      checkAlphabetNext(province_code, vehicle_kind_code, vtype, selected_alpha);
   });

   function checkAlphabetNext(province_code, vehicle_kind_code, vtype, selected_alpha) {
     
      if (province_code != null && vehicle_kind_code != null && vtype != null) {
         $.ajax({
            type: "GET",
            url: '/get-alphabet-next',
            data: {
               province_code: province_code,
               vehicle_kind_code: vehicle_kind_code,
               vtype: vtype,
               selected_alpha: selected_alpha
            },
            dataType: 'json',
            headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response) {
               if (response) {
                  $(".alphabet_next").empty();
                  $(".alphabet_next").append('<option value="" selected disabled hidden> Select</option>');
                  $.each(response, function(key, value) {
                     $(".alphabet_next").append('<option value="' + key + '">' + value + '</option>');
                  });
                  $(".alphabet_next").prop('disabled', false);
               } else {
                  $(".alphabet_next").empty();
               }
            }
         });
      } else {
         $(".alphabet_next").prop('disabled', true);
         alert('Need to choose Province, vehicle kind and vehicle type group.');

      }
   }


   // $('.province, .vehicle_kind, .vtype').change(function(){
   //     $(".lic-alphabet").prop('disabled', true);
   //     $(".alphabet_next").prop('disabled', true);
   // });
</script>

@endpush