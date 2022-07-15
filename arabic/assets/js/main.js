$(document).ready(function() {


    $(document).on("mouseenter", ".col_third", function(e) {
       $(this).addClass('flip');
    });
    
    $(document).on("mouseleave", ".col_third", function(e) {
         $(this).removeClass('flip');
    });


        

        

        

        



 

 

});



// RangeSlider
//
 $("#range_04").ionRangeSlider({

    type: "double",

    grid: true,

   min: -1000,

    max: 1000,

   from: -500,

    to: 500

    });

 // ...................

// icheck

$(document).ready(function(){

            var callbacks_list = $('.demo-callbacks ul');

            $('#driver,#gps,#bs,#cdw,#pai,#hc,#ic,#oic,#ekmc').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){

              callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');

            }).iCheck({

              checkboxClass: 'icheckbox_square-blue',

              radioClass: 'iradio_square-blue',

              increaseArea: '20%'

            });

          });


$(document).ready(function(){

            var callbacks_list = $('.demo-callbacks ul');

            $('#input-1,#input-2,#input-3,#input-4,#input-5').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
 
              callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');

            }).iCheck({

              checkboxClass: 'icheckbox_square-blue',

              radioClass: 'iradio_square-blue',

              increaseArea: '20%'

            });

          });

          

          

          

          

          

           $(".dd").change(function() {
              var valtxt = $(this).val();
              if ($(this).val()=="") {
                 $(this).parents('.searchlocation').find('.location-txt').addClass("hide");

              }
            else 
               $(this).parents('.searchlocation').find('.location-txt').removeClass('hide');

            });

// ............................



 // DateTimePicker

 // .........Date picker ui .............

  $(function() {

   jQuery('#datepicker,#datepicker1,#pickdate,#dropdate,#deal_from,#deal_to').datetimepicker({ 
    
    step:15,
    });
    

  }); 

  



jQuery(function(){
  $("#pd,#dd").prop("readonly",true); 


 var currentFullDate,currentDate,currentTime;


 jQuery('#pd').datetimepicker({

      format: 'Y/m/d H:i',
      step:15, 
      minDate : '-1969/12/31',
      minTime: 0,

       onSelectDate:function( ct ){
         currentFullDate= $("#pd").val();
         currentDate = currentFullDate.substr(0, currentFullDate.indexOf(" "));
         currentTime = currentFullDate.substr(currentFullDate.indexOf(" ")+1);
         var currentDate2 = moment().add('days',1).format('YYYY/MM/DD');
        //  currentFullDate=moment(currentDate).add('days',0).format('YYYY/MM/DD HH:MM');
         // $("#dd").val(currentFullDate);
            if (moment(currentDate).isAfter(currentDate2)) {
                console.log("true");
          this.setOptions({
                 minTime: false,
          });
          }
          else{
             console.log("false");
            this.setOptions({
               minTime: 0,
          });
          }

    },
    onSelectTime:function( ct ){
         currentFullDate= $("#pd").val();
         currentDate = currentFullDate.substr(0, currentFullDate.indexOf(" "));
         currentTime = currentFullDate.substr(currentFullDate.indexOf(" ")+1);

          var currentDate2 = moment().add('days',1).format('YYYY/MM/DD');
        //  currentFullDate=moment(currentDate).add('days',0).format('YYYY/MM/DD HH:MM');
         // $("#dd").val(currentFullDate);
            if (moment(currentDate).isAfter(currentDate2)) {
                console.log("true");
          this.setOptions({
                 minTime: false,
          });
          }
          else{
             console.log("false");
            this.setOptions({
               minTime: 0,
          });
          }
      
    },

 });

 jQuery('#dd').datetimepicker({
   format: 'Y/m/d H:i',
     minDate : '-1969/12/31',
     minTime: 0,
     step:15,
     onSelectDate:function( ct ){
         var currentFullDate2= $("#dd").val();
         var currentDate2 = currentFullDate2.substr(0, currentFullDate2.indexOf(" "));

        if (moment(currentDate2).isAfter(currentDate)) {
      this.setOptions({
             minTime: false,
      });
        }
        else{
          this.setOptions({
             minTime: currentTime,
        });
        }
     },
       onSelectTime:function( ct ){
            var currentFullDate2= $("#dd").val();
           var currentDate2 = currentFullDate2.substr(0, currentFullDate2.indexOf(" "));

          if (moment(currentDate2).isAfter(currentDate)) {
        this.setOptions({
               minTime: false,
        });
          }
          else{
            this.setOptions({
               minTime: currentTime,
          });
          }
         },
  onShow:function( ct ){

    
    
    this.setOptions({
           step:15,
         minTime: currentTime,
           minDate: currentDate,
     });
  },

 });
 
});



//jQuery(function(){
//    
// jQuery('#pd').datetimepicker({
//   //format: 'Y/m/d @ g:i A',
////   formatDate: 'Y/m/d',
////   	formatTime: 'g:i A',
//    format: 'Y-m-d H:i',
//    minDate: 0, 
//     step:15,
//  onShow:function( ct ){
//   this.setOptions({
//    //maxDate: $("#dd").val() ? new Date(Date.parse($("#dd").val())) : false
//    //maxDate:jQuery('#dd').val()?jQuery('#dd').val():false,
//   })
//  },
//  
// });
// jQuery('#dd').datetimepicker({
//  //format: 'Y/m/d @ g:i A',
////  formatDate: 'Y/m/d',
////  formatTime: 'g:i A',
//  format: 'Y-m-d H:i',
//   step:15,
//  onShow:function( ct ){
//   this.setOptions({
//     minDate: $("#pd").val() ? new Date(Date.parse($("#pd").val())) : false
//    //minDate:jQuery('#pd').val()?jQuery('#pd').val():false
//  
//   })
//  },
// 
// });
// 
//});
  $(function() { 

      $('#dob').datetimepicker({
        
         timepicker: false,
         step:15,
           format:'d-m-Y',

    });

                

 });

 

   $(function() {

      $('#from').datetimepicker({

         timepicker: false,
            step:15,
           format:'Y-m-d',

    });

                

 });

  $(function() {

      $('#to').datetimepicker({

         timepicker: false,
step:15,
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









$(document).ready(function() {


$(document).load($(window).bind("resize", checkPosition));





function checkPosition() {

  if (Modernizr.mq('(max-width: 767px)')) {

  $('section[data-parallax="scroll"]').each(function(index, el) {
 $(this).attr('data-image-src','asdasdasd');
 var sss= $(this).attr('data-image-src');
 console.log(sss);
});



 




  

 

}

}



$('.mainboxes3 .tab-link1').click(function(e) {
  e.preventDefault();
   $(this).addClass('activenav');
   $('.tab-link2,.tab-link3').removeClass('activenav');
 $(this).parents(".header").find('.tab1').removeClass('hide22');
  $(this).parents(".header").find('.tab2,.tab3').addClass('hide22');
});


$('.mainboxes3 .tab-link2').click(function(e) {
  e.preventDefault();
    $(this).addClass('activenav');
    $('.tab-link1,.tab-link3').removeClass('activenav');
 $(this).parents(".header").find('.tab2').removeClass('hide22');
  $(this).parents(".header").find('.tab1,.tab3').addClass('hide22');
});


$('.mainboxes3 .tab-link3').click(function(e) {
  e.preventDefault();
     $(this).addClass('activenav');
   $('.tab-link1,.tab-link2').removeClass('activenav');
 $(this).parents(".header").find('.tab3').removeClass('hide22');
  $(this).parents(".header").find('.tab2,.tab1').addClass('hide22');
});


});

var countries = [
    { value: 'Pakistan' },
    // ...
    { value: 'Zimbabwe' }
];

$('#autocomplete').autocomplete({
   // serviceUrl: '/autocomplete/countries',
    lookup: countries,
    onSelect: function (suggestion) {
        // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
});


// ...............................updated....................

      // function shuffle(o){ //v1.0
      //       for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
      //       return o;
      //   }

      //   var colors = [
      //       ['#D3B6C6', '#4B253A'], ['#FCE6A4', '#EFB917'], ['#BEE3F7', '#45AEEA'], ['#F8F9B6', '#D2D558'], ['#F4BCBF', '#D43A43']
      //   ], circles = [];


      //   for (var i = 1; i <= 1; i++) {
      //       var child = document.getElementById('circles-1'),
      //           percentage = 0 + (95);

      //       circles.push(Circles.create({
      //           id:         child.id,
      //           value:      percentage,
      //           radius:     80,
      //           width:      5,
      //           colors:     colors[10]
      //       }));
      //   }

      //   for (var i = 1; i <= 1; i++) {
      //       var child = document.getElementById('circles-2'),
      //           percentage = 0 + (80);

      //       circles.push(Circles.create({
      //           id:         child.id,
      //           value:      percentage,
      //           radius:     80,
      //           width:      5,
      //           colors:     colors[1]
      //       }));
      //   }
      //   for (var i = 1; i <= 1; i++) {
      //       var child = document.getElementById('circles-3'),
      //           percentage = 0 + (60);

      //       circles.push(Circles.create({
      //           id:         child.id,
      //           value:      percentage,
      //           radius:     80,
      //           width:      5,
      //           colors:     colors[5]
      //       }));
      //   }
      //   for (var i = 1; i <= 1; i++) {
      //       var child = document.getElementById('circles-4'),
      //           percentage = 0 + (50);

      //       circles.push(Circles.create({
      //           id:         child.id,
      //           value:      percentage,
      //           radius:     80,
      //           width:      5,
      //           colors:     colors[0]
      //       }));
      //   }



// ..................................




 
$(document).ready(function() {
    $('.tab1-link').click(function(event) {
       $(this).addClass('active-tab').not('active-tab').parents('.ser-tabs').find('.tabs-1').removeClass('hide');
       $('.tab2-link,.tab3-link,.tab4-link,.tab5-link').removeClass('active-tab');

        $(this).parents('.ser-tabs').find('.child-tabs1').removeClass('hide');
       $('.tabs-2,.tabs-3,.tabs-4,.tabs-5,.child-tabs2,.child-tabs3,.child-tabs4,.child-tabs5').addClass('hide');
       event.preventDefault();
    });

      $('.tab2-link').click(function(event) {
       $(this).addClass('active-tab').parents('.ser-tabs').find('.tabs-2').removeClass('hide');
        $('.tab1-link,.tab3-link,.tab4-link,.tab5-link').removeClass('active-tab');

           $(this).parents('.ser-tabs').find('.child-tabs2').removeClass('hide');
       $('.tabs-1,.tabs-3,.tabs-4,.tabs-5,.child-tabs1,.child-tabs3,.child-tabs4').addClass('hide');
       event.preventDefault();
    });

        $('.tab3-link').click(function(event) {
         $(this).addClass('active-tab').parents('.ser-tabs').find('.tabs-3').removeClass('hide');
        $('.tab2-link,.tab1-link,.tab4-link,.tab5-link').removeClass('active-tab');

          $(this).parents('.ser-tabs').find('.child-tabs3').removeClass('hide');
       $('.tabs-2,.tabs-1,.tabs-4,.tabs-5,.child-tabs2,.child-tabs1,.child-tabs4,.child-tabs5').addClass('hide');
       event.preventDefault();
    });


     $('.tab4-link').click(function(event) {
             $(this).addClass('active-tab').parents('.ser-tabs').find('.tabs-4').removeClass('hide');
        $('.tab2-link,.tab1-link,.tab3-link,.tab5-link').removeClass('active-tab');

          $(this).parents('.ser-tabs').find('.child-tabs4').removeClass('hide');
       $('.tabs-2,.tabs-1,.tabs-3,.tabs-5,.child-tabs2,.child-tabs3,.child-tabs1,.child-tabs5').addClass('hide');
       event.preventDefault();
    });
    
      $('.tab5-link').click(function(event) {
       $(this).addClass('active-tab').parents('.ser-tabs').find('.tabs-5').removeClass('hide');
        $('.tab2-link,.tab1-link,.tab3-link,.tab4-link').removeClass('active-tab');
     $(this).parents('.ser-tabs').find('.child-tabs5').removeClass('hide');
       $('.tabs-2,.tabs-1,.tabs-3,.tabs-4,.child-tabs2,.child-tabs3,.child-tabs1,.child-tabs4').addClass('hide');
       event.preventDefault();
    });















  


// .................sub tabs..............
 $('.sub-link1').click(function(event) {

$(this).addClass('active-tab-sub').parents('.main-childs').find('.sub-tab1').removeClass('hide');
 $(this).parents('.main-childs').find('.sub-link2,.sub-link3').removeClass('active-tab-sub');

   $(this).parents('.main-childs').find('.sub-tab2,.sub-tab3').addClass('hide');

     event.preventDefault();
 });


  $('.sub-link2').click(function(event) {

   $(this).addClass('active-tab-sub').parents('.main-childs').find('.sub-tab2').removeClass('hide');
 $(this).parents('.main-childs').find('.sub-link1,.sub-link3').removeClass('active-tab-sub');

   $(this).parents('.main-childs').find('.sub-tab1,.sub-tab3').addClass('hide');

     event.preventDefault();
 });


    $('.sub-link3').click(function(event) {

   $(this).addClass('active-tab-sub').parents('.main-childs').find('.sub-tab3').removeClass('hide');
 $(this).parents('.main-childs').find('.sub-link1,.sub-link2').removeClass('active-tab-sub');

    $(this).parents('.main-childs').find('.sub-tab1,.sub-tab2').addClass('hide');

     event.preventDefault();
 });
         





  });


  

$(document).ready(function() {

$('#basicModal').on('show.bs.modal', function () {
 $("#forgetpass_model").modal("hide");
})

$('#forgetpass_model').on('show.bs.modal', function () {

   $("#basicModal").modal("hide");
})


});







   //  $(function(){
      //  $('.navbar-ul .mainnav-li .mainnav-a').removeClass('active');
     //   var url = window.location.pathname, 
           
        //    urlRegExp = new RegExp(url == '/' ? window.location.origin + '/?$' : url.replace(/\/$/,'')); 
     
            
            //$('.navbar-ul .mainnav-li .mainnav-a').each(function(){
              
                //if(urlRegExp.test(this.href.replace(/\/$/,''))){
                 //   $(this).addClass('active');
               // }
               
           /// });

         //  $('li').removeClass('active');
          // $('a.active').closest('li').addClass('active');
   // });
   
   
   
   
   
// $(".navbar-ul > .mainnav-li").click(function() 
//    {
//            $(this).closest('.navbar-ul').find('.mainnav-li').each(function(){
//            if ($(this).hasClass('active')) {
//    activeElement = $(this);
//    foundActive = true;
//}
//            
//                $(this).removeClass('active');
//            });
//            $(this).addClass('active');
//            defaultWidth = lineWidth = activeElement.width();
//            defaultPosition = linePosition = activeElement.position().left;
//            menuLine.css("width", lineWidth);
//            menuLine.css("left", linePosition);
//    });
    
    
    
    
    $(function() {
        
             var pgurl = window.location.href.substr(window.location.href
.lastIndexOf("/")+1);
 
     $("a").each(function(){
        
          if($(this).attr("href") == pgurl)
          {
             if($(this).hasClass("last1"))
          {
            $(this).addClass("active-custompage");
          }
           if( $(this).hasClass("has-sub1"))
          {
           
            $(this).addClass("active-custompage");
           
             
          }
            if( $(this).hasClass("has-sub2"))
          {
           
            $(this).addClass("active-custompage");
            $(this).parents("ul").stop().slideDown();
             
          }
          
           
           
          }
          
     });
     
     
     var pgurl = window.location.href.substr(window.location.href
.lastIndexOf("/")+1);
     $(".navbar-ul .mainnav-li a").each(function(){
         
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).addClass("active");
          
     })
});



$( document ).ready(function() {
$('#cssmenu > ul > li > .icon33 ').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});
});


    
    