var select = function( $ ){
    
    var $container = $( "<div />", {
       id: "bg-select-container",
       class: "bg-booking-menu",
       style: "display:none;position:absolute;z-index:94999;"
    });
    
    var $parent = undefined;
    var clear_items = function(){        
        $container.css( "left", "0");
        $container.css( "top", "0");
        $container.css( "height", "0");
        $container.html( "" );
        if ($parent) {
            $parent.removeClass( "active" );
        }
    };
    
    var recalc_position = function( $parent, $container ) {
        var offset = $parent.offset();
        var height = $parent.height();
        $container.css( "left", (5 + offset.left)   + "px");
        $container.css( "top", (height + offset.top + 2)    + "px");
        $container.css( "height", "140px");
        var client_rect = $parent.get(0).getBoundingClientRect();        
        $container.width( client_rect.width - 10 );      
    };
    
    $( document ).ready(function(){
        
        $container.appendTo( "body" );
        
        $( "body" ).on( "click", function( e ){            
            clear_items();            
        });
        
        $( "#bg-select-container" ).on ( "touchend click", ".bg-booking-menu li", function( e ){               
            e.stopPropagation();                         
            var selected_item = $( this ).text();
            $parent.find( "span" ).text( selected_item );
            $parent.removeClass( "active" );
            clear_items();             
            $parent.trigger( "change", selected_item );                         
        });
                
        
        $selects = $( "[data-role='select']" );
                
        // Sets the default values
        $selects.each( function( i, v){            
           var $this = $( v );           
           $( "<span />", {
               text: $this.find( "li[data-role='default']" ).text()
           }).insertBefore( $this.find( "ul" ) );
           
        });
        
        $selects.on( "click", function( e ){
            var $this = $( this );
            e.stopPropagation();
            e.stopImmediatePropagation();                        
            
            $this.addClass( "active" );
            var offset = $this.offset();
            var height = $this.height();
            
            $parent = $this;
                        
            $container.html( $this.find( "ul" ).clone() );
            
            recalc_position( $parent, $container );
            
            $container.find( "ul" ).addClass( "active" );
            $container.show();                        
        });
                     
        $( window ).on( "scroll", function(){                      
            if ( $parent ) {
                recalc_position( $parent, $container );
            }
        });
         
    });
    
    
    $.fn.bgselect = function( ) {
        var $item = this;
        return {
            get_value: function() {               
                return $item.find( "span" ).text();
            },
            setValue: function( value ) {
                $item.find( "span" ).text( value );                
                $item.parent( "div" ).trigger( "change", value );
            },
            reset: function() {
                var default_value = $item.find( "li[data-role='default']:first" ).first().text();                
                $item.find( "span" ).text( default_value ); 
                 
                $item.trigger( "change", default_value );
            }
        }
    }
} ( jQuery );