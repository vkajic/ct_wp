<?php /* Template Name: Blog posts */ ?>
<?php get_header(); ?>
<?php $args = array(
	'post_type' => 'post'
); ?>
<?php $the_query = new WP_Query( $args ); ?>
    <div class="container mb-6 pt-6">
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="row mb-5">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <h1 class="mb-3 font-weight-bold">
                        <a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
                        </a>
                    </h1>
                    <div class="lead">
						<?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
		<?php endwhile; endif; ?>
    </div>
<?php wp_reset_postdata(); ?>
<?php get_footer();
