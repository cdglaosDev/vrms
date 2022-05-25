<!DOCTYPE html>
<html>
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
          }, 7000);
      });

  </script>
</head>
<body id="demo" style="background: none;"> 
  <div class="container">
    <div class="row vertical-align">
      @foreach ($display_setting as $display)
      <div class="col-md-2">
        <img src="data:image/png;base64,{{ $display->logo1 }}" style="width:80%">
      </div>
      <div class="col-md-6 price-list-title"> 
                <h4>{{$display->text1}}</h4>
                <h4>{{$display->text2}}</h4>
                <div class="text-3">{{$display->text3}}</div>
      </div>      
      <div class="col-md-2">
        <img src="data:image/png;base64,{{ $display->logo2 }}" style="width:50%">
      </div>
      @endforeach 
      
      <div class="col-md-2 price-list-date">
        <?php
         $dt_now = new \DateTime('NOW');
        $time_zone = new DateTimeZone('Asia/Vientiane'); 
        $dt_now->setTimezone($time_zone);
        $date = \Carbon\Carbon::parse($dt_now)->format("d/m/Y");
        $time = \Carbon\Carbon::parse($dt_now)->format("H:i:s"); 
        ?>
          <h4>{{$date}}</h4>
          <h4>{{$time}}</h4>
      </div>


    </div>    

  </div>

  <div class="container-fluid">
    <div class="row feelist">
        <div class="col-md-8 list-of-fee">
            <h4>{{trans('finance_title.list_of_fees')}}</h4>
        </div> 
        <div class="col-md-4 list-of-fee-a">
          <h4> {{trans('finance_title.new_notice')}} </h4>
        </div> 
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">

      <div class="col-md-8" style="background:#fff;">
        <div class="row">
          <div class="col-md-12 user-payer">
            {{ isset($display_screen[0]) ? $display_screen[0]->payer : '' }}            
          </div>
        </div>
        <div class="row">        

          <div class="col-md-12">
            
            <table class="price-display">
              <thead>
              <tr>
                <th>I{{trans('finance_title.item_code')}}</th>
                <th>{{trans('finance_title.item_name')}}</th>
                <th>{{trans('finance_title.item_price')}}</th>
              </tr>
            </thead>
            <tbody>     
              <?php
                $total =0;
              ?>
               @foreach ($display_screen as $screen)
                <?php $total += $screen->item_price ?>                    
                <tr style="background-color: #FFFFFF; color:#999;">
                    <td>{{ $screen->item_code }}</td>
                    <td>
                      {{ $screen->item_name }}
                    </td>
                    <td class="text-left">
                      {{ number_format($screen->item_price) ?? ''}}
                                   
                    </td>                   
                </tr>
                @endforeach 

             </tbody>
            </table> 
          </div>
        </div>

       

      </div>
      
      <div class="col-md-4" style="background:#fff; color:#fff;">
          <div class="row">

            @foreach($display_setting as $adv) 
            <div class="col-md-12 adv-400-200">
               <img src="data:image/png;base64,{{$adv->adv1}}">
            </div>
            
            <div class="col-md-12 adv-400-600">
              <img src="data:image/png;base64,{{$adv->adv2}}">
            </div>
            @endforeach  

          </div>
      </div>

    </div>

    <div class="row tblfooter">
      <div class="col-md-8">

        <div class="row">
          <div class="col-md-2 tbltotal" >
            <br/>
            {{trans('finance_title.total')}}
           </div>
 
          <div class="col-md-8 tblfooter-0">
           {{ number_format($total) ?? ''}}
          </div>

          <div class="col-md-2 tblkip">
            <br/>
            {{trans('finance_title.kip')}}
           </div>
 
        </div>  

          
      </div>

      <div class="col-md-4 tblfooter-1">
        {{trans('finance_title.thank_you')}}
      </div>
    </div>
  
  </div>

  
</body>
</html>
