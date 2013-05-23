( function( $ ){
  
  // Strict Javascript.
  "use strict";
  
  /**
   * Page object.
   */
  var PurchasingPower = function( ){
    
    /***
     * Modal buttons initialization.
     */
    var _InitializeModalButtons = function(){
      
      // For each modal window trigger button...
      $( 'a.button-for-modal' ).click( function(e){
        var id = $( this ).attr( 'href' );
        var $el = $(this);
        if (!$el.data('modal')) {
          var modal = {};
          // Clones element and gets independent elements for title and content.
          modal.content = $( id ).clone( );
          modal.content.removeClass('element-invisible');
          modal.content.find("input.ajax-processed").removeClass("ajax-processed");
          modal.title = modal.content.find( 'h2' ).remove().html( );
          $el.data('modal', modal);
          $( id ).remove();
        }
        else {
          var modal = $el.data('modal');
        }
        
        // Defines a class to help style the element and displays modal dialog.
        modal.content.dialog( { dialogClass: 'ui-dialog-' + id.replace( '#', '' ), draggable: false, modal: true, resizable: false, title: modal.title } );
        
        Drupal.attachBehaviors(id);
        // Stops propagation.
        e.preventDefault();
        
      } ); 
      
    };
    
    /***
     * Initializes employers FAQs page.
     */
    var _InitializeFAQs = function( ){
      
      // For the headings on the FAQs page...
      $( '#block-system-main .view-id-faq .faq h2' ).each( function( ){ 
      
        // Adds the "trigger" and "off" classes. Hides FAQ answer. Sets click handler that displays or hides content.
        $( this ).addClass( 'trigger' ).addClass( 'off' ).click( function( ){
          $( this ).next( ).slideToggle( ).end( ).toggleClass( 'off' );
        } ).next( ).hide( );
      
      } );
       
    };
    
    /**
     * Allows styling for form elements.
    var _InitializeFormSubmits = function( ){
      
      // For each form submit button...
      $( 'form input[type="submit"], form input[type="button"]' ).each( function( ){
        
        // Element.
        var input = $( this );
        
        // Adds link and wraps on "invisible" container that allows standard behavior.
        var link = $( '<a href="#" class="button"><span>' + input.val( ) + '</span></a>' ).click( function( ){ input.click( ); return false; } );
        input.after( link ).wrap( '<div class="element-invisible"></div>' );
        
      } );
      
    };
     */
    
    /**
     * Modal link initialization.
     */
    var _InitializeModalLinks = function( ){
      
      // On click, shows modal content.
      $( 'a.modal' ).click( function( e ){ 
        $( 'span.message', this ).clone( ).dialog( { modal: true, dialogClass: 'dialog-message', title: $( 'span.title', this ).html( ) } );
        e.preventDefault();
      } );
      
    }
    
    /**
     * Homepage initialization.
     */
    var _InitializeFeaturedBrandsView = function( ){
      
      // Featured brands initialization.
      $( '.pane-featured-brands' ).each( function( ){ 
        
        // Width.
        var _currentPosition = 8;
        var _list = $( 'ul', this );
        var _items = _list.children( );
        
        // Brand navigation previous.
        $( '<a href="#" id="link-previous" class="link-brand-navigation">' + Drupal.t( 'Previous' ) + '</a>' ).click( function( ){

          // If element can be animated...
          if( _currentPosition - 1 >= 8 ){
            _list.not( ':animated' ).animate( { left: '+=' + ( 36 + _items.eq( _currentPosition - 1 ).width( ) ) }, { duration: 1000, complete: function( ){ _currentPosition--; } } );
          }     
          
          // Stops propagation.
          return false;
          
        } ).appendTo( $( '.pane-content', this ) );
        
        // Brand navigation next.
        $( '<a href="#" id="link-next" class="link-brand-navigation">' + Drupal.t( 'Next' ) + '</a>' ).click( function( ){
          
          // If element can be animated...
          if( _currentPosition + 1 <= _items.size( ) ){
            _list.not( ':animated' ).animate( { left: '-=' + ( 36 + _items.eq( _currentPosition ).width( ) ) }, { duration: 1000, complete: function( ){ _currentPosition++; } } );
          }          

          // Stops propagation.
          return false;

        } ).appendTo( $( '.pane-content', this ) );
        
      } );
      
    };

    /**
     * Product range initialization.
     **/
    var _InitializeBrokersProductRange = function( ){
      
      // For the product range page...
      $( '#product-range' ).each( function( ){
        
        // For each view...
        $( '#product-range div.pane-content div.view-footer div.item-list' ).each( function( ){
          
          var list = $( '.views-row', this );
          list.parent( ).width( list.eq( 0 ).width( ) * list.size( ) ); 
          
        } );
        
      } ); 
      
    };

    /**
     * Initializes print buttons.
     **/
    var _InitializePrintButtons = function( ){
      
      // To all buttons, display print dialog on click.
      $( 'a.print' ).click( function( ){
        window.print( ); 
      } );
      
    };

    /**
     * Initializes Broker's Contact Page (with us map and representative info).
     **/
    var _InitializeBrokersContactUsPage = function( ){
      
      // For the map container...
      $( '#representatives-map-view-container' ).each( function( ){ 
      
        // When trigger is clicked...
        $( 'a.representative-trigger', this ).click( function( ){ 
        
          // Displays modal window of the content (it is cloned to allow future display).
          $( $( this ).attr( 'href' ) ).clone( ).removeClass( 'element-invisible' ).find( 'a.button' ).click( function( ){
            
            // Closes modal window.
            $( 'div.dialog-representative a.ui-dialog-titlebar-close' ).trigger( 'click' );

            // Stops propagation.
            return false;
            
          } ).end( ).dialog( { dialogClass: 'ui-dialog-representative', draggable: false, modal: true, resizable: false, title: Drupal.t( 'Your Purchasing Power Representative' ) } );
        
          // Stops propagation.
          return false;
        
        } );
      
      } );
      
    };

    /**
     * Public initialization function.
     */
    this.Initialize = function( ){
      
      // Begins initialization process.
      //_InitializeFormSubmits( );
      _InitializeModalLinks( );
      _InitializeFeaturedBrandsView( );
      _InitializeFAQs( );
      _InitializeModalButtons( );
      _InitializeBrokersProductRange( );
      _InitializePrintButtons( );
      _InitializeBrokersContactUsPage( );
      
    };
    
  };
  
  // On DOM Ready, initializes page.
  $( function( ){ ( new PurchasingPower( ) ).Initialize( ); } );
  
} )( jQuery );