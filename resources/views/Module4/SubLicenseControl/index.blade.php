@extends('vrms2.layouts.master')
@section('reg_no','active')
@section('content') 
<h3>Sub License Number Control</h3>
<div class="card-body">
   @include('flash') 
   <div class="table-responsive">
      <table id="myTable" class="table table-striped">
         <thead>
            <tr>
               <th>Licence No.</th>
               <th>Owner-Occupant</th>
               <th>Type-Kind</th>
               <th>Village</th>
               <th>District</th>
               <th>Province</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
@endsection