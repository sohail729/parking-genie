
  jQuery(document).ready(function(){
    jQuery('a.nav-link.drpdown').on ('click', function(){
    jQuery('.navbar-expand .navbar-nav .dropdown-menu').toggle();
    });
    
    
    $('section.newhome4 .col').on ('click',function(){
    // $('.row.ser-row').css('display', 'block');
    $('.row.ser-row').fadeIn();
    });
    
    
    $('#colone').on ('click',function(){
    $(this).addClass('active-col'); 
      $('#coltwo').removeClass('active-col');
    $('#colthree').removeClass('active-col');
    
    
    });
    
    
    $('#coltwo').on ('click',function(){
    $(this).addClass('active-col'); 
      $('#colone').removeClass('active-col');
    $('#colthree').removeClass('active-col');
    
    
    
    });
    
    $('#colthree').on ('click',function(){
    $(this).addClass('active-col'); 
      $('#colone').removeClass('active-col');
    $('#coltwo').removeClass('active-col');
    
    
    });
		$(document).ready(function(){
      $('.count').prop('disabled', true);
       $(document).on('click','.plus',function(){
      $('.count').val(parseInt($('.count').val()) + 1 );
      });
        $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
          if ($('.count').val() == 0) {
          $('.count').val(1);
        }
          });
          
   });
   $('#gMonth2').change(function(){
    var month = $(this).val();
    $('#gMonth1').val(month);
  });

  $('#gtime2').change(function(){
    var month = $(this).val();
    $('#gtime1').val(month);
  });


  //  Toggle Navigation
  // $(window).click(function() {
  //   //Hide the menus if visible
  //     $('#dropdownlinkss .dropdown-menu').css('display', 'none');
  //     $(".userbars").removeClass("addClose");
  // });
  
  $('#dropdownlinkss').click(function(){
    // event.stopPropagation();
    $(".userbars").toggleClass("addClose");
  });


  // Mobile Menu Admin d

  $('.openBtMob').click(function(){
    $('.custom-tabs').css('height', '385px');
    $('.closeBtMob').css('display', 'block');
  })
  $('.closeBtMob').click(function(){
    $('.custom-tabs').css('height', '50px');
    $('.btn_mobileMenu').css('display', 'block');
    $('.closeBtMob').css('display', 'none');
  })
  $('.custom-tabs a').click(function(){
    $('.custom-tabs').css('height', '50px');
    $('.btn_mobileMenu').css('display', 'block');
    $('.closeBtMob').css('display', 'none');
  })


  // SignUp Form
  $(document).ready(function(){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    
    setProgressBar(current);
    
    $(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(++current);
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
    }
    
    $(".submit").click(function(){
    return false;
    })
    
    });
    $('button#scroll_top').click(function () {
      $('html, body').animate({
          scrollTop: '0px'
      },
      1500);
      return false;
  }); 
    });
      // scroll-top
      