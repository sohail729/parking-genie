$(function(){
    jQuery('a.nav-link.drpdown').on('click', function () {
        jQuery('.navbar-expand .navbar-nav .dropdown-menu').toggle();
    });


    $('#colone').on('click', function () {
        $(this).find('input').prop('checked', true)
        $(this).addClass('active-col');
        $('#coltwo').removeClass('active-col');
        $('#colthree').removeClass('active-col');


    });


    $('#coltwo').on('click', function () {
        $(this).find('input').prop('checked', true)
        $(this).addClass('active-col');
        $('#colone').removeClass('active-col');
        $('#colthree').removeClass('active-col');



    });

    $('#colthree').on('click', function () {
        $(this).find('input').prop('checked', true)
        $(this).addClass('active-col');
        $('#colone').removeClass('active-col');
        $('#coltwo').removeClass('active-col');


    });
    $(function(){
        $(document).on('click', '.plus', function () {
            $('.count').val(parseInt($('.count').val()) + 1);
        });
        $(document).on('click', '.minus', function () {
            $('.count').val(parseInt($('.count').val()) - 1);
            if ($('.count').val() == 0) {
                $('.count').val(1);
            }
        });

    });
 

    //  Toggle Navigation
    // $(window).on('click', function() {
    //   //Hide the menus if visible
    //     $('#dropdownlinkss .dropdown-menu').css('display', 'none');
    //     $(".userbars").removeClass("addClose");
    // });

    $('#dropdownlinkss').on('click',function () {
        // event.stopPropagation();
        $(".userbars").toggleClass("addClose");
    });


    // Mobile Menu Admin d

    $('.openBtMob').on('click',function () {
        $('.custom-tabs').css('height', '385px');
        $('.closeBtMob').css('display', 'block');
    })
    $('.closeBtMob').on('click',function () {
        $('.custom-tabs').css('height', '50px');
        $('.btn_mobileMenu').css('display', 'block');
        $('.closeBtMob').css('display', 'none');
    })
    $('.custom-tabs a').on('click',function () {
        $('.custom-tabs').css('height', '50px');
        $('.btn_mobileMenu').css('display', 'block');
        $('.closeBtMob').css('display', 'none');
    })


    // SignUp Form
    $(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").on('click' ,function () {

            current_fs = $(this).parent();
            if ($('#signupForm').valid()) {
                next_fs = $(this).parent().next();


                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
            }
            setProgressBar(++current);
        });

        $(".previous").on('click',function () {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").on('click', function () {
            return false;
        })

        $(document).on('click', "#select-plan", function () {
            let el = $(this);
            if (el != undefined && el != null) {
                // window.location = el.data('r') + '?t=' + el.data('t') + '&p=' + el.data('p');
                window.location = el.data('r') + '?t=' + el.data('t');
            }
        })
    });

    $('button#scroll_top').on('click', function () {
        $('html, body').animate({
                scrollTop: '0px'
            },
            1500);
        return false;
    });
// scroll-top


$(document).on('click', '.get-started-btn', function () {
    setTimeout(() => {
        $('#loginModal').modal('show')
    }, 500);
})
$(document).on('click', '.forgotPwd', function () {
    $('#loginModal').find('.removeLogin').trigger('click');
    $('#loginModal').modal('hide');
    setTimeout(() => {
        $('#resetModal').modal('show')
    }, 500);
})

$(document).on('change', 'select[name="selected_time"]', function () {
    time = $(this).val()
    price = $('.sp-price').text()
    amount = time * price
    $('.sp-btn-price').text(amount)
})

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
 }
 

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position)=> {
            const p=position.coords;
            // let lat = localStorage.setItem('lat', p.latitude);
            // let lng = localStorage.setItem('lng', p.longitude);
            setCookie('lat_local', p.latitude, 7);
            setCookie('lng_local',  p.longitude, 7);
        })
    } else {
        alert("Geolocation is not supported by this browser.");
    }

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click' , '.toggle-password .toggle' ,function(event) {
    event.preventDefault();
    let el = $(this).closest('.toggle-password')
    let input = el.find('input')
    let icon = el.find('span i')
    if(input.attr("type") == "text"){
        input.attr('type', 'password');
        icon.addClass( "fa-eye-slash" );
        icon.removeClass( "fa-eye" );
    }else if(input.attr("type") == "password"){
        input.attr('type', 'text');
        icon.removeClass( "fa-eye-slash" );
        icon.addClass( "fa-eye" );
    }
});

});