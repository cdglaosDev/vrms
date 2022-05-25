   @extends('vrms2.layouts.master')
   @section('alphabet','active')
   @section('content')
   @include('vrms2.mod4-submenu')

   <h3>{{ trans('module4.lic_alphabet_title') }}
      @can('Alphabet-Create')
      <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
      @endcan
   </h3>
   @include('flash') 
   <div class="card-body">
      <div class="table-responsive">
         <table id="myTable" class="table table-striped">
            <thead>
               <tr>
                  <th>{{ trans('module4.no') }}.</th>
                  <th>{{ trans('module4.alphabet') }}</th>
                  <th>{{ trans('module4.alphabet') }} (Eng)</th>
                  <th>{{ trans('common.action') }}</th>
               </tr>
            </thead>
            <tbody>
               @foreach($license  as $key=>$data)
               <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{$data->name}}</td>
                  <td>{{ $data->name_en }}</td>
                  <td>
                  @can('Alphabet-Edit')   
                     <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false"
                        data-act="Edit" data-name="{{ $data->name }}" data-name_en="{{ $data->name_en }}" data-id="{{ $data->id}}">
                        <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}"  width="25px" height="25px"></a>
                  @endcan
                  @can('Alphabet-Delete')
                  <a href="" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-act="Delete" data-backdrop="static" data-keyboard="false" data-id="{{$data->id}}">
                     <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a>
                  @endcan
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   @include('Module4.LicenseAlphabet.modal')
   @include('delete')
   @endsection 
   @push('page_scripts')
   <script type="text/javascript">
      var base_url = "{{url('/license-alphabet')}}";
   
      $(document).on("click", '.delete_btn', function (e) { 
         document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
      });
      
      $(document).on("click", '.edit_btn', function (e) 
      {
         $('[name="name"]').val($(this).data('name'));
         $('[name="name_en"]').val($(this).data('name_en'));
         $("#edit-id").val($(this).data('id'));
         document.getElementById("editform").action = base_url+"/"+$(this).data('id');
      });
      $(".alphabet, .edit-alphabet").keyup(function(){
               var code = $(this).val();
               code = code.replace(/[0-9!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g,'');
            $(this).val(code);
      });
      $(".alphabet_en").keyup(function(){
               var code = $(this).val();
               code = code.replace(/[0-9!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_]/g,'');
            $(this).val(code);
      });

      $('#add-license').click(function(e){
      
            e.preventDefault();
            var alphabet = $('#addModel .alphabet');
            var alphabet_en = $("#addModel .alphabet_en");
            var oldId = $("#new-id").val();
            var form = $("#newForm");
            addAlphabet(alphabet, alphabet_en, form, oldId);
         });

         $('#edit-license').click(function(e){
            e.preventDefault();
            var alphabet = $('#addModel .alphabet');
            var alphabet_en = $("#addModel .alphabet_en");
            var oldId = $("#edit-id").val();
            var form = $("#editform");
            addAlphabet(alphabet, alphabet_en, form, oldId);
         });

      function addAlphabet(alphabet, alphabet_en, form, oldId=null)
         { 
            var url = "/check-alphabet?alphabet=" + alphabet.val() + "&id=" + oldId;
            $.get(url, function(response) {
               
               if (alphabet.val() == '') {
                  alert("Please enter alphabet");
                  $('.alphabet').focus();
                  return false;
               }if (alphabet_en.val() == '') {
                  alert("Please enter alphabet or '-'");
                  $('.alphabet_en').focus();
                  return false;
               } else if (response.status == 'used') {
                  alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
                  return false;
               } else {
                  form.submit();
               }
         });
      }
      
      
   </script>
   @endpush