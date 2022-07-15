// .........Date picker ui .............
  $(function() {
   jQuery('#pd,#dd,#datepicker,#datepicker1,#pickdate,#dropdate').datetimepicker();
  }); 

  $(function() {
      $('#dob').datetimepicker({
         timepicker: false,
           format:'d-m-Y',
    });
                
 });
 
   $(function() {
      $('#from').datetimepicker({
         timepicker: false,
           format:'Y-m-d',
    });
                
 });
  $(function() {
      $('#to').datetimepicker({
         timepicker: false,
           format:'Y-m-d',
    });
                
 });
 
  $('.linkfrom').click(function(event) {
    event.preventDefault();
     $('.fromcol').addClass('hide');
      $(this).addClass('activetab');
       $('.linkto').removeClass('activetab');
       

});


  $('.linkto').click(function(event) {
    event.preventDefault();
       $('.fromcol').removeClass('hide');
       $(this).addClass('activetab');
       $('.linkfrom').removeClass('activetab');

});

  $(function() {
    $('#expdate').datepicker( {
        changeMonth: true,
        changeYear: true,
         monthNames: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
            monthNamesShort: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
        showButtonPanel: true,
        dateFormat: 'MM/yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
});