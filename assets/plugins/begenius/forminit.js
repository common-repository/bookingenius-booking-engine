(function ($) {
    var $parentContainer = undefined,
        $dropDownContainer = undefined,
        $startDateCal = undefined,
        $endDateCal = undefined,
        $startDateCalMobile = undefined,
        $endDateCalMobile = undefined,
        $form = undefined,
        form_width = 0,
        popover = undefined,
        popover_mobile = undefined,
        logger = undefined;
        start_dp_options = {
            numberOfMonths: 1,
            onSelect: function (e) {
                updateEndDateCalendar(e);
            },
            onClose: function (e) {
                $("#mobile-overlay").fadeOut(200);
            },
            beforeShow: function (textbox, instance) {
                instance.dpDiv.addClass("bg-booking-calendar");
                instance.dpDiv.removeClass("bg-booking-calendar-mobile");
            },
            minDate: bgconfig.startDate,
            dateFormat: 'dd M yy'
        },
    end_dp_options = {
        numberOfMonths: 1,
        beforeShow: function ($textbox, $instance) {

            $instance.dpDiv.addClass("bg-booking-calendar");
            $instance.dpDiv.removeClass("bg-booking-calendar-mobile");
        },
        onClose: function (e) {
            $("#mobile-overlay").fadeOut(200);
        },
        dateFormat: 'dd M yy'
    },
    is_mobile = false,
        is_sticky = false;


    function Logger( channel ) {

            this.channel = channel;
            this.mode = "production";

            function get_date() {
                var d = new Date();
                var month = d.getUTCMonth() < 10 ? "0" + d.getUTCMonth() : d.getUTCMonth();
                return d.getUTCFullYear() + "-" + month + "-" + d.getUTCDate() + " " + d.getUTCHours() + ":" + d.getUTCMinutes() + ":" + d.getUTCSeconds() + "." + d.getUTCMilliseconds()
            }
            this.info = function( message ){
                if ( this.mode === "debug" ) {
                    var d = get_date();
                    console.info(d + " [" + this.channel + "]" + ": " + message);
                }
            }
            this.warn = function( message ) {
                var d = get_date();
                console.warn(d + " [" + this.channel + "]" + ": " + message);
            }

            this.error = function( message ) {
                var d = get_date();
                console.error(d + " [" + this.channel + "]" + ": " + message);
            }
    }

    var wp_admin_bar_height = function () {
        var height = $( "#wpadminbar" ).height();
        var offset = $( "#wpadminbar" ).offset();

        if ( offset ) {
            if ( offset.top >= $( window ).scrollTop() ) {
                return $( "#wpadminbar" ).height();
            }
        }
        return 0;
    };

    var updateEndDateCalendar = function (date) {
        var endDate = moment(date, "DD MMMM YYYY");

        endDate.add(1, "days");

        $endDateCal.datepicker("option", "minDate", endDate.toDate());
        $endDateCal.datepicker("setDate", endDate.toDate());

        $endDateCalMobile.datepicker("option", "minDate", endDate.toDate());
        $endDateCalMobile.datepicker("setDate", endDate.toDate());
    };

    var hideCalendar = function (e) {
        $( this ).datepicker('hide');
    };

    var hideCalendars = function(){
        $startDateCal
            .trigger( "blur" )
            .datepicker( 'hide' );
        $endDateCal
            .trigger( "blur" )
            .datepicker( 'hide' );
    };

    // Inizializzazione dei calendari arrivo/partenza
    var initCalendars = function () {

        // Setta i nomi dei giorni utilizzati dai calendairi dayNamesMin => dayNamesShort
        $.datepicker.setDefaults( $.datepicker.regional[ bgconfig.lang ] );
        $.datepicker.setDefaults({dayNamesMin: $.datepicker._defaults.dayNamesShort});
        $startDateCal.datepicker(start_dp_options);

        $startDateCalMobile.datepicker($.extend(start_dp_options, {
            beforeShow: function (textbox, $instance) {

                $instance.dpDiv.addClass("bg-booking-calendar");
                $instance.dpDiv.addClass("bg-booking-calendar-mobile");

                $($instance).webuiPopover();
            }
        }));

        $endDateCal.datepicker(end_dp_options);

        $endDateCalMobile.datepicker($.extend(end_dp_options, {
            beforeShow: function (textbox, $instance) {
                //  $( "#mobile-overlay" ).fadeIn(200);
                $instance.dpDiv.addClass("bg-booking-calendar");
                $instance.dpDiv.addClass("bg-booking-calendar-mobile");
            }
        }));

        $startDateCal.datepicker("option", "minDate", bgconfig.startDate);

    };

    // Inizializza il modulo
    // impostando l'url da chiamare e altri attributi utili
    var initForm = function () {
        logger.info( "Language: " + bgconfig.lang );
        logger.info( "Channel:" + bgconfig.booking_channel );

        $form.attr('name', 'bgform');
        $form.attr('method', 'get');
        $form.attr('target', '_blank');
        $form.attr('action', 'https://secure.begenius.it/bookingenius/hotel_web/' + bgconfig.lang + '/' + bgconfig.booking_channel + '/?v=1');
    };

    var BreakPoint = function (threshold, callback) {
        var _old_width = $(window).width();
        var _threshold = threshold;
        var _callback = function () {
            var window_width = $(window).width();

            if (window_width < _threshold && _old_width > _threshold) {
                _old_width = _threshold - 1;
                callback.call(this, 'desc');
            }

            if (window_width > _threshold && _old_width < _threshold) {
                _old_width = _threshold + 1;
                callback.call(this, 'asc');
            }
        };

        $(window).on("resize", _callback);
    };

    var stick_form = function ( top_spacing ) {
        $form.sticky({
            topSpacing: top_spacing,
            zIndex: 9999,
            backdrop: false
        }).on( "sticky-start" , function ( e, sticky ) {

            $form.addClass( "bg-booking-sticky" );
            popover.stick();
            hideCalendars();

            sticky.topSpacing =  top_spacing + wp_admin_bar_height();

            if ( bgconfig.sticky_form_width === 'same' ) {

                if (form_width) {
                    $form.find(".bg-booking-form-inline").css( "max-width", form_width + "px" );
                }
                $form.find(".bg-booking-form-inline").css( "margin", "0 auto" );
            }


            is_sticky = true;

        }).on( "sticky-end" , function () {
            $form.removeClass( "bg-booking-sticky" );

            hideCalendars();

            if ( bgconfig.sticky_form_width === 'same' ) {
                $form.find(".bg-booking-form-inline").css( "max-width", "100%" );
                $form.find(".bg-booking-form-inline").css( "margin", "" );
            }
            popover.unstick();
            is_sticky = false;
        });

    };

    var create_sticky_form = function () {
        var $form = $("#bgform");
        var top_spacing = 0;
        var $icon = $("#bg-booking-icon");

        if ( $( window ).width() > bgconfig.sticky_breakpoint_1 ) {
            top_spacing = parseInt( bgconfig.sticky_header_height_to_breakpoint_1, 10 );
        }


        stick_form( top_spacing );

        window_width = $(window).width();
        previous_window_width = window_width;


        var bp1 = new BreakPoint(bgconfig.sticky_breakpoint_2, function (direction) {
            form_width = $form.width();
            switch (direction) {
                case 'desc':
                    var top_spacing = 0;
                    break;
                case 'asc':
                    var top_spacing = bgconfig.sticky_header_height_at_breakpoint_2;
                    break;
            }
            $form.unstick();
            stick_form( parseInt(top_spacing, 10));
            $form.sticky( "update" );
        });

        var bp2 = new BreakPoint(bgconfig.sticky_breakpoint_1, function (direction) {

            var top_spacing = 0;
            switch ( direction ) {
                case 'asc':
                    console.log( 'bp1 asc' );
                    form_width = $form.width();
                    top_spacing = bgconfig.sticky_header_height_to_breakpoint_1;
                    break;
                case 'desc':
                    console.log( 'bp1 desc' );
                    form_width = $form.width();
                    top_spacing = bgconfig.sticky_header_height_at_breakpoint_2;
                    break;
            }

            $form.unstick();
            stick_form( parseInt(top_spacing, 10));
             $form.sticky( "update" );
        });

    };

    var create_mobile_form = function(){


        var css_class = $( "#bg-booking-icon" ).attr( "class" );
        if (css_class.indexOf( "top" ) > 0) {
            var position = $("#bg-booking-icon").position();
            $( "#bg-booking-icon" ).css( "top", position.top + wp_admin_bar_height() + "px");
        }

        var width = $(window).width();
        var height = $(window).height();


        $('.ripple').on('click', function (event) {
            event.preventDefault();

            var $div = $('<div/>'),
                btnOffset = $(this).offset(),
                xPos = event.pageX - btnOffset.left,
                yPos = event.pageY - btnOffset.top;



            $div.addClass('ripple-effect');
            var $ripple = $(".ripple-effect");

            $ripple.css("height", $(this).height());
            $ripple.css("width", $(this).height());

            $div
                .css({
                    top: yPos - ($ripple.height() / 2),
                    left: xPos - ($ripple.width() / 2),
                    background: $(this).data("ripple-color")
                })
                .appendTo($(this));

            window.setTimeout(function () {
                $div.remove();
            }, 2000);
        });


        $( "#bg-form-mobile-container" ).appendTo( "body" );
        $( "#bg-booking-icon" ).appendTo( "body" );

        $( "#bg-form-mobile-container" ).css( "height", $( "window" ).height() + "px");

        $( "#bg-booking-icon" ).on( "click", function ( e ) {
            is_mobile = !is_mobile;
            $( "#bg-form-mobile" ).css( "margin-top", wp_admin_bar_height() + "px");
            $( "#bg-form-mobile-container").toggleClass( "bg-form-mobile-visible" );
            $( "#bg-booking-icon" ).toggleClass( "bg-booking-icon-hidden" );
            $( "body" ).toggleClass( "bg-no-scrollbars" );
        });

        $( "body" ).on( "click", ":not(.bg-booking-select)", function () {
            $( ".bg-booking-select" ).removeClass( "active" );
        });

        $( "#bg-form-mobile" ).append( $( "#bgform" ).html() );

    };

    $(document).ready(function () {

        logger = new Logger( "bookingenius-bookingengine" );
        logger.mode = "debug";


        logger.info( "Initializing form" );

        $parentContainer = $( "#form-prebooking" );
        $form = $parentContainer;

        form_width = $form.width();

        moment.locale( bgconfig.lang );
        if ( $( window ).width() > 430 ) {
          if ( bgconfig.sticky_form == 1 ) {
              create_sticky_form();
          }
        }

        $( "button[name=submit-booking]" ).on( "click", function(){
           submitForm();
        });

        // Imposta il colore di sfondo di alcuni elementi del form
        // custom sulla base del colore di sfondo degli <input />
        var $input = $( "input" ).first();
        $( "#form-prebooking .bg-room-guests" ).css( "background-color", $input.css( "background-color" ) );
        $( "#form-prebooking [data-role='select']" ).css( "background-color", $input.css( "background-color" ) );

        // Inizlializza la popover del multicamera
        popover = bgpopover.create_new("#form-prebooking .bg-room-guests");
        popover_mobile = bgpopover.create_new("#bg-form-mobile .bg-room-guests");

        $startDateCal = $parentContainer.find("input[name=checkin]");
        $endDateCal = $parentContainer.find("input[name=checkout]");
        $startDateCalMobile = $("#bg-form-mobile").find("input[name=checkin]");
        $endDateCalMobile = $("#bg-form-mobile").find("input[name=checkout]");

        initCalendars();
        initForm();

        $(window).on("resize", function () {
            WebuiPopovers.hideAll();
        });

        $("#bg-form-mobile-close").on("click", function () {
            $("#bg-form-mobile-container").removeClass("bg-form-mobile-visible");
            $("#bg-booking-icon").removeClass("bg-booking-icon-hidden");
            $("body").toggleClass("bg-no-scrollbars");
            is_mobile = !is_mobile;
            WebuiPopovers.hideAll();
            return false;
        });

        $("#form-prebooking [name=bg-num-rooms], #bg-form-mobile [name=bg-num-rooms]").on("click", function () {
            WebuiPopovers.hideAll();
        });


        $("#form-prebooking [name=bg-num-rooms], #bg-form-mobile [name=bg-num-rooms]").on("change", function (e, value) {

            var num_rooms = parseInt(value, 10);
            var popovers = $("#webuiPopover0, #webuiPopover1");

            popovers.each(function (j, z) {
                var popover = $(this);

                var li = popover.find(".bg-booking-nav li");

                for (var i = 0; i < li.length; i++) {
                    if (i <= num_rooms - 1) {
                        $(li[ i ]).removeClass("bg-booking-hidden");
                    }
                    if (i > num_rooms - 1) {
                        $(li[ i ]).addClass("bg-booking-hidden");
                        var $select = $($(li[ i ]).find("a").attr("href")).find(".bg-room-" + (i + 1) + "-children");
                        $select.bgselect().reset();
                    }
                }
                $("a[data-ref=bg-room-1]").parent("li").trigger("click");

            });

            if (is_mobile) {
                $("#form-prebooking [name=bg-num-rooms]").bgselect().setValue(num_rooms);
            } else {
                $("#bg-form-mobile [name=bg-num-rooms]").bgselect().setValue(num_rooms);
            }


            CalcolaOspiti();
        });

        // Visualizza le select per l'inserimento
        // dell'età dei bambini
        $( "body" ).on( "change", ".bg-room-1-children,.bg-room-2-children,.bg-room-3-children", function (e, value) {
            var $this = $(this);
            var pattern = /[0-9]/i;

            var num_children = parseInt(pattern.exec($this.bgselect().get_value())[0], 10);
            var $children_age = $this.next().find("[data-role=select]");

            $children_age.each(function (i, v) {
                var $item = $(v);
                if (i < num_children) {
                    $item.removeClass("bg-booking-hidden");
                } else {
                    $item.addClass("bg-booking-hidden");
                    $item.bgselect().setValue("Età");
                }
            });
            if (num_children > 0) {
                $this.next().removeClass("bg-booking-hidden");
            } else {
                $this.next().addClass("bg-booking-hidden");
            }
        });

        $("body").on("change", ".bg-room-1-adults,.bg-room-2-adults,.bg-room-3-adults,.bg-room-1-children,.bg-room-2-children,.bg-room-3-children", function (value) {
            CalcolaOspiti();
        });
    });




    // Segue il codice che gestisce l'occupazione
    // multicamera
    var toggle = function (event) {
        var rooms = document.getElementById('num_rooms');

        //nascondo le altre camere
        for (var i = 0; i < 3; i++) {
            if (i < parseInt(rooms.value)) {
                document.getElementById("multi-room").children[i].style.display = "";
                var room = i + 1;
                var b1 = document.getElementById('room-' + room + '-kids').value;
                OpenBambiniAge(room, b1);
            }
            else
                document.getElementById("multi-room").children[i].style.display = "none";
        }

        var pos = {};

        // 0 = tall, 1 = wide
        if (bgconfig.layout == 0) {
            pos = $("#num_rooms").offset();
        } else {
            pos = $(event.target).offset();
        }

        //visualizzo il box
        var mydiv = document.getElementById('room-guests-dropdown');

        //rimuovo tutte le altre classi e imposto la classe corrente
        mydiv.className = "room-dropdown room-dropdown" + rooms.value;

        var dropdown_position = getDropDownPosition(pos);

        mydiv.style.top = dropdown_position.top + 'px';
        mydiv.style.left = dropdown_position.left + 'px';

        $("#bookingenius-dropdown").append(mydiv);


        CalcolaOspiti();
    };

    var CalcolaOspiti = function () {

        switch (is_mobile) {
            case false:
                var $a1 = $("#webuiPopover0").find(".bg-room-1-adults");
                var $a2 = $("#webuiPopover0").find(".bg-room-2-adults");
                var $a3 = $("#webuiPopover0").find(".bg-room-3-adults");
                var $b1 = $("#webuiPopover0").find(".bg-room-1-children");
                var $b2 = $("#webuiPopover0").find(".bg-room-2-children");
                var $b3 = $("#webuiPopover0").find(".bg-room-3-children");
                var $rooms = $("#form-prebooking").find("[name=bg-num-rooms]");
                break;
            case true:
                var $a1 = $("#webuiPopover1").find(".bg-room-1-adults");
                var $rooms = $("#bg-form-mobile").find("[name=bg-num-rooms]");

                var $a2 = $("#webuiPopover1").find(".bg-room-2-adults");
                var $a3 = $("#webuiPopover1").find(".bg-room-3-adults");
                var $b1 = $("#webuiPopover1").find(".bg-room-1-children");
                var $b2 = $("#webuiPopover1").find(".bg-room-2-children");
                var $b3 = $("#webuiPopover1").find(".bg-room-3-children");
                break;
        }



        var totalguests = 0;

        // Estrae il numero di adulti
        var pattern = /[0-9]/i;

        var a1 = parseInt(pattern.exec($a1.bgselect().get_value())[0], 10);
        var a2 = parseInt(pattern.exec($a2.bgselect().get_value())[0], 10);
        var a3 = parseInt(pattern.exec($a3.bgselect().get_value())[0], 10);


        var b1 = parseInt(pattern.exec($b1.bgselect().get_value())[0], 10);
        var b2 = parseInt(pattern.exec($b2.bgselect().get_value())[0], 10);
        var b3 = parseInt(pattern.exec($b3.bgselect().get_value())[0], 10);


        switch ($rooms.bgselect().get_value())
        {
            case "1":

                $(".adults span").text(a1);
                $(".children span").text(b1);
                totalguests = a1 + b1;
                break;
            case "2":
                $(".adults span").text(a1 + a2);
                $(".children span").text(b1 + b2);
                totalguests = a1 + a2 + b1 + b2;
                break;
            case "3":
                $(".adults span").text(a1 + a2 + a3);
                $(".children span").text(b1 + b2 + b3);
                totalguests = a1 + a2 + a3 + b1 + b2 + b3;
                break;
            default:
                totalguests = 2;
                break;
        }
        $(".bg-total-guests").text(totalguests);
    };

    var old_num_rooms = 1;


    var submitForm = function () {

        switch ( is_mobile ) {
            case true:
                var $form = $( "#bg-form-mobile" ),
                    $popover = $( "#webuiPopover1" ),
                    $rooms = $form.find( "[name=bg-num-rooms]" ),
                    $adulti1 = $popover.find( ".bg-room-1-adults" ),
                    $adulti2 = $popover.find( ".bg-room-2-adults" ),
                    $adulti3 = $popover.find( ".bg-room-3-adults" ),
                    $bambini1 = $popover.find( ".bg-room-1-children" ),
                    $bambini2 = $popover.find( ".bg-room-2-children" ),
                    $bambini3 = $popover.find( ".bg-room-3-children" ),
                    $checkin = $form.find( "input[name=checkin]" ),
                    $checkout = $form.find( "input[name=checkout]" );

                break;
            case false:
                var $form = $( "#form-prebooking" ),
                    $popover = $( "#webuiPopover0" ),
                    $rooms = $form.find( "[name=bg-num-rooms]" ),
                    $adulti1 = $popover.find( ".bg-room-1-adults" ),
                    $adulti2 = $popover.find( ".bg-room-2-adults" ),
                    $adulti3 = $popover.find( ".bg-room-3-adults" ),
                    $bambini1 = $popover.find( ".bg-room-1-children" ),
                    $bambini2 = $popover.find( ".bg-room-2-children" ),
                    $bambini3 = $popover.find( ".bg-room-3-children" ),
                    $checkin = $form.find( "input[name=checkin]" ),
                    $checkout = $form.find( "input[name=checkout]" );
                break;
        }

        var rooms = parseInt( $rooms.bgselect().get_value(), 10);
        var adulti = [];
        var bimbi = [];

        // Estrae il numero di adulti
        var pattern = /[0-9]/i;

        adulti[1] = parseInt( pattern.exec( $adulti1.bgselect().get_value() )[0], 10);
        adulti[2] = parseInt( pattern.exec( $adulti2.bgselect().get_value() )[0], 10);
        adulti[3] = parseInt( pattern.exec( $adulti3.bgselect().get_value() )[0], 10);
        bimbi[1] = parseInt( pattern.exec( $bambini1.bgselect().get_value() )[0], 10);
        bimbi[2] = parseInt( pattern.exec( $bambini2.bgselect().get_value() )[0], 10);
        bimbi[3] = parseInt( pattern.exec( $bambini3.bgselect().get_value() )[0], 10);

        var checkin_date = moment( $checkin.val(),  "DD MMMM YYYY");
        var checkout_date = moment( $checkout.val(),  "DD MMMM YYYY" );


        var urlcheckin = "&checkin=" + checkin_date.format('YYYY-MM-DD');
        var urlcheckout = "&checkout=" + checkout_date.format('YYYY-MM-DD');

        var guests = "";

        for (i = 1; i <= rooms; i++) {
            if (i>1)
             guests += "-";

            guests += adulti[i];

            if (bimbi[i] > 0)
            {
                for (a = 1; a <= bimbi[i]; a++) {
                    var age = $popover.find( ".bg-room-" + i + "-child-" + a ).bgselect().get_value();
                    if  ( age === "0-1" ) {
                        age = "0";
                    }

                    guests += "," + age;

                }
            }
        }

        var form = document.getElementById("form-prebooking");
        var url = form.getAttribute("action");

        var urlrooms = "&rooms=" + guests;
        var fullurl = url + urlcheckin + urlcheckout + urlrooms;
        console.log( fullurl );
        window.open(fullurl);

    };

    window.bgform = {
        is_sticky: function () {
            return is_sticky;
        },
        is_mobile: function () {
            return is_mobile;
        }
    };

})(jQuery);
