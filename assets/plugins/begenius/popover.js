(function ($) {

    var Popover = function (selector) {
        var self = this;
        var $element;
        var config = {
            popover_selector: '.webui-popover',
            popover_width: 280,
            popover_height: 294,
            cache: false
        };

        var css = {
            "fixed": "bg-booking-fixed"
        };

        this.change = function(){};

        this.unstick = function () {
            if ($element) {
                var offset = $element.offset();
                var height = $element.height();
                $(config.popover_selector)
                    .removeClass(css.fixed)
                    .css("top", (offset.top + height) + "px");
            }
        };

        this.stick = function () {

            $element = $( "#form-prebooking-sticky-wrapper .bg-room-guests").first();


            var offset = $element.offset();
            var height = $element.height();

            $( config.popover_selector )
                .addClass(css.fixed)
                .css("top", (offset.top + height - $( window ).scrollTop()) + "px");
        };

        this.show = function () {
            WebuiPopovers.show($element);
        };

        function init(selector, options) {
            $element = $(selector);

            $element.webuiPopover({
                animation: 'fade',
                width: config.popover_width,
                height: config.popover_height,
                trigger: 'click' ,
                arrow: false
            })
            .on( "shown.webui.popover", function ( ) {
                   $( config.popover_selector )
                        .removeClass( "right" )
                        .addClass( "bottom" )
                        .find(".webui-arrow")
                        .css( "top", "")
                        .css("left", ( config.popover_width / 2 ) + "px" );


                    var offset = $element.offset(),
                        height = $element.height(),
                        width = $element.width();

                    if ( $( window ).width() > 420 ) {

                        $( config.popover_selector )
                          .find( ".webui-arrow" )
                          .removeClass( "bg-booking-hidden" );
                        var left = ( offset.left + ( width / 2 ) - ( config.popover_width / 2 ) );
                        $( config.popover_selector )
                            .css("top", ( offset.top + height ) + "px" )
                            .css("left",  ( left < 0 ? 20 : left ) + "px" );

                    } else {
                      $( config.popover_selector )
                          .find( ".webui-arrow" )
                          .addClass( "bg-booking-hidden" );

                      $( config.popover_selector )
                            .css("top", ( offset.top + ( height / 2 ) - ( config.popover_height / 2) ) + "px" )
                            .css("left", ( $( window ).width() / 2 ) - ( config.popover_width / 2 )  + "px" );

                    }

                    if ( bgform.is_sticky() ) {
                        self.stick();
                    }
            })
            .on( "show.webui.popover", function ( $element ) {
                if ( bgform.is_sticky() ) {
                    $( ".webui-popover-content" )
                        .find( "#bg-booking-popover" )
                        .attr( "data-offset-top", "256" );
                }

                $( "body" ).trigger( "click" );
            });

            if ( WebuiPopovers.isCreated( $element ) ) {
                $( ".webui-popover" ).addClass( "webui-popover-bg-booking-hidden" );
                WebuiPopovers.show( $element );
                WebuiPopovers.hide( $element );
                $( ".webui-popover" ).removeClass( "webui-popover-bg-booking-hidden" );
            }
        }

        init(selector);
    };

    window.bgpopover = {
        create_new: function ( selector ) {
            return new Popover( selector );
        }
    };
})(jQuery);
