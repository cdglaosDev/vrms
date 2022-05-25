
<table id="table" class="table table-striped">
    <thead>
        <tr style="display:none">
            <td colspan="3" height="20px">ພະແນກ ຍທຂ ນະຄອນຫລວງ</td>
            <td colspan="2">ກອງຄຸ້ມຄອງພາຫານະແລະການຂັບຂີ່ </td>
            <td></td>
        </tr>

        <tr style="display:none">
            <td height="25px">&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align:right">ຈາກວັນທີ ({{ \Carbon\Carbon::parse($from_date)->format('d/m/Y') }}) </td>
            <td style="text-align:center">ຫາວັນທີ ({{ \Carbon\Carbon::parse($to_date)->format('d/m/Y') }})</td>
        </tr>
        <tr>
            <td colspan="4" height="25px" style="font-weight:bold; font-size: 18px;">ບົດລາຍງານ ບິນການເງິນປະຈໍາວັນ</td>
            <td style="text-align:right">ພະນັກງານ</td>
            <td style="text-align:center">{{ $staff_name->user->first_name ?? '' }} {{ $staff_name->user->last_name ?? ''}}</td>
        </tr>

        <tr>
            <th style="display:none"><strong>ລ/ດ</strong></th>
            <th><strong>ເລກທີ່ບິນ</strong></th>
            <th colspan="2"><strong>ອອກຊື່</strong></th>
            <th><strong>ລາຍການ</strong></th>
            <th width="150" style="text-align:center;"><strong>ລວມເງິນ</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
            $all_total = 0;
        @endphp
        @foreach ($price_list as $key=>$price_lists)
         <tr>
            <td style="display:none">{{ ++$key }}</td>
            <td>{{ $price_lists->ServiceCounter->name ?? ''}}.{{$price_lists -> price_receipt_no}}</td>
            <td colspan="2">{{$price_lists -> user_payer ?? '' }}</td>
            <td>
               @foreach($price_lists-> PriceListDetails as $value)
               {{$value -> item_code}}({{number_format($value -> sub_total)}}),
               @endforeach
            </td>
            <td style='text-align:right;'>{{ number_format($price_lists->total_amt)}}</td>
                @php
                    $all_total +=  $price_lists->total_amt ;
                @endphp
         </tr>
         @endforeach

        <tr>
            <td  height="19px">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td  height="19px">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        
        <td  height="19px">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>ລວມ</td>
        <td style="text-align:right;">
            {{number_format($all_total)}}
        </td>
        </tr>
    </tbody>
</table>
