$(document).on('click', '.show_btn', function(e){
    e.preventDefault();
    var url = $(this).data('url');
    $('.show-modal').html(''); 
    $('#modal-loader').show();  
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html'
    })
    .done(function(data){
        $('.show-modal').html('');
        $('.show-modal').html(data); 
        $('#modal-loader').hide(); 
    })
    .fail(function(){
        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#modal-loader').hide();
    });
});

//edit popup btn
$(document).on('click', '.btn_edit', function(e){
    e.preventDefault();
   
    var url = $(this).data('url');
    $('.edit-modal').html(''); 
    $('#modal-loader').show();  
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html'
    })
    .done(function(data){
        $('.edit-modal').html('');
        $('.edit-modal').html(data); 
        $('#modal-loader').hide(); 
    })
    .fail(function(){
        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#modal-loader').hide();
    });
});