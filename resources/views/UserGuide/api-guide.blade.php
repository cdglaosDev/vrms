@extends('vrms2.layouts.master')
@section('api_guide','active')
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
<h3>Vehicle API Guide
<a href="{{asset('uploads/api-guide.pdf')}}" class="btn btn-info" target="_blank">Download Api Guide</a>
</h3>
@include('flash') 
<div class="card-body">
   <div class="panel-body">
      <p>1. Get vehicle by license number only</p>
      <p>2. Get vehicle by division number and license number</p>
      <p>3. Get vehicle by province code, license number and purpose</p>
      <p>4. Get accident type</p>
      <p>5. Post vehicle accident by license number</p>
      <p>6. Get vehicle accident by license number</p>
      <p>7. Get vehicle inspection by license number</p>
      <p style="color: rgb(bold);font-size: 25px"><u>1. Get Vehicle by license number only </u></p>
      <table>
         <tr>
            <th>Description</th>
            <th>The method will allow you to receive the vehicle filter by license number.</th>
         </tr>
         <tr>
            <td>Method</td>
            <td>GET</td>
         </tr>
         <tr>
            <td>URL</td>
            <td>http://vdvclao.org:8447/api/vehicle-by-license</td>
         </tr>
         <tr>
            <td >Required</td>
            <td>license_no, access_token</td>
         </tr>
         <tr>
            <td >Parmas</td>
            <td>license_no, access_token</td>
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
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "owner_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "division_no":&nbsp "0000006",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_name":&nbsp "ກໍາແພງນະຄອນ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_code":&nbsp "01",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "district_no":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "engine_no":&nbsp "test34343",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "chassis_no":&nbsp "car12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "brand":&nbsp "BMW",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "Model":&nbsp "Model",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "color":&nbsp "ສີແດງ"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "issued_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "expired_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_no":&nbsp "3033"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_payment_no":&nbsp "445445"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_payment_date":&nbsp "15-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp }</p>
      <p>&nbsp  &nbsp ]</p>
      <p>&nbsp }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>2. Get Vehicle by division number and license number </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to receive the vehicle filter by province code and license number.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>GET</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/vehicle-by-division-license</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td>division_no, license_no, access_token</td>
            </tr>
            <tr>
               <td>Params</td>
               <td>division_no, license_no, access_token</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Get Vehicle Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "owner_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "division_no":&nbsp "0000006",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_name":&nbsp "ກໍາແພງນະຄອນ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_code":&nbsp "01",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "engine_no":&nbsp "test34343",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "chassis_no":&nbsp "car12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "brand":&nbsp "BMW",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "Model":&nbsp Model,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "color":&nbsp "ສີແດງ"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "issued_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "expired_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_no":&nbsp "3033"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_payment_no":&nbsp "445445"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_payment_date":&nbsp "15-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp }</p>
      <p>&nbsp  &nbsp }</p>
      <p>&nbsp }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>3. Get Vehicle by province code, license number and vehicle purpose </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to receive the vehicle filter by province code, license number and vehicle purpose.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>GET</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/vehicle-by-license-province-purpose</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> province_code, license_no, purpose, access_token</td>
            </tr>
            <tr>
               <td>Params</td>
               <td>province_code, license_no, purpose, access_token</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Get Vehicle Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "owner_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "division_no":&nbsp "0000006",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_name":&nbsp "ກໍາແພງນະຄອນ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "province_code":&nbsp "01",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_type_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "engine_no":&nbsp "test34343",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "chassis_no":&nbsp "car12345",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "brand":&nbsp "BMW",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "Model":&nbsp Model,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "color":&nbsp "ສີແດງ"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "issued_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "expired_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_no":&nbsp "3033"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_date":&nbsp "12-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_payment_no":&nbsp "445445"</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "tax_payment_date":&nbsp "15-12-2020"</p>
      <p>&nbsp  &nbsp  &nbsp }</p>
      <p>&nbsp  &nbsp }</p>
      <p>&nbsp }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>4. Get Accident Type </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to receive the accident type.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>GET</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/accident-type</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> auaccess_token</td>
            </tr>
            <tr>
               <td >Params</td>
               <td> auaccess_token</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Get Accident Type Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 1,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "name":&nbsp "Head-on collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "name_en":&nbsp "Head-on collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "status":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "created_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "updated_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "deleted_at":&nbsp null</p>
      <p>&nbsp  &nbsp  &nbsp  },</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 2,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "name":&nbsp "Rear-end collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "name_en":&nbsp "Rear-end collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "status":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "created_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "updated_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "deleted_at":&nbsp null</p>
      <p>&nbsp  &nbsp  &nbsp  },</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 3,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "name":&nbsp "Side/T-bone collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "name_en":&nbsp "Side/T-bone collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "status":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "created_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "updated_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "deleted_at":&nbsp null</p>
      <p>&nbsp  &nbsp  &nbsp  },</p>
      <p>&nbsp  &nbsp  &nbsp  ],</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp  "success": "Success"</p>
      <p> }</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>5. Post traffic Accident By Police </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow to post traffic accident.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>POST</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/traffic-accident</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> authentication,traffic_accident_id ,license_no, place,offender_name, officer_name, date, remark</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br> 
      <br>
      <p  style="color: solid black;font-size: 20px">Example Post Traffic Accident Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 1,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "name":&nbsp "Head-on collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "name_en":&nbsp "Head-on collisions",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "status":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "created_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "updated_at":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "deleted_at":&nbsp null</p>
      <p>&nbsp  &nbsp  &nbsp  },</p>
      <p>&nbsp ],</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp  "success": "Success"</p>
      <p>}</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>6. Get traffic Accident by license number</u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow to get traffic accident vehicle by license.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>GET</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/traffic-accident</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> authentication</td>
            </tr>
            <tr>
               <td >Params</td>
               <td> license_no</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br> 
      <br>
      <p  style="color: solid black;font-size: 20px">Example of traffic accident vehicle by license number response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 1,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "traffic_accident_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "11111",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp"place":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "offender_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "officer_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "date":&nbsp "2020-03-04",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "remark":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "created_at":&nbsp "2020-07-29 19:26:46",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "updated_at":&nbsp "2020-07-29 19:26:46",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "deleted_at":&nbsp null</p>
      <p>&nbsp  &nbsp  &nbsp  },</p>
      <p>&nbsp  &nbsp  &nbsp  {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 1,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "traffic_accident_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_id":&nbsp "1",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "licence_no":&nbsp "11111",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "place":&nbsp&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "offender_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "officer_name":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "date":&nbsp "2020-03-04",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "remark":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "created_at":&nbsp "2020-07-29 19:27:11",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "updated_at":&nbsp "2020-07-29 19:27:11",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "deleted_at":&nbsp null</p>
      <p>&nbsp  &nbsp  &nbsp  },</p>
      <p>&nbsp ]</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp  "success": "Success"</p>
      <p>}</p>
      <br>
      <p style="color: rgb(bold);font-size: 25px"><u>7. Get Vehicle Inspection </u></p>
      <table>
         <thead>
            <tr>
               <th scope="col">Description</th>
               <th scope="col">The method will allow you to receive the vehicle inspection history filtered by division number and license number.</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Method</td>
               <td>GET</td>
            </tr>
            <tr>
               <td>URL</td>
               <td><u>http://vdvclao.org:8447/api/vehicle-inspection</u></td>
            </tr>
            <tr>
               <td >Required</td>
               <td> division_no, license_no, access_token</td>
            </tr>
            <tr>
               <td >Pamars</td>
               <td>division_no, license_no, access_token</td>
            </tr>
            <tr>
               <td>Headers</td>
               <td>Content_type * (String) : application/json specifying the format to get response.</td>
            </tr>
         </tbody>
      </table>
      <br>
      <p  style="color: solid black;font-size: 20px">Example Get Vehicle Inspection History Response:</p>
      <p>{</p>
      <p> &nbsp  &nbsp  &nbsp  "data": [</p>
      <p>&nbsp  &nbsp  &nbsp  &nbsp {</p>
      <p> &nbsp  &nbsp  &nbsp &nbsp &nbsp "id":&nbsp 12345,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp  "inspect_no":&nbsp "test",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "request_no":&nbsp "0000006",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "inspect_date":&nbsp "ກໍາແພງນະຄອນ",</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "inspect_result":&nbsp 01,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "inspect_type":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "inspect_comment":&nbsp null,</p>
      <p>&nbsp  &nbsp  &nbsp &nbsp &nbsp "vehicle_license_no":&nbsp "1"</p>
      <p>&nbsp  &nbsp  &nbsp  }</p>
      <p>&nbsp ]</p>
      <p>}</p>
      <br>
   </div>

@endsection