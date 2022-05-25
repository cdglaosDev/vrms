<div class="card">
  
     <p>Licence No: {{ $vehicle->licence_no}}</p> 
     <p>Name: {{ $vehicle->owner_name}}</p> 
     <p>Village: {{ $vehicle->village_name}}</p> 
     <p>District: {{ $vehicle->district->name ??''}}</p> 
     <p>Province: {{$vehicle->province->name ?? ''}}</p>
     <p>VehicleType: {{$vehicle->province->name ?? ''}}</p>
     <p>Make: {{$vehicle->vbrand->name ?? ''}}</p>
     <p>Model: {{$vehicle->vmodel->name ?? ''}}</p>
     <p>Color: {{$vehicle->color->name ?? ''}}</p>
     <p>DriverSeat: {{$vehicle->province->name ?? ''}}</p>
     <p>MotorMake: </p>
     <p>Cylinder: {{$vehicle->cylinder}}</p>
     <p>CC: {{$vehicle->cc}}</p>
     <p>Engine No: {{$vehicle->engine_no}}</p>
     <p>Chassis No: {{$vehicle->chassis_no}}</p>
     <p>Width: {{$vehicle->width}}</p>
     <p>Length: {{$vehicle->long}}</p>
     <p>height: {{$vehicle->height}}</p>
     <p>Seat: {{$vehicle->seat}}</p>
     <p>Weight_Empty: {{$vehicle->weight}}</p>
     <p>weigthFill: {{$vehicle->weight_filled}}</p>
     <p>YearMnf: {{$vehicle->year_manufacture}}</p>
     <p>Axis: {{$vehicle->axis}}</p>
     <p>Wheels: {{$vehicle->wheels}}</p>
     <p>WeightTotal: {{$vehicle->total_weight}}</p>





</div>