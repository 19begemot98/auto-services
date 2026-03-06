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
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/Articles.jpg">';
                            endif; ?>
                        </a>
                        <div class="article-body">
                            <h3>
                                <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p>
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            <time class="post-date">26.11.2023</time>
                        </div>
                    </article>
                <?php endwhile; endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<section class="section-services">
    <div class="container">
        <h2 class="section-title">Услуги</h2>
        <div class="services-grid">
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

            if ($services->have_posts()):
                while ($services->have_posts()):
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
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/Services.jpg">';
                            endif; ?>
                        </a>

                        <div class="service-info">
                            <h3>
                                <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="service-price">от
                                <?php echo $current_price; ?> ₽
                            </p>
                        </div>
                    </div>
                    <?php $counter++; endwhile; endif;
            wp_reset_postdata(); ?>
        </div>

        <div class="mobile-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</section>

<section id="contact-form" style="padding: 100px 0; background: #f9f9f9;">
    <div class="container">
        <h2 class="section-title">Связаться с нами</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <p style="color: green; font-weight: bold; margin-bottom: 20px;">Ваше сообщение успешно отправлено и сохранено в
                базе!</p>
        <?php endif; ?>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post"
            style="max-width: 500px; display: flex; flex-direction: column; gap: 15px;">
            <input type="hidden" name="action" value="contact_form">
            <input type="text" name="user_name" placeholder="Ваше имя" required
                style="padding: 12px; border: 1px solid #ddd; border-radius: 4px;">
            <input type="email" name="user_email" placeholder="Ваш Email" required
                style="padding: 12px; border: 1px solid #ddd; border-radius: 4px;">
            <textarea name="user_message" placeholder="Текст сообщения" required
                style="padding: 12px; border: 1px solid #ddd; border-radius: 4px; height: 100px;"></textarea>
            <button type="submit" name="contact_submit"
                style="background: #a1a1a1; color: #fff; padding: 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">ОТПРАВИТЬ
                ЗАЯВКУ</button>
        </form>
    </div>
</section>

<?php get_footer(); ?>