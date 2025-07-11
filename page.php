<?php get_header() ?>

<div class="site-content site-content--default md-padding-top md-padding-bottom">
    <?php while (have_posts()) { ?>
        <div class="title-description py-5">
            <div class="container">
                <h1 class="fs-35 mp-"><?php the_title() ?></h1>
            </div>
        </div>
        <div class="site-content--inner background-white rounded overflow-hidden has-lightgray-2-background-color">
            <div class="container">
                <?php the_post() ?>
                <?php the_content() ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php get_footer() ?>