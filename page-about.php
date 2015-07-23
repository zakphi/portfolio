<?php
  $args = array( 'pagename' => 'about' );
  $loop = new WP_Query( $args );
?>
<?php while ( $loop->have_posts() ) : $loop->the_post();?>
    <?php $url = get_post_meta(get_the_ID(), "work_resume", true);?>
    <a href="<?php echo $url; ?>">Click here for a printable version of resume</a>
<?php endwhile;?>
