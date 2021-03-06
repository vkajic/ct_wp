<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container">
        <div class="row mb-6 pt-6">
            <div class="col-10 offset-1">
                <h1 class="mb-4 display-1 font-weight-bold"><?php the_title(); ?></h1>
                <div class="mb-4 lead">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>

<?php get_footer();
