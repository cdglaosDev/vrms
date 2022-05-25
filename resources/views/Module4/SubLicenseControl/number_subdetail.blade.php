@extends('vrms2.layouts.master')
@section('vims','active')
@section('content') 
<h3>{{ trans('module4.sub_lic_title') }}</h3>
<div class="card-body">
   <div class="table-responsive">
      <table id="myTable" class="table table-striped">
         <thead>
            <tr>
               <th>{{ trans('module4.license_no') }}</th>
               <th>{{ trans('module4.sub_lic_owner_occupant') }}</th>
               <th>{{ trans('module4.control_veh_kind') }}</th>
               <th>{{ trans('module4.village_name') }}</th>
               <th>{{ trans('module4.district_name') }}</th>
               <th>{{ trans('module4.province_name') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($vehicle as $item)
            <tr>
               <td>@if($item->licence_no)<a class="btn btn-info" data-id="{{$item->id}}" onclick="vehicleModal(this, 'Load')">{{ $item->licence_no }}</a>@endif</td>
               <td>{{ $item->owner_name }}</td>
               <td>{{ $item->vehicle_kind_name }}</td>
               <td>{{ $item->village_name }}</td>
               <td>{{ $item->district_name }}</td>
               <td>{{ $item->province_name }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection

@push('page_scripts')
<script type="text/javascript">
  //========================================= Vehicle Modal Start =========================================
  function vehicleModal(data) {
    var id = $(data).data('id');

    var vModal = getVehicleModal(id);

    // Init the modal if it hasn't been already.
    if (!vModal) {
      vModal = initVehicleModal(id);
    }

    var html =
      '<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">' +
      '<h3  class="modal-title" style="width:98%; margin-top:-8px; font-size: 19px; border-bottom:none;color:blue;font-weight:bold;">' +
      '{{ trans("module4.vehicle_title") }}' +
      '<ul class="nav nav-tabs pt-2" style="width: 1100px;">' +
      '<li class="nav-item">' +
      '<a class="nav-link active" data-toggle="tab" aria-current="page" href="#vehicleInfo' + id + '">{{ trans("module4.veh_info") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#log' + id + '">{{ trans("module4.history_of_change") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#document' + id + '">{{ trans("module4.document") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#tenant-info' + id + '">{{ trans("module4.tenant_info") }}</a>' +
      '</li>' +
      '</ul>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body v' + id + '"  style="padding: 0px 10px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setVehicleModalContent(html, id);

    // Show the modal.
    $(vModal).modal('show');
    // ---------------

    $.ajax({
        url: "/show_vehicle/" + id,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        $('.v' + id).html(data);

      })
      .fail(function() {
        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#modal-loader').hide();
      });
    /* -------- */

    // Jquery draggable
    $('.modal-dialog').draggable({
      handle: ".modal-body, .modal-header"
    });

    $(vModal).on('hidden.bs.modal', function(e) {
      $("#dModaldm").remove();
      $(this).remove();
    });

  }

  function getVehicleModal(id) {
    return document.getElementById('vModal' + id);
  }

  function setVehicleModalContent(html, id) {
    getVehicleModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initVehicleModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'vModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'vehicleModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" style="position: fixed;top: -23px;display: block;left: 5%;">' +
      '<div class="modal-content">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //width:1190px;height:830px
  //========================================= Vehicle Modal End =========================================
  </script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  @endpush