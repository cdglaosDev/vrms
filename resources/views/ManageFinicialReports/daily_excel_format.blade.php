
<table id="table" class="table table-striped">
    <thead>
        <tr style="display:none">
            <td colspan="3" height="20px">ພະແນກ ຍທຂ ນະຄອນຫລວງ</td>
            <td></td>
            <td></td>
        </tr>

        <tr style="display:none">
            <td colspan="3"  height="20px">ກອງຄຸ້ມຄອງພາຫານະແລະການຂັບຂີ່ </td>
            <td></td>
            <td></td>
        </tr>

        <tr style="display:none">
            <td></td>
            <td></td>
            <td style="font-weight:bold; font-size: 18px;height:25px">ບົດລາຍງານ ການເງິນປະຈໍາວັນ </td>
            <td style="text-align:right">ຈາກວັນທີ ({{ \Carbon\Carbon::parse($from_date)->format('d/m/Y') }}) </td>
            <td style="text-align:center">ຫາວັນທີ ({{ \Carbon\Carbon::parse($to_date)->format('d/m/Y') }})</td>
        </tr>
        <tr>
            <td height="25px">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="display:none"><strong>ລ/ດ</strong></th>
            <th><strong>{{trans('finance_title.item_code')}}</strong></th>
            <th><strong>ລາຍການ</strong></th>
            <th><strong>ລວມຈໍານວນ</strong></th>
            <th width="150" style="text-align:center;"><strong>ລວມເງິນ</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
            $all_qty = 0;
        @endphp
        @foreach ($pricedetail as $key=>$pricedetails)
            <tr>
                <td style="display:none"  height="19px">{{ ++$key }}</td>
                <td>{{ $pricedetails -> item_code }}</td>
                <td>{{ $pricedetails -> item_name }}</td>
                <td>{{ $pricedetails -> total_qty }}</td>
                @php
                    $all_qty +=  $pricedetails -> total_qty ;
                @endphp
                <td style='text-align:right;'>{{number_format($pricedetails -> sub_total)}}</td>
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
        <td>ລວມ</td>
        <td>{{ $all_qty }}</td>
        <td style="text-align:right;">
            @php
            if(isset($fine_percent)) $sum_fine = $fine_percent->sum('percentage');else $sum_fine = null;
            if(isset($fine_percent))$total = $fine_percent->sum('sub_total');else$total = null;
            if(isset($fine_percent))$sub_total_amt = $total-$sum_fine;else$sub_total_amt = 0;
            @endphp
            {{number_format($sub_total_amt)}}
        </td>
        </tr>
    </tbody>
</table>
