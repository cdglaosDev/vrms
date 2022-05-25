@extends('vrms2.layouts.master')
@section('anno_page','active')
@section('content')
<style>
   .box1 {
      width:auto; 
      height:auto;
   }
   img{
      max-width: 100%;
      height: auto;
   }
</style>
<h3>
   @can('Annoucement-List-View')
   <a class="btn w3-light-blue" href="{{ url('/announcement') }}">{{ trans('title.manage_announce') }}</a>
   @if(!$topAnno)
   <a class="w3-btn w3-light-blue" href="{{ url('/announcement/create') }}">{{ trans('title.new_annouce') }}</a>
   @endif
   @endcan
</h3>
<div class="card-body">
   <form class="w3-container" method="post" action="#" enctype="multipart/form-data">
      <table bgcolor="#FFFFFF" style="width:100%" border="0" cellpadding="3" cellspacing="2">
      @foreach($topAnno as $announce)
         <tr>
            <td align="center">
               <h3 style="background:#FF6600;color:#fff">{{ $announce->text_subject}} </h3>
            </td>
         </tr>
         <tr>
            <td align="center">
               <h5> {!! $announce->text_subtitle !!}</h5>
            </td>
         </tr>
         <tr>
            <td align="center">
               @foreach( $announce->annoFile as $anno_file)
                  @isset($anno_file->file_name)
                     @if (pathinfo($anno_file->file_name, PATHINFO_EXTENSION) === 'pdf' || pathinfo($anno_file->file_name, PATHINFO_EXTENSION) == 'docx')
                     <embed src="{{asset('vrms2/anno/'.$anno_file->file_name)}}" class="{{ $anno_file->file_size == 0?'box1':''}}" width="1280" height="825" type="application/pdf">
                     @else 
                        <img class="{{ $anno_file->file_size == 0?'box1':''}}"  width="1280" height="825"  src="{{asset('vrms2/anno/'.$anno_file->file_name)}}"   title="Annouce Logo {{ $anno_file->file_size}}" alt="Annouce Logo">
                     @endif
                     
                  @endisset
               @endforeach
            </td>
         </tr>
        
      @endforeach
      </table>
   </form>
   
</div>
@endsection