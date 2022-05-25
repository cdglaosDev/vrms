
<table id="table" class="table table-striped">
    <thead>
        <tr style="display:none">
            <td style="width:25px;">&nbsp;</td>
            <td style="width:152px">&nbsp;</td>
            <td style="width:77px">&nbsp;</td>
            <td style="width:77px">&nbsp;</td>
            <td colspan="5" style="font-weight:bold; font-size: 18px;height:25px;width:48xp;">ພະແນກ ຍທຂ ນະຄອນຫລວງ</td>
            <td style="width:46px">&nbsp;</td>
            <td style="width:118px">&nbsp;</td>
            <td style="width:99px">&nbsp;</td>
            <td style="width:80px">&nbsp;</td>
            <td style="width:80px">&nbsp;</td>
            <td style="width:176px">&nbsp;</td>
        </tr>

        <tr style="display:none">
            <td></td>
            <td>ວັນທີ່ພິມ: {{ $date }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3">ກໍາແພງນະຄອນ 01</td>
        </tr>
        <tr >
            <td></td>
            <td>ພິມໄດ້ທັງໝົດ:</td>
            <td></td>
            <td style="font-weight:bold;"> {{ $card_print->count() }} ແຜ່ນ</td>
            <td></td>
            <td></td>
            <td >Name</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight:bold;">ພິມປົກກະຕິ</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <th height="23">#</th>
            <th align="center">ເລກກົມ</th>
            <th align="center">ເລກແຂວງ</th>
            <th align="center">ຊື່ນາມສະກຸນ</th>
            <th align="center">ບ້ານ</th>
            <th align="center">ທະບຽນ</th>
            <th align="center">ປະເພດ</th>
            <th align="center">ຊະນິດ</th>
            <th align="center">ຍີຫໍ້</th>
            <th align="center">ລຸ້ນ</th>
            <th align="center">ພິມ</th>
            <th align="center">ໝາຍເຫດ</th>
            <th align="center">eCode</th>
            <th align="center">ຜູ້ຜິດ</th>
            <th align="center">ຜູ້ເບີກ</th>
        </tr>

    </thead>
    <tbody>
        @foreach($card_print as $key=>$data)
            <tr>
               <td  height="19px">{{  ++$key }}</td>
               <td align="left">{{  $data->division_no }}</td>
               <td>{{  $data->province_no }}</td>
               <td>{{  $data->owner_name }}</td>
               <td>{{  $data->village_name }}</td>
               <td>{{  $data->licence_no }}</td>
               <td>{{  $data->vtype_name }}</td>
               <td>{{  $data->vkind_name }}</td>
               <td>{{  $data->brand_name }}</td>
               <td>{{  $data->model_name }}</td>
               <td>{{ $data->print_count }}</td>
               <td>{{  $data->remark }}</td>
               <td>&nbsp;</td>
               <td>{{  $data->first_name }} {{ $data->last_name }}</td>
               <td></td>
            </tr>
        @endforeach

        <tr><td  height="19px">&nbsp;</td></tr>
        <tr><td  height="19px">&nbsp;</td></tr>
        <tr><td  height="19px">&nbsp;</td></tr>
        
        <tr>
            <td colspan="2">Card ທີ່ຮັບມາທັງທັງໝົດ:</td>
            <td></td>
            <td></td>
            <td></td>
            <td>ແຜ່ນ</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Card ພິມກັບມື້:</td>
            <td></td>
            <td></td>
            <td></td>
            <td>ແຜ່ນ</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Card ບຸກຄົນເບີກກ່ອນ:</td>
            <td></td>
            <td></td>
            <td></td>
            <td>ແຜ່ນ</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Card ເສຍ:</td>
            <td></td>
            <td></td>
            <td></td>
            <td>ແຜ່ນ</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Card ຍັງເຫລືອສົ່ງຄືນ:</td>
            <td></td>
            <td></td>
            <td></td>
            <td>ແຜ່ນ</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td>ຫົວໜ້າກອງ</td>
            <td colspan="3"></td>
            <td colspan="2">ຫົວໜ້າໜ່ວຍງານ</td>
            <td colspan="2"></td>
            <td>ຫົວໜ້າຈຸຜະລິດ</td>
        </tr>

    </tbody>
</table>
