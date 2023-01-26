<div class="modal fade" tabindex="-1" role="dialog" id="aessia-buscador-modal">

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

						<p class="searchform-title"><?php _e( 'Busca lo que necesites', 'aessia' ); ?></p>

						<?php get_search_form(); ?>

					</div>

			</div>

		</div>

	</div>

</div>