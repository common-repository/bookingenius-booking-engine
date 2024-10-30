( function( $ ) {
  var $form = undefined,
      $mobile_form = undefined;
  
    
    var controls_color = ''
        + '#bgform form .bg-booking-append,'
        + '#bgform form .bg-booking-select:after { '
        + ' color: {ICONS_COLOR}!important;' 
        + '}'
        + '#bgform form label {'
        + 'color: {LABEL_COLOR}!important;'
        + '}'
        + '#bgform form button {'
        + 'background-color:{BACKGROUND_COLOR}!important;'
        + 'color: {BUTTON_TEXT_COLOR}!important;'
        + '}'
        + '#bgform form .bg-booking-select,'
        + '#bgform form #bg-room-guests,'
        + '#bgform form input { '
        + ' color: {CONTROLS_COLOR}!important;' 
        + '}'; 
    
    var styles = {};
    
  function css_build( options ) {
      $( "head" )
          .find( "#bg-bookingenius-customize" )
          .remove();
      
      var controls_color_compiled = controls_color;
      for ( var prop in options ) {
          controls_color_compiled = controls_color_compiled.replace( "{" + prop + "}", options[ prop ] );
      }
     
      var $style = $( "<style />", {
          id: "bg-bookingenius-customize",
          text: controls_color_compiled
      });
      
      $( "head" ).append( $style );
  }
  
  $( document ).ready( function(){
        $form = $( "#form-prebooking" );
        $mobile_form = $( "#bg-form-mobile");
  });
  
  wp.customize( 'bg_bookingenius_label_color', function( value ) {
          
    value.bind( function( to ) { 
        styles.LABEL_COLOR = to;    
        css_build( styles );
    } );
  } );
  
  wp.customize( 'bg_bookingenius_controls_color', function( value ) {
    
      
    value.bind( function( to ) {      
        styles.CONTROLS_COLOR = to;
        css_build( styles ); 
    } );
  } );
  
  wp.customize( 'bg_bookingenius_button_background_color', function( value ) {        
    value.bind( function( to ) {   
        styles.BACKGROUND_COLOR = to;
        css_build( styles ); 
    } );
  } );
  
  wp.customize( 'bg_bookingenius_button_text_color', function( value ) {
    
    value.bind( function( to ) {      
        styles.BUTTON_TEXT_COLOR = to;  
              
       css_build( styles );      
     
    } );
  } );   
  wp.customize( 'bg_bookingenius_icons_color', function( value ) {
    
    value.bind( function( to ) {      
        styles.ICONS_COLOR = to;                
        css_build( styles );           
    } );
  } );
   
} )( jQuery );