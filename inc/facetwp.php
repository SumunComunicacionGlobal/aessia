<?php
/**
 * Theme basic setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'facetwp_facet_html', function( $output, $params ) {
    if ( 'dropdown' == $params['facet']['type'] ) {
        $output = str_replace( 'facetwp-dropdown', 'facetwp-dropdown form-control', $output );
    }

    if ( 'search' == $params['facet']['type'] ) {
        $output = str_replace( 'facetwp-search', 'facetwp-search form-control', $output );
    }

    return $output;
}, 10, 2 );

add_action( 'wp_head', function() { ?>
    <script>
      (function($) {
        $(document).on('facetwp-refresh', function() {
          if (FWP.soft_refresh == true) {
            FWP.enable_scroll = true;
          } else {
            FWP.enable_scroll = false;
          }
        });
        $(document).on('facetwp-loaded', function() {
          if (FWP.enable_scroll == true) {
            $('html, body').animate({
              scrollTop: 0
            }, 500);
          }
        });
      })(jQuery);
    </script>
<?php } );