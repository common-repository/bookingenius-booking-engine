var tabs = function( $ ){

    $( document ).ready(function(){

        $tabs = $( "[data-role='tabs']" );

        var active_links = $tabs.find( ".active" );

        active_links.each(function( i, v){
           var tab_selector = $( v ).find( "a" ).attr( "data-ref" );

           $( "div[data-tab=" + tab_selector + "]" ).addClass( "active" );
        });

        $tabs.on( "click", "li", function( e ){
            e.preventDefault();

            var $this = $( this );

            $this
                .parent( "ul" )
                .parent( "[data-role='tabs']" )
                .find( ".active" )
                .removeClass( "active" );

            $this
                .addClass( "active" );

            var tab_selector = $this.find( "a" ).attr( "data-ref" );

            $this
                .parent( "ul" )
                .parent( "[data-role='tabs']" )
                .find( "div[data-tab=" + tab_selector + "]" )
                .addClass( "active" );
        });

    });

} ( jQuery );
