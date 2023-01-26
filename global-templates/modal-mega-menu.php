<div class="modal fade" tabindex="-1" role="dialog" id="aessia-menu-modal">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="container">

				<div class="modal-header">

					<a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/aessia-logo-blanco.svg" alt="<?php _e( 'Logo Aessia', 'aessia' ); ?>" class="logo-aessia-modal" width="140" height="43" /></a>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span class="cerrar" aria-hidden="true"></span>
			        </button>

				</div>

				<div class="modal-body">

					<?php 
					
					if ( wp_is_mobile() ) {

						echo '<nav class="navbar navbar-expand-md navbar-dark navbar-movil">';

						wp_nav_menu( array(
							'theme_location'  => 'mega_menu',
							// 'container'       => 'nav',
							'container_class' => 'collapsexxx navbar-collapse',
							'container_id'	  => 'aessia-menu-inner',
							'menu_class'	  => 'menu navbar-nav',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),


						// 'theme_location'  => 'primary',
						// 'container_class' => 'collapse navbar-collapse',
						// 'container_id'    => 'navbarNavDropdown',
						// 'menu_class'      => 'navbar-nav ml-auto',
						// 'fallback_cb'     => '',
						// 'menu_id'         => 'main-menu',
						// 'depth'           => 2,
						// 'walker'          => new Understrap_WP_Bootstrap_Navwalker(),


						) ); 

						echo '</nav>';

					} else {

						wp_nav_menu( array(
							'theme_location'  => 'mega_menu',
							'container'       => 'nav',
							'container_id'	  => 'aessia-menu-inner',
							'menu_class'	  => 'menu',
						) ); 

					}
					?>

				</div>

			</div>

		</div>

	</div>

</div>