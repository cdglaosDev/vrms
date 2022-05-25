$("#page").on('change', function(){
  window.location = "{{ url('/') }}/getPrint/"+id+"/"+page;  
});
