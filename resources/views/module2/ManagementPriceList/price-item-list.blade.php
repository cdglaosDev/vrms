<div class="p10" scrollid="100" bottom="10"  f="1">
<table class="table table-striped">
   <tbody>
      @foreach($item_list as $item)
      <tr>
         <td> {{ $item->price_item->code ?? ''}} </td>
         <td>{{ $item->price_item->name ?? ''}}</td>
         <td>{{ $item->unit_price ?? ''}}</td>
         <td></td>
      </tr>
      @endforeach
   </tbody>
</table>
</div>