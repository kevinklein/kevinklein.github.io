<?php 

get_header();

the_post(); 

?>

 <div class="bg">

    <div class="container">

            <div class="single">

                  <?php the_content();?>

                  <?php 

                  edit_post_link(); 

                  comments_template('', false);?>

             </div>

    </div>

</div>

<?php get_footer();?>