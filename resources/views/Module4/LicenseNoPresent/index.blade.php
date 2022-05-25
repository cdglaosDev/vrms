@extends('vrms2.layouts.master')
@section('lic_present','active')
@section('content')
@include('vrms2.mod4-submenu')
<style>
   .dataTables_info {
      padding-top: 5px;
      padding-right: 50vh;
   }

   #tbl_lic_present th {
      padding-left: 0px;
   }

   #tbl_lic_present td {
      padding: 2px 4px;
   }
</style>
<h3>{{ trans('module4.lic_present_title') }}
   @can('License-Present-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body" style="padding-top: 0px;">
   <div class="table-responsive">
      <table id="tbl_lic_present" class="table table-striped" style="width:100%">
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
               <th>{{ trans('module4.no')}}</th>
               <th>{{ trans('module4.lic_alphabet')}}</th>
               <th> {{ trans('module4.number_code')}}</th>
               <th style="width: 15%;">{{ trans('common.province_code')}}</th>
               <th>{{ trans('module4.vehicle_type')}}</th>
               <th>{{ trans('module4.vehicle_kind')}}</th>
               <th>{{ trans('common.status')}}</th>
               <th>{{ trans('common.action')}}</th>
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
            @foreach($license_no_presents as $key=>$data)
            <tr>
               <td>{{ ++$key }}</td>
               <td>{{ $data->licenseAlphabet->name ?? ''}}</td>
               <td>{{ $data->license_no_present_number }}</td>
               <td>{{ $data->province->name ?? '' }}({{ $data->province->name_en ?? ''}})</td>
               <td>{{ $data->vehicleTypeGroup->name?? ''}}</td>
               <td>{{ $data->vehicleKind->name?? ''}}</td>
               <td>{{ $data->status }}</td>
               <td>
                  @can('License-Present-Edit')
                  <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false" data-province_code="{{ $data->province_code }}" data-vehicle_type_group_id="{{ $data->vehicle_type_group_id }}" data-license_alphabet_id="{{ $data->license_alphabet_id }}" data-license_no_present_number="{{ $data->license_no_present_number }}" data-vehicle_kind_code="{{ $data->vehicle_kind_code }}" data-alert_license_present="{{ $data->alert_license_present }}" data-id="{{ $data->id }}" data-status="{{ $data->status }}">
                     <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
                  @endcan
                  @can('License-Present-Delete')
                  <a href="" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$data->id}}">
                     <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a>
                  @endcan
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@include('delete')
@include('Module4.LicenseNoPresent.Modal')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('license-no-present')}}";

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
      var table = $('#tbl_lic_present').DataTable({
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

   $(document).on("click", '.edit_btn', function(e) {

      $('[name="province_code"]').val($(this).data('province_code')).change();
      $('[name="vehicle_type_group_id"]').val($(this).data('vehicle_type_group_id'));
      $('[name="vehicle_kind_code"]').val($(this).data('vehicle_kind_code'));
      $('[name="license_no_present_number"]').val($(this).data('license_no_present_number'));
      $('[name="alert_license_present"]').val($(this).data('alert_license_present'));
      $('[name="status"]').val($(this).data('status')).attr('selected', 'selected');
      $("#edit-id").val($(this).data('id'));

      // $('[name="license_alphabet_id"]').val($(this).data('license_alphabet_id')).change();
      getAlphabetControl_edit($(this).data('province_code'), $(this).data('vehicle_kind_code'), $(this).data('vehicle_type_group_id'), $(this).data('license_alphabet_id'));

      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });


   //change maxlength depend on change vehicle kind
   $('#addModel .vehicle_kind').change(function() {
      $('.license_no').val("");
      var kind = $(this).val();
      var province_code = $("#addModel .province_code").val();
      var veh_type = $("#addModel .type_group").val();

      $(".upd_kind").val(kind);
      if (kind == 1 || kind == 2 || kind == 3 || kind == 4 || kind == 6) {
         $(this).attr('maxlength', 4);
      } else {
         $(this).attr('maxlength', 5);
      }

      getAlphabetControl(province_code, kind, veh_type);
   });

   $('#addModel .province_code').change(function() {
      var province_code = $(this).val();
      var veh_type = $("#addModel .type_group").val();
      var veh_kind = $("#addModel .vehicle_kind").val();

      getAlphabetControl(province_code, veh_kind, veh_type);
   });

   $('#addModel .type_group').change(function() {
      var veh_type = $(this).val();
      var province_code = $("#addModel .province_code").val();
      var veh_kind = $("#addModel .vehicle_kind").val();

      getAlphabetControl(province_code, veh_kind, veh_type);
   });

   //check status function 
   function getAlphabetControl(province_code, veh_kind, veh_type) {
      $('.lic_alphabet').empty();
      $('.lic_alphabet').append('<option value="">Select License Alphabet</option>');

      // alert(province_code + "::" + veh_kind + "::" + veh_type);
      var url = "/get_alphabet_control?province_code=" + province_code + "&vehicle_kind=" + veh_kind + "&vehicle_type_group=" + veh_type;
      $.get(url, function(response) {
         console.log(response);
         if (response) {
            $.each(response, function(key, value) {
               $('#addModel .lic_alphabet').append('<option value="' + key + '">' + value + '</option>');
            });
         }
      })
   }

   //change maxlength depend on change vehicle kind
   $('#editModel .vehicle_kind').change(function() {
      $('.license_no').val("");
      var kind = $(this).val();
      var province_code = $("#editModel .province_code").val();
      var veh_type = $("#editModel .type_group").val();

      $(".upd_kind").val(kind);
      if (kind == 1 || kind == 2 || kind == 3 || kind == 4 || kind == 6) {
         $(this).attr('maxlength', 4);
      } else {
         $(this).attr('maxlength', 5);
      }

      getAlphabetControl_edit(province_code, kind, veh_type, "");
   });

   $('#editModel .province_code').change(function() {
      var province_code = $(this).val();
      var veh_type = $("#editModel .type_group").val();
      var veh_kind = $("#editModel .vehicle_kind").val();

      getAlphabetControl_edit(province_code, veh_kind, veh_type, "");
   });

   $('#editModel .type_group').change(function() {
      var veh_type = $(this).val();
      var province_code = $("#editModel .province_code").val();
      var veh_kind = $("#editModel .vehicle_kind").val();

      getAlphabetControl_edit(province_code, veh_kind, veh_type, "");
   });

   //check status function 
   function getAlphabetControl_edit(province_code, veh_kind, veh_type, license_alphabet_id) {
      if (license_alphabet_id == "") {
         $('.lic_alphabet').empty();
         $('.lic_alphabet').append('<option value="">Select License Alphabet</option>');
      }

      console.log(province_code + "::" + veh_kind + "::" + veh_type);
      var url = "/get_alphabet_control?province_code=" + province_code + "&vehicle_kind=" + veh_kind + "&vehicle_type_group=" + veh_type;
      $.get(url, function(response) {
         console.log(response);
         if (response) {
            $.each(response, function(key, value) {
               if (license_alphabet_id != "") {
                  if (license_alphabet_id == key) {
                     $('#editModel .lic_alphabet').append('<option value="' + key + '" selected>' + value + '</option>');
                  } else {
                     $('#editModel .lic_alphabet').append('<option value="' + key + '">' + value + '</option>');
                  }
               } else {
                  $('#editModel .lic_alphabet').append('<option value="' + key + '">' + value + '</option>');
               }

            });
         }
      })
   }


   //--------------------------------------------------------
   //check space for license no booking input box
   $('.license_no').keyup(function() {
      var vehicle_kind = $('.upd_kind').val();
      var originKind = $(".vehicle_kind").val();
      if (vehicle_kind == null) {
         alert("You must choose vehicle kind.");
         return false;
      }
      if (vehicle_kind == 5 || vehicle_kind == 8 || originKind == 5 || originKind == 8) {
         $(this).attr('maxlength', 5);
         var code = $(this).val();
         code = code.replace(/[^0-9-_]/g, '');
         $(this).val(code);
      } else {
         $(this).attr('maxlength', 4);
         var code = $(this).val();
         code = code.replace(/[^0-9_]/g, '');
         $(this).val(code);
      }
   });

   // record save into database
   $('#present-new').click(function(e) {
      e.preventDefault();
      var province_code = $('#province');
      var vehicle_kind = $("#addModel .vehicle_kind");
      var type_group = $("#addModel .type_group");
      var lic_alphabet = $("#addModel .lic_alphabet")
      var lic_no = $("#addModel .lic_no")
      var alert_lic_no = $("#addModel .alert_lic_no")
      var status = $("#addModel .status");
      var oldId = $("#new-id").val();
      var form = $("#newForm");
      insertPresentRecord(province_code, vehicle_kind, type_group, lic_alphabet, lic_no, alert_lic_no, status, form, oldId);
   });

   $('#present-update').click(function(e) {
      e.preventDefault();
      var province_code = $('#edit-province');
      var vehicle_kind = $("#editModel .vehicle_kind");
      var type_group = $("#editModel .type_group");
      var lic_alphabet = $("#editModel .lic_alphabet")
      var lic_no = $("#editModel .lic_no")
      var alert_lic_no = $("#editModel .alert_lic_no")
      var status = $("#editModel .status");
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertPresentRecord(province_code, vehicle_kind, type_group, lic_alphabet, lic_no, alert_lic_no, status, form, oldId);
   });

   function insertPresentRecord(province_code, vehicle_kind, type_group, lic_alphabet, lic_no, alert_lic_no, status, form, oldId) {
      var url = "/get-license-present?province=" + province_code.val() + "&id=" + oldId + "&status=" + status.val() + "&vehicle_kind=" + vehicle_kind.val() + "&type_group=" + type_group.val() + "&lic_no=" + lic_no.val() + "&alphabet=" + lic_alphabet.val();
      $.get(url, function(response) {
         if (vehicle_kind.val() == null) {
            alert($('.vehicle_kind').attr('title'));
            return false;
         } else if (type_group.val() == null) {
            alert($('.type_group').attr('title'));
            return false;
         } else if (lic_alphabet.val() == null) {
            alert($('.lic_alphabet').attr('title'));
            return false;
         } else if (lic_no.val() == '') {
            alert($('.license_no').attr('title'));
            return false;
         } else if (province_code.val() == null) {
            alert($('[name="province_code"]').attr('title'));
            return false;
         } else if (alert_lic_no.val() == '') {
            alert($('.alert_lic_no').attr('title'));
            return false;
         } else if (parseInt(alert_lic_no.val()) < parseInt(lic_no.val())) {
            alert($('.alert_lic_no').attr('title1'));
            return false;
         } else if (status.val() == null) {
            alert($('.status').attr('title'));
            return false;
         } else if (response.lic_present != null) {
            alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
            return false;
         } else if (response.vehicle != null) {
            alert($('.lic_no').attr('title1'));
            return false;
         } else {
            form.submit();
         }

      });
   }
</script>
@endpush