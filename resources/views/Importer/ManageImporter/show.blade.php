@extends('layouts.master')
@section('user','active')
@section('content')

<!-- begin #content -->
<h1 class="page-header">User Detail</h1>
<div class="panel panel-inverse">
  
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <img @if($user->user_photo) src="{{asset('images/user/'.$user->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif width="150px">
                }
                }
                </div>
                <div class="col-md-3 col-sm-3">
                      <h5 class="media-heading">{{ $user->name }}</h5>
                <p>{{$user->login_id}}<br/>{{ $user->email }}<br/>{{$user->phone}}<br/>
                    {{$user->position}}<br/>@if($user->department_id){{$user->department->name}}({{$user->department->name_en}})@endif</p>
                <p>@if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-info">{{ $v }}</label>
                @endforeach
            @endif</p>
                </div>
            </div>
             
      
            
        
    </div>
    
   
</div>
        </div>
</div>
        <!-- end panel-body -->
     

@endsection

@push('page_scripts')

<script type="text/javascript">
  
     var myTable = $('#myTable').DataTable(); 
   </script>
@endpush