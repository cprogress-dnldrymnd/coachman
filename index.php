<?php get_header() ?>

<section class="archive-courses archive-grid background-light-gray py-5">
    <div class="container large-container">
        <?php if (have_posts()) { ?>
            <div class="row">
                <?php while (have_posts()) { ?>
                    <?php the_post() ?>
                    <div class="col-md-4 col-6">
                        <?= do_shortcode('[template id=25081]') ?>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="heading-box">
                <h2>
                    No results found.
                </h2>
            </div>
        <?php } ?>
    </div>
</section>

<?php get_footer() ?>