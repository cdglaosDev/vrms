@extends('layouts.master')
@section('title','Receipt')
@section('receipt','active')
@section('content')
				
					<div class="row">
							<div class="col-md-12">
								
									<form action="{{url('receive')}}" method="POST">

										@csrf
										@method("POST")
										<div class="card-body">
											
											
											<div class="form-row">
												<div class="col-md-6 mb-3">
													<label for="validationCustom01">Serial Number</label>
													<input type="text" class="form-control" id="validationCustom01" name="srno" placeholder="Enter Serial Number" value="" required>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
												<div class="col-md-6 mb-3">
													<label for="validationCustom01">Text Box1</label>
													<input type="text" class="form-control" id="validationCustom01" name="txt1" placeholder="Enter Text Box1" value="" required>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
												<div class="col-md-6 mb-3">
													<label for="validationCustom02">Text Box2</label>
													<input type="text" class="form-control" id="validationCustom02" name="txt2" placeholder="Enter Text Box2" value="" required>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
												<div class="col-md-6 mb-3">
													<label for="validationCustomUsername">Text Box3</label>
													<div class="input-group">
														
														<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Text Box3" name="txt3" value="" required>
														<div class="invalid-feedback">
															Please choose a username.
														</div>
													</div>
												</div>
												
											</div>
											
											<div class="form-row title-clone">

							 <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td><input type="text" name="title[]" placeholder="Enter Title" class="form-control name_list" required=""></td>
                         <td><input type="text" name="amt[]" placeholder="Enter Amount" class="form-control name_list" required=""></td>   
                        <td><button type="button" name="add" id="add" class="btn btn-primary btn-save">Add More</button></td>  
                    </tr>  
                </table>  
              
            </div>
        
												
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label for="validationCustomUsername">Text Box4</label>
													<div class="input-group">
														
														<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Text Box4" name="txt4" value="" required>
														<div class="invalid-feedback">
															Please choose a username.
														</div>
													</div>
												</div>
												
												<input type="hidden" name="reg_id" value="{{$reg_id}}">
											</div>
													<!-- end hidden field -->
											
										</div>
										<div class="card-footer bg-light">
											<button class="btn btn-primary btn-save" type="submit">Save</button>
											<button class="btn btn-secondary  btn-outline">Cancel</button>

										</div>
									</form>
								
							</div>
							
						</div>
					
										
									
							
@endsection
@push('page_scripts')
<script type="text/javascript">

    $(document).ready(function() {

     var i=1;

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="title[]" placeholder="Enter Title" class="form-control name_list" /></td><td><input type="text" name="amt[]" placeholder="Enter Amount" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  

    });

</script>
@endpush