@extends('layouts.master')
@section('action_log','active')
@section('content') 
    <h1 class="page-header">{{trans('sidebar.action_log')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
    <div class="modal-body">
        <h4><span>{{trans('sidebar.action_log')}}</span></h4>
        <table class="table table-striped table-bordered" style="width: 100%">
            <tbody>
                <tr>
                    <td width="300px">{{trans('title.tbl_name')}}</td>
                    <td>{{$action_log-> table_name}} </td>
                </tr>
                <tr>
                    <td width="200px">{{trans('title.user_id')}}</td>
                    <td>@if(isset($action_log -> users -> first_name)){{$action_log -> users -> first_name}} {{$action_log -> users -> last_name}} ({{$action_log -> users -> login_id}})@else{{"_"}}@endif</td>
                </tr>
                <tr>
                    <td width="200px">{{trans('title.active_action')}}</td>
                    <td>{{$action_log -> action}}</td>
                </tr>
                <tr>
                    <td width="300px">{{trans('title.active_date')}}</td>
                    <td>{{date('d-m-Y',strtotime($action_log -> date))}} </td>
                </tr>
                <tr>
                    <td width="200px">{{trans('title.ip_address')}}</td>
                    <td>{{$action_log -> ip_address}}</td>
                </tr>
                <tr>
                    <td width="200px">{{trans('Action Detail')}}</td>
                    <td>    
                        @foreach(explode(',',$detail) as $row)
                            <p>{{ $row }}</p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
            <div class="modal-footer">
                <a href="/action-log" class="btn btn-secondary">{{trans('finance_button.cancel')}}</a>
            </div>
        </div>
    </div>
@endsection
