@extends('layouts.master')
@section('register','active')
@section('title','Reports')
@section('content')
<style type="text/css">
@media print
{
body * { visibility: hidden; }
#printcontent * { visibility: visible; }
#printcontent { position: absolute; top: 40px; left: 30px; }
}
@media screen {
#printcontent { visibility: hidden; }
}
</style>
<div class="card">
<div class="card-body">
<input type="button" onclick="printDiv('printcontent')" value="print a div!" />
 
</div>
</div>


<div id="printcontent">
      <h1>Print testing</h1>
      <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, perspiciatis! At repudiandae, provident nemo illo aperiam necessitatibus sed harum impedit deserunt libero possimus officiis, tempore exercitationem quisquam. Quos, accusamus cum.</p>
</div>
@endsection
@push('page_scripts')

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    window.print();
}
</script>
@endpush