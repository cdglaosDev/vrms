@extends('vrms2.layouts.master')
@section('smart_cart_guide','active')
@section('content') 
@include('UserGuide.submenu')
<style>
   table, td, th {
   border: 1px solid black;
   }
   table {
   width: 100%;
   border-collapse: collapse;
   }
</style>
<h3>Smart Card API Guide
   <a href="{{asset('uploads/api-guide.pdf')}}" class="btn btn-info" target="_blank">Download Api Guide</a>
</h3>
@include('flash') 
<div class="card-body">
   <div class="row">
   </div>
   <div class="panel-body">
      <p>1. Get Vehicle Information</p>
      <p>2. Read Card Data</p>
      <p>3. Write Card Data </p>
      <p>4. Card Termination</p>
      <br>
      <p>The Access token Value for smart card is: </p>
      <p style="font-size: 11px">7syoaUOHt8lhH254ogoPk9dSzJvAh3hJDH4/dlYIULQ=&</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>1. Get Vehicle Information</u></p>
      <table>
         <tr>
            <th>Description</th>
            <th>The method will allow you to receive the vehicle filter by license number and division number.</th>
         </tr>
         <tr>
            <td>Method</td>
            <td>GET</td>
         </tr>
         <tr>
            <td>URL</td>
            <td>http://vdvclao.org:8447/api/card-vehicle</td>
         </tr>
         <tr>
            <td >Required</td>
            <td>Division_no, license_no, access_token</td>
         </tr>
         <tr>
            <td >Parmas</td>
            <td>Division_no, license_no, access_token</td>
         </tr>
         <tr>
            <td>Headers</td>
            <td>content_type * (String) : application/json specifying the format to get response.</td>
         </tr>
      </table>
      <br>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Get Vehicle Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "ແດງ 3311",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "Province":&nbsp "ແດງ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "Purpose":&nbsp "ຂໍຂື້ນທະບຽນລົດໃໝ່",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "division_no":&nbsp "0000001",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_no":&nbsp "0000001",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "owner_name":&nbsp "ຂໍອະນຸຍາ ດໃຊ້ລົດປະຈໍາປີ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "engine_no":&nbsp "TESTENGINENO",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "chassis_no":&nbsp "TESTCHASSISNO",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type":&nbsp "ລົດ3ລໍ້",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "brand":&nbsp "TOYOTA",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "model":&nbsp "Century",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "color":&nbsp "ສີຂຽວ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "issued_date":&nbsp "2020-12-23"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "expired_date":&nbsp "2020-12-23"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "district":&nbsp "ຈັນທະບູລີ"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "village":&nbsp "ລົດ3ລໍ້"</p>
      <p>&nbsp  &nbsp  &nbsp }</p>
      <p>&nbsp  &nbsp ]</p>
      <p>&nbsp }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>2. Read Card Data </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to receive card information filtered by card number.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>GET</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/read-card</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td>Card_no, access_token</td>
            </tr>
            <tr>
               <td>Params</td>
               <td>Card_no, access_token</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Read Card Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "Province":&nbsp "ແດງ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "division_no":&nbsp "0000006",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_no":&nbsp "0001517",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "name":&nbsp "testing abc",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "engine_no":&nbsp "NF110E8001417",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "chassis_no":&nbsp "JTDBR23E543100345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type":&nbsp "ລົດ3ລໍ້",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "brand":&nbsp "FORD",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "model":&nbsp "WAVE",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "color":&nbsp "ສີຂຽວ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "issued_date":&nbsp "2020-08-20"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "expired_date":&nbsp "2020-08-20"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "district":&nbsp "ຈັນທະບູລີ"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "village":&nbsp "test"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "card_no":&nbsp "VDVC-33333"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_kind":&nbsp "test"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_code":&nbsp "null"</p>
      <p>&nbsp  &nbsp  &nbsp }</p>
      <p>&nbsp  &nbsp }</p>
      <p>&nbsp }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>3. Write Card Data </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to write the records to database for card information.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>POST</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/write-card</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> Division_no, license_no,  access_token</td>
            </tr>
            <tr>
               <td>Params</td>
               <td>Division_no, license_no, access_token</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Write Card Response:</p>
      <p>{</p>
      <p style="background-color: black;color: #fff;font-size: 20px">&nbsp  &nbsp  &nbsp  &nbsp  "Message": "Your Card  already writed."</p>
      <p>&nbsp }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>4. Card Termination </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to terminate the smart card in database.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>PATCH</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/terminate-card</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> Card_no, access_token</td>
            </tr>
            <tr>
               <td >Params</td>
               <td> Card_no, access_token </td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Card Termination Type Response:</p>
      <p>{</p>
      <p style="background-color: black;color: #fff;font-size: 20px">&nbsp  &nbsp  &nbsp  &nbsp  "Message": "Your Card is already terminated."</p>
      <p> }</p>
      <br>
   </div>
</div>
@endsection