<?php


$args = array(
	'post_type'				=> 'tv',
	'posts_per_page'		=> -1,
	'tax_query'				=> array( array(
								'taxonomy'		=> 'categoria-tv',
								'terms'			=> array( TERM_ID_PROGRAMAS_TV ),
							)),
);

$q = new WP_Query($args); ?>

<?php if ( $q->have_posts() ) { ?>

	<section id="seccion-programas">

		<?php
		$term = get_term( TERM_ID_PROGRAMAS_TV );
		echo '<p class="has-antetitulo-font-size">'. $term->name .'</p>';
		?>

		<?php while ( $q->have_posts() ) { $q->the_post();
			
			get_template_part( 'loop-templates/content' );

		} ?>

	</section>

<?php } ?>

<?php wp_reset_postdata(); ?>

