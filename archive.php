<?php get_header(); ?>

<h1 class="archive-title">
    <?php
    if (is_post_type_archive('articles')) {
        echo 'Все статьи';
    } elseif (is_post_type_archive('promos')) {
        echo 'Все акции';
    } else {
        the_archive_title();
    }
    ?>
</h1>

<div class="archive-grid">
    <?php while (have_posts()):
        the_post(); ?>
        <article class="archive-card">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="excerpt"><?php the_excerpt(); ?></div>
            <time><?php echo get_the_date('d.m.Y'); ?></time>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>