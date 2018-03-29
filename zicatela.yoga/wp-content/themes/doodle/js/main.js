(function($) {

    "use strict";

    var fxQueue = $({});

    function isMobile() {
        var agent = navigator.userAgent || navigator.vendor || window.opera
        return (/(ipad|playbook|silk|android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(agent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(agent.substr(0, 4))) ? true : false
    }

    function initSliders() {
        $('.portfolio-slider, .product-slider').slick({
            infinite: true,
            slidesToShow: 3,
            dots: true,
            arrows: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
        $('.standard-slider').slick({
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 8000
        });
        $('.gallery-thumb').slick({
            dots: false,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 8000
        });
    }

    function initScrollReveal() {
        if (Modernizr.csstransforms && !isMobile()) {

            // prepare scroll reveal classes
            $('.enter-top-1').attr('data-sr', 'enter top wait 0.2s');
            $('.enter-top-2').attr('data-sr', 'enter top wait 0.4s');
            $('.enter-top-3').attr('data-sr', 'enter top wait 0.6s');
            $('.enter-right-1').attr('data-sr', 'enter right wait 0.2s');
            $('.enter-right-2').attr('data-sr', 'enter right wait 0.4s');
            $('.enter-right-3').attr('data-sr', 'enter right wait 0.6s');
            $('.enter-bottom-1').attr('data-sr', 'enter bottom wait 0.2s');
            $('.enter-bottom-2').attr('data-sr', 'enter bottom wait 0.4s');
            $('.enter-bottom-3').attr('data-sr', 'enter bottom wait 0.6s');
            $('.enter-left-1').attr('data-sr', 'enter left wait 0.2s');
            $('.enter-left-2').attr('data-sr', 'enter left wait 0.4s');
            $('.enter-left-3').attr('data-sr', 'enter left wait 0.6s');
            $('.scale-up-1').attr('data-sr', 'move 0px wait 0.2s scale up 15%');
            $('.scale-up-2').attr('data-sr', 'move 0px wait 0.4s scale up 15%');
            $('.scale-up-3').attr('data-sr', 'move 0px wait 0.6s scale up 15%');
            $('.scale-down-1').attr('data-sr', 'move 0px wait 0.2s scale down 15%');
            $('.scale-down-2').attr('data-sr', 'move 0px wait 0.4s scale down 15%');
            $('.scale-down-3').attr('data-sr', 'move 0px wait 0.6s scale down 15%');

            window.sr = new scrollReveal({
                reset: false,
                mobile: false,
                scale: {
                    direction: 'up',
                    power: '0%'
                }
            });
        } else {
            $('[data-sr]').addClass("fadeIn").css('visibility', 'visible');
        }
    }

    function initCountdown() {
        $('.doodle-countdown').each(function() {
            $(this).countdown($(this).data('finaldate'), function(event) {
                var labelDays = $(this).data('days');
                var labelHours = $(this).data('hours');
                var labelMinutes = $(this).data('minutes');
                var labelSeconds = $(this).data('seconds');
                $(this).html(event.strftime('' + '<div class="col-sm-3 col-xs-12"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>%D</span>'+labelDays+'</div></div></div></div></div> ' + '<div class="col-sm-3 hidden-xs"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>%H</span>'+labelHours+'</div></div></div></div></div> ' + '<div class="col-sm-3 hidden-xs"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>%M</span>'+labelMinutes+'</div></div></div></div></div> ' + '<div class="col-sm-3 hidden-xs"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>%S</span>'+labelSeconds+'</div></div></div></div></div> '));
            });
        });
    }

    function initMailChimp() {
        $('#mc_embed_signup input[type="text"], #mc_embed_signup input[type="email"]').each(function() {
            var placeholder = $(this).prev("label").text();
            $(this).attr('placeholder', placeholder);
        });
        $('#mc_embed_signup .button').addClass('btn btn-large');
    }

    function initSmoothScroll() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 600, 'easeInOutQuad');
                    return false;
                }
            }
        });
    }

    function initMap() {

        var myLatlng = new google.maps.LatLng($('#map_canvas').data("lat"), $('#map_canvas').data("lng"));
        var isDraggable = $(document).width() > 480 ? true : false;
        var myOptions = {
            zoom: 14,
            scrollwheel: false,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            draggable: isDraggable
        }
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            icon: templateDir + '/img/marker.png',
            map: map,
            title: ""
        });

        if ( $('#map_canvas').hasClass('black-and-white') ) {
            var jrMapStyles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];
            var jrMapType = new google.maps.StyledMapType(jrMapStyles, {
                name: "jrmap"
            });
            map.mapTypes.set('jrmap', jrMapType);
            map.setMapTypeId('jrmap');
        }

        if ($('#map_canvas_infowindow').html()) {
            var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<div id="bodyContent">' +
                '<div style="margin-top:10px; margin-bottom:10px;color:#333; white-space:nowrap">' +
                $('#map_canvas_infowindow').html() +
                '</div>' + '</div>' + '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        }

    }

    function drawSVG() {
        $('.animated-svg').each(function(i, el) {
            if ($(el).css('visibility') != 'hidden') {
                $(el).find('path').each(function(i, el) {
                    fxQueue.queue("intro", function() {
                        $(el).animate({
                            strokeDashoffset: 0
                        }, 400, function() {
                            fxQueue.dequeue('intro');
                        });
                    });
                });
            } else {
                $(el).find('path').each(function(i, el) {
                    $(el).css('strokeDashoffset', 0);
                });
            }
        });
    }

    function initQueue() {
        /* SLIDERS */
        fxQueue.queue("intro", function() {
            initSliders();
            fxQueue.dequeue('intro');
        });
        /* COUNT DOWN */
        fxQueue.queue("intro", function() {
            initCountdown();
            fxQueue.dequeue('intro');
        });
        /* SCROLL REVEAL */
        fxQueue.queue("intro", function() {
            initScrollReveal();
            fxQueue.dequeue('intro');
        });
        /* FADE OUT LOADING ICON */
        fxQueue.queue("intro", function() {
            $('.loading-modal').fadeOut(400, function() {
                $('body').removeClass('loading');
                fxQueue.dequeue('intro');
            });
        });
        /* ANIMATE SVG */
        if (Modernizr.inlinesvg) {
            drawSVG();
        }
        /* FADE IN INTRO TEXT */
        fxQueue.queue("intro", function() {
            $('.fullwidth-intro-text .vertical-align-content').addClass('fadeIn');
            fxQueue.dequeue('intro');
        });
        /* ACTIVATE SLIDER ARROWS */
        fxQueue.queue("intro", function() {
            $('.animated-arrow').addClass('drawn');
            fxQueue.dequeue('intro');
        });
        /* MAILCHIMP */
        fxQueue.queue("intro", function() {
            initMailChimp();
            fxQueue.dequeue('intro');
        });
        /* SMOOTH SCROLL */
        /*
        fxQueue.queue("intro", function() {
            initSmoothScroll();
            fxQueue.dequeue('intro');
        });
        */
        /* MAP */
        if ($('#map_canvas').length) {
            fxQueue.queue("intro", function() {
                initMap();
                fxQueue.dequeue('intro');
            });
        }
        fxQueue.dequeue('intro');

    }

    function embedSVGandInitQueue() {
        var totalSVG = $('.animated-svg').length;
        if (Modernizr.inlinesvg && totalSVG) {
            $('.animated-svg').each(function(i, el) {
                $(el).load($(el).attr('data-src'), null, function() {
                    $(el).find('path').each(function(i, el) {
                        var total_length = Math.ceil(el.getTotalLength()) + 1;
                        $(el).css('stroke-dashoffset', total_length).css('stroke-dasharray', total_length);
                    });
                    --totalSVG;
                    if (totalSVG < 1) {
                        initQueue();
                    }
                });
            });
        } else {
            $('#intro-slider-wrapper').addClass('hand-drawn-border');
            initQueue();
        }
    }

    $(window).load(function() {

        /* ISMOBILE CLASS */
        var isMobileClass = (isMobile()) ? 'mobile' : 'no-mobile';
        $('html').addClass(isMobileClass);

        /* ANIMATED DROPDOWN */
        $('.animated-dropdown .dropdown-menu').each(function(index, element) {
            $(element).children('li').each(function(i, el) {
                var max = 5;
                var min = -5;
                var rotation = Math.floor(Math.random() * (max - min)) + min;
                $(el).attr('data-rotation', rotation);
                $(el).css('transform', 'translateY(-' + 100 * (i + 1) + '%)').css('opacity', 0);
                var zindex = $(element).children('li').length - i;
                $(el).css('z-index', zindex);
                $(el).css('transition-delay', zindex / 20 + 's');
            });
            $(element).children('li').click(function(e) {
                e.stopPropagation();
            });
        });
        $('.animated-dropdown.dropdown').on('shown.bs.dropdown', function() {
            $(this).find('li').each(function(i, el) {
                $(el).css('transform', 'translateY(0) rotate(' + $(el).attr('data-rotation') + 'deg)').css('opacity', 1);
            });
        });
        $('.animated-dropdown.dropdown').on('hidden.bs.dropdown', function() {
            $(this).find('li').each(function(i, el) {
                $(el).css('transform', 'translateY(-' + 100 * (i + 1) + '%)').css('opacity', 0);
            });
        });

        /* FITVIDS */
        $("#main, .boxed-video").fitVids();

        /* BACKGROUND VIDEO */
        if ($("#doodle-jumbotron .ytplayer-bg").length) {
            $(".ytplayer-bg").mb_YTPlayer();
            $('.ytplayer-bg').on("YTPStart", function(e) {
                setTimeout(function() {
                    $('#doodle-jumbotron').css('background-image', 'none');
                }, 1000);
            });
            embedSVGandInitQueue();
        }

        /* BACKGROUND SLIDER */
        else if ($("#doodle-jumbotron #fullwidth-slider").length) {
            $('#fullwidth-slider .fullwidth-slide').each(function() {
                var imgURL = $(this).children('img').attr('src');
                $(this).css('background-image', 'url(' + imgURL + ')');
            });
            $('#fullwidth-slider').slick({
                dots: false,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 8000,
                prevArrow: '#animated-arrow-left',
                nextArrow: '#animated-arrow-right'
            });
            embedSVGandInitQueue();
        }

        /* BOXED SLIDER */
        else if ($("#doodle-jumbotron #boxed-slider").length) {
            var showNextAndPrev = $("#boxed-slider-wrapper").hasClass('show-next-and-prev');
            $('#boxed-slider').slick({
                dots: false,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 8000,
                prevArrow: '#animated-arrow-left',
                nextArrow: '#animated-arrow-right',
                centerPadding: "1px",
                centerMode: showNextAndPrev
            });
            if ($("#boxed-slider-wrapper").hasClass('center-slides')) {
                $('#boxed-slider .boxed-slide').matchHeight();
            }
            embedSVGandInitQueue();
        } else {
            embedSVGandInitQueue();
        }
    });

})(jQuery);