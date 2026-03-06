<?php get_header(); ?>

<div id="page-content">
    <div class="container single-page-container">
        <?php while (have_posts()):
            the_post(); ?>
            <article class="single-entry">

                <h1 class="section-title single-title">
                    <?php the_title(); ?>
                </h1>

                <div class="entry-image">
                    <?php if (has_post_thumbnail()):
                        the_post_thumbnail('full', ['class' => 'responsive-thumb']);
                    endif; ?>
                </div>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <div class="service-cta">
                    <h3>Заинтересовала услуга: <?php the_title(); ?>?
                    </h3>
                    <p>Оставьте свои контакты, и наш мастер свяжется с вами для уточнения деталей и времени.</p>
                    <a href="<?php echo home_url('/#contact-form'); ?>" class="btn-cta">
                        Оставить заявку
                    </a>
                </div>

                <a href="<?php echo home_url(); ?>" class="back-link">← Назад</a>

            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>