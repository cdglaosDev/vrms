@extends('vrms2.layouts.master')
@section('anno_page','active')
@section('content')
@can('Annoucement-Create')

<h3><a class="btn btn-warning" href="{{ url('/announcement/create') }}">{{ trans('title.new_annouce') }}</a></h3>
@endcan
<div class="card-body">
   <div class="w3-container" method="post" action="#" enctype="multipart/form-data">
      <table class="vehicles-list table  table-bordered" >
         <thead>
            <tr>
               <td>{{ trans('title.row') }}</td>
               <td>{{ trans('title.text_subject') }}</td>
               <td>{{ trans('common.date') }}</td>
               <td>{{ trans('title.user') }}</td>
               <td>{{ trans('title.pin') }}</td>
               <td colspan="3">{{ trans('common.action') }}</td>
            </tr>
         </thead>
         <tbody>
            @php
                $i =0;
            @endphp
            @foreach($announ as $index=>$data)
            @php
                $number_pin = \App\Model\Announcement::select('pin')->orderByDesc('pin')->whereStatus(1)->first();
               
            @endphp
            <tr id="tr{{$data->id}}" >
               <td align="center" width="ໂ">{{ $index+1}}</td>
               <td>{{ $data->text_subject}}</td>
               <td align="center">{{date('d-m-Y', strtotime($data->log_date))}}</td>
               <td>{{ $data->user->name}}</td>
               <td align="center"><input type="checkbox" id="pin{{$data->id}}" {{$data->pin !=0 ?"checked":''}}  name="pin[{{$data->id}}]" 
                  class="check_box" data-id="{{ $data->id }}">
               </td>
               @if($data->pin != 0)
               <td align="center">
                   <a href="" class="up_time"  data-id="{{$data->id}}" data-number = "{{ $data->pin }}" data-status="pin"  @if($data->pin == $number_pin->pin) style="display:none" @endif >
                       <img src="{{ asset('vrms2/css/resources/up.png') }}" border="0" >
                    </a>
                </td>
               <td>
                   <a href="" class="down_time"  data-id="{{ $data->id}}" data-number="{{ $data->pin }}"  data-status="pin" @if($data->pin == 1) style="display:none" @endif >
                       <img src="{{ asset('vrms2/css/resources/down.png') }}" border="0">
                    </a>
                </td>
               @else
               <td align="center">
                   <a class="up_time"   data-id="{{$data->id}}" data-number = "{{ $data->number }}" data-status="num" @if($data->number == 1) style="display:none" @endif >
                       <img src="{{ asset('vrms2/css/resources/up.png') }}" border="0">
                    </a>
                </td>
               <td>
                   <a href="" class="down_time"  data-id="{{ $data->id}}" data-number="{{ $data->number }}" data-status="num" @if($index+1 == $data->count()) style="display:none" @endif >
                       <img src="{{ asset('vrms2/css/resources/down.png') }}" border="0">
                    </a>
                </td>
               @endif
               <td>
                @can('Annoucement-Edit')
                  <a href="{{ route('announcement.edit', $data->id) }}" class="btn btn-light">{{ trans('button.edit') }}</a>
                @endcan
                <a class="btn btn-sm btn-danger  delete_btn"
                  data-toggle="modal" data-target="#deleteModel"
                  data-act="Delete" data-backdrop="static" data-keyboard="false"
                  data-id="{{$data->id}}">{{ trans('button.delete') }}
                </a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
</div>
   <a href="{{ url('/announcement-page-list') }}" style="text-decoration:underline">❮❮ {{ trans('title.go_back') }}</a>
</div>
@include('delete')
@endsection
@push('page_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(document).on("click", '.delete_btn', function (e) { 
           document.getElementById("deleteform").action = '/announcement-del'+"/"+$(this).data('id');
   });
    function MakeColorOnMouseOver(ctrl){
    document.getElementById(ctrl).bgColor='#D6EEEE'
  }
  function MakeColorOnMouseOut(ctrl){
    document.getElementById(ctrl).bgColor='#FFFFFF'
  }
   $(document).on("click", '.up_time', function(e) {
   
        var id = $(this).data('id');
        var number = $(this).data('number');
        var status = $(this).data('status');
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
    if(status == 'pin' && id != ''){
       
        $.ajax({
           url: "/up_pin_post",
           method: "POST",
           data: {id: id, number:number, status: status},
           dataType: "json",
           success:function(data) {
               if(data.status == 200){
                   window.location.reload(true);
               } else {
                alert('Some problem occurred, please try again.');
               }
            }
        });
    } else {
        $.ajax({
           url: "/update_up_itme",
           method: "POST",
           data: {id:id, number:number, status:status},
           dataType: "json",
           success:function(data) {
               if(data.status == 200){
                   window.location.reload(true);
               } else {
                alert('Some problem occurred, please try again.');
               }
            }
        });
    }
   });  
   
    //down function when click down arrow
    $(document).on("click", '.down_time', function(e) {
        
        var id = $(this).data('id');
        var number = $(this).data('number');
        var status = $(this).data('status');
      
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       if(status == 'pin' && id != ''){
            $.ajax({
                url: "/down-pin",
                method: "POST",
                data: {id: id, number: number, status: status},
                dataType: "json",
                success:function(data) {
                    if(data.status == 200){
                        window.location.reload(true);
                    }
                }
        
            });
       } else {
            $.ajax({
                    url: "/update-down",
                    method: "POST",
                    data: {id: id, number: number, status: status},
                    dataType: "json",
                    success:function(data) {
                        if(data.status == 200){
                            window.location.reload(true);
                        }

                    }
            
            });
       }
   }); 
   
    //checkbox function
    $(document).on("click", '.check_box', function(e) {
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       if($(this).prop("checked") == true){
               $.ajax({
               url: "/checkPin",
               method: "POST",
               data: {id: $(this).data('id')},
               dataType: "json",
               success:function(data) {
                   if(data.status == 200){
                       window.location.reload(true);
                   }
               }
   
           });
       } else {
           $.ajax({
           url: "/dropPin",
           method: "POST",
           data: {id: $(this).data('id')},
           dataType: "json",
           success:function(data) {
               if(data.status == 200){
                   window.location.reload(true);
               }
           }
   
       });
       }
   });  
   
</script>
@endpush