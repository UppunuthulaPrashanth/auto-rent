$('.btn-top').click(function() {
    $('#modal1')
        .prop('class', 'modal model-left fade') // revert to default
        .addClass( $(this).data('direction') );
    $('#modal1').modal('show');
});

$('.btn-left').click(function() {
    $('#modal2')
        .prop('class', 'modal fade') // revert to default
        .addClass( $(this).data('direction') );
    $('#modal2').modal('show');
});

$('.btn-right').click(function() {
    $('#modal1')
        .prop('class', 'modal fade') // revert to default
        .addClass( $(this).data('direction') );
    $('#modal1').modal('show');
});

$('.btn-bottom').click(function() {
    $('#modal2')
        .prop('class', 'modal fade') // revert to default
        .addClass( $(this).data('direction') );
    $('#modal2').modal('show');
});



$(document).ready(function(){
    $(".btn-apply").click(function(){
        $("#applicant-details-modal").modal({backdrop: "static"});
    });
});