@extends('vrms2.layouts.master')
@section('display_setting','active')
@section('content')
@include('DisplaySetting.submenu')
<h3>{{trans('title.display_setting')}}
  @can('Display-Setting-Create')
  <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary text-white btn-sm btn-save">{{trans('common.add_new')}}</a>
  @endcan
</h3>

@include('flash')

<div class="card-body">
  <table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th>Dept</th>
        <th>Text One</th>
        <th>Text Two</th>
        <th>Text Three</th>
        <th>Title</th>
        <th>Status</th>
        <th>{{ trans('common.action') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($display_setting as $data)
      <tr>
        <td>{{$data->department_id}}</td>
        <td>{{$data->text1}}</td>
        <td>{{$data->text2}}</td>
        <td>{{$data->text3}}</td>
        <td>{{$data->title}}</td>
        <td>{{$data->status ==1 ?'Active':'Deactive'}}</td>
        <td>
          @can('Display-Setting-Edit')
          <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false" data-act="Edit" data-department_id="{{ $data->department_id }}" data-text1="{{ $data->text1 }}" data-text2="{{ $data->text2 }}" data-text3="{{ $data->text3 }}" data-title="{{ $data->title }}" data-status="{{ $data->status }}" data-id="{{$data->id}}">
            <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px">
          </a>
          @endcan
          @can('Display-Setting-Delete')
          <a href="" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-id="{{$data->id}}">
            <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
          </a>
          @endcan
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>

@include('delete')
@include('DisplaySetting.model')
@endsection
@push('page_scripts')

<script type="text/javascript">
 
  var base_url = "{{url('/display-setting')}}";
  $(document).on("click", '.delete_btn', function(e) {
    document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
  });

  $(document).on("click", '.edit_btn', function(e) {
    $('[name="text1"]').val($(this).data('text1'));
    $('[name="text2"]').val($(this).data('text2'));
    $('[name="text3"]').val($(this).data('text3'));
    $('[name="title"]').val($(this).data('title'));
    $('[name="department_id"]').val($(this).data('department_id')).attr('selected', 'selected');
    $('[name="status"]').val($(this).data('status'));
    document.getElementById("editform").action = base_url + "/" + $(this).data('id');
  });
</script>
@endpush