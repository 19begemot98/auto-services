<?php get_header(); ?>
<?php while (have_posts()):
    the_post(); ?>
    <article class="single-page">
        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    </article>
<?php endwhile; ?>
<?php get_footer(); ?>