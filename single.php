<?php get_header(); ?>

<div id="page-content">
    <div class="container" style="padding-top: 150px; padding-bottom: 150px;">
        <?php while (have_posts()):
            the_post(); ?>
            <article class="single-entry">
                <h1 class="section-title" style="margin-left: 0;">
                    <?php the_title(); ?>
                </h1>

                <div class="entry-image" style="margin-bottom: 30px;">
                    <?php if (has_post_thumbnail()):
                        the_post_thumbnail('full', ['style' => 'width:100%; height:auto; border-radius:10px;']); endif; ?>
                </div>

                <div class="entry-content" style="font-size: 18px; line-height: 1.6;">
                    <?php the_content(); ?>
                </div>

                <a href="<?php echo home_url(); ?>" style="margin-top: 50px; display: inline-block; color: #a1a1a1;">←
                    Назад</a>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>