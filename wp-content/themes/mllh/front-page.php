<?php get_header(); ?>

<div class="home_posts_list">
    <?php query_posts('posts_per_page=3'); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="home_posts_item">
                <!-- <?php the_post_thumbnail() ?> -->
                <div class="home_posts_item_content">
                    <div class="home_posts_item_date">
                        <?php the_date();
                        ?>
                    </div>
                    <hr />
                    <div>
                        <h1><?php the_title(); ?></h1>
                        <?php
                        the_excerpt();
                        ?>
                    </div>
                </div>
                <a href=<?php the_permalink(); ?>>Lire l'article</a>
            </article>

    <?php endwhile;
    endif; ?>
</div>

<?php get_footer(); ?>