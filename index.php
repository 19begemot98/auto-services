<?php get_header(); ?>

<section class="section-articles">
    <div class="container">
        <h2 class="section-title">Статьи</h2>
        <div class="articles-grid">
            <?php
            $articles = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3]);
            if ($articles->have_posts()):
                while ($articles->have_posts()):
                    $articles->the_post(); ?>
                    <article class="article-card">
                        <a href="<?php the_permalink(); ?>" class="article-img">
                            <?php if (has_post_thumbnail()):
                                the_post_thumbnail('large');
                            else:
                                echo '<img src="https://placehold.co/600x400?text=No+Image" alt="Нет фото">';
                            endif; ?>
                        </a>
                        <div class="article-body">
                            <h3>
                                <a href="<?php the_permalink(); ?>" class="card-link">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p>
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            <time class="post-date">
                                <?php echo get_the_date('d.m.Y'); ?>
                            </time>
                        </div>
                    </article>
                <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<section class="section-services">
    <div class="container">
        <h2 class="section-title">Услуги</h2>

        <?php
        $services = new WP_Query(['post_type' => 'services', 'posts_per_page' => 4]);
        $counter = 0;
        $badges = [
            0 => ['Товар месяца'],
            1 => ['Скидка', 'Акция'],
            2 => ['Новинка'],
            3 => ['Товар месяца']
        ];
        $prices = ['200', '800', '400', '200'];

        if ($services->have_posts()): ?>
            <div class="services-grid js-services-slider">
                <?php while ($services->have_posts()):
                    $services->the_post();
                    $current_badges = $badges[$counter] ?? [];
                    $current_price = $prices[$counter] ?? '200';
                    ?>
                    <div class="service-card">
                        <div class="badge-container">
                            <?php foreach ($current_badges as $b): ?>
                                <span class="badge">
                                    <?php echo $b; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="service-img">
                            <?php if (has_post_thumbnail()):
                                the_post_thumbnail('medium');
                            else:
                                echo '<img src="https://placehold.co/600x400?text=No+Image" alt="Нет фото">';
                            endif; ?>
                        </a>

                        <div class="service-info">
                            <h3>
                                <a href="<?php the_permalink(); ?>" class="card-link">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="service-price">от
                                <?php echo $current_price; ?> ₽
                            </p>
                        </div>
                    </div>
                    <?php $counter++; endwhile; ?>
            </div>

            <div class="mobile-dots">
                <?php for ($i = 0; $i < $services->post_count; $i++): ?>
                    <span class="dot <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></span>
                <?php endfor; ?>
            </div>

        <?php
        endif;
        wp_reset_postdata(); ?>
    </div>
</section>

<section id="contact-form" class="section-contact">
    <div class="container">
        <h2 class="section-title">Связаться с нами</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <p class="success-message">Ваше сообщение успешно отправлено и сохранено</p>
        <?php endif; ?>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="form-grid-layout">
            <input type="hidden" name="action" value="contact_form">
            <input type="text" name="user_name" placeholder="Ваше имя" required class="input-field">
            <input type="email" name="user_email" placeholder="Ваш Email" required class="input-field">
            <textarea name="user_message" placeholder="Текст сообщения" required class="textarea-field"></textarea>
            <button type="submit" name="contact_submit" class="submit-button">ОТПРАВИТЬ ЗАЯВКУ</button>
        </form>
    </div>
</section>

<?php get_footer(); ?>