<?php 

get_header();

the_post(); 

?>

 <div class="bg" style="text-align: left">
    <div class="container">

        <h1 style="margin-bottom: 15px"><strong><?php the_title(); ?></strong></h1>

        <p>
            <?php the_time("d M Y");?> 
            <?php //the_category(', ') ?> 
            <?php //comments_popup_link(esc_html__('0 comments','Tharsis'), esc_html__('1 comment','Tharsis'), '% '.esc_html__('comments','Tharsis')); ?>
        </p>

        <?php the_content();?>
        
        <?php edit_post_link(); ?>

    </div>
</div>

<?php get_footer();?>