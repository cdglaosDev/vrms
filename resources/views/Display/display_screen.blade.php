<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo asset('vrms2/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo asset('vrms2/css/display_screen.css')?>" type="text/css">

  <script src="<?php echo asset('vrms2/js/jquery.min.js')?>"></script>  
  <script src="<?php echo asset('vrms2/js/bootstrap.min.js')?>"></script>

  <script>
    
      $(document).ready(function(){
          setInterval(function() {
              $("#demo").load(window.location.pathname);
          }, 20000);
      });
      

  </script>
</head>
<body id="demo">
  
  <div class="container-fluid">

    <div class="row display-head vertical-align">
      <div class="col-md-3">
        <img src="{{asset('images/laos2.png')}}" style="width:25%">
      </div>

      <div class="col-md-6 display-title">
        @foreach ($display_setting as $item)
            <h3>{{$item['title']}}</h3>
           <input type="hidden" data-id="{{$item['department_id']}}">
        @endforeach
      </div>   

      
        <div class="col-md-3">     
          <h4 class="title-time align-middle">{{ $time }}</h4>
        </div>
    </div>

  
    <div class="row">
      <div class="col-md-12 display-body"> 
        
      <table>
        <thead>
          <tr>         
            <th>License No</th>
            <th>Name / Village (Unit)</th>         
            <th>Time Call</th>         
          </tr>
        </thead>
        <tbody>     
          <?php
            $count = 1;
          ?>
        @foreach($display_screen as $display)  
          @php
          
          if($count % 2 == 0):
            $bgcolor = "#6c757d";
          else:
            $bgcolor = "#343a40";
          endif;

          $count++;

          /*
              if( $display->time_call == $latest_display):
              $color = 'blue'; 
              else:
              $color = 'black';
              endif;
              */
              
          @endphp     
                <tr style="background-color: {{$bgcolor}};">           
                    <td>
                      @if(isset($display->app_form))
                          <a href="#" class="link license_no" purpose_no="{{$display->app_form->vehicle['vehicle_kind_code']}}">
                            @if(strlen($display->app_form->vehicle['licence_no']) == 0)
                              {{'0000'}} 
                            @else
                              {{ $display->app_form->vehicle['licence_no'] }} 
                            @endif                         
                          </a>
                      @else
                          {{ "_" }} 
                      @endif
                    </td>
                   
                    <td class="text-left">
                      @if(isset($display->app_form))
                         <span style="color:#FFFFFF">{{ $display->app_form->vehicle['owner_name']}}</span>
                      @else{{ "_" }} 
                      @endif
                      @if(isset($display->app_form))
                         <span style="color:yellow">{{ $display->app_form->vehicle['village_name']}} ({{ $display->app_form->vehicle['vehicle_unit']}})</span>
                      @else
                      {{ "_" }} 
                      @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($display['time_call'])->format("H:i")}}</td>
                  </tr>
             @endforeach
         </tbody>
     </table>
    </div>
  
  </div>  
    
</body>
</html>
