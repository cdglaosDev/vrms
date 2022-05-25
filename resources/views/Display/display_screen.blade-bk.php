<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php echo asset('vrms2/css/display_screen.css')?>" type="text/css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>

      $(document).ready(function(){
          setInterval(function() {
              $("#demo").load(window.location.pathname);
          }, 20000);
      });

  </script>
</head>
<body id="demo">
  <div class="grid-container">
    <div class="item1">
      <img src="{{asset('images/laos1.png')}}" style="width:60%">
    </div>
    <div class="item2">
      @foreach ($display_setting as $item)
          <h3>{{$item['text1']}}</h3>
          <h3>{{$item['text2']}}</h3>
          <h3>{{$item['text3']}}</h3>
          <td><input type="hidden" data-id="{{$item['department_id']}}"></td>
      @endforeach
    </div>
    <div class="item3">
      <img src="{{asset('images/laos2.png')}}" style="width:40%">
    </div>  
    <div class="item4">
    <h4 class="text">
      @foreach ($display_setting as $item)
        {{ $item['title'] }}
      @endforeach
      </h4>
    </div>
    <div class="item6">     
      <h4 class="date">{{ $time }}</h4>
    </div>
  </div>
  
    <div class="item5">  
      <table>
        <thead>
        <tr>
          <th class="circle">No</th>
          <th class="start-round">License No</th>
          <th class="text-left">Name</th>
          <th class="text-left">Address</th>
          <th>Time That Call</th>
          <th class="end-round">Counter No</th>
        </tr>
      </thead>
      <tbody>     
        <?php
          $count =1;
        ?>
        @foreach($display_screen as $display)  
          @php
              if( $display->time_call == $latest_display):
              $color = 'blue'; 
              else:
              $color = 'black';
              endif;
          @endphp     
          <tr style="background-color: {{$color}};">
              <td>{{ $count ++ }}</td>
              <td>@if(isset($display->app_form)){{ $display->app_form->vehicle['licence_no']}}@else{{ "_" }} @endif</td>
              <td class="text-left">@if(isset($display->app_form)){{ $display->app_form->vehicle['owner_name']}}@else{{ "_" }} @endif</td>
              <td class="text-left">@if(isset($display->app_form)){{ $display->app_form->vehicle['village_name']}}@else{{ "_" }} @endif,
                  @if(isset($display->app_form)){{ $display->app_form->vehicle->province['name']}}@else{{ "_" }} @endif
              </td>
              <td>{{ $display['time_call']}}</td>
              <td>{{ $display['counter']}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  
  </div>
  
</body>
</html>
