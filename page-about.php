<?php
  $args = array( 'pagename' => 'about' );
  $loop = new WP_Query( $args );
?>
<?php while ( $loop->have_posts() ) : $loop->the_post();?>
    <?php
      $resume_url = get_post_meta(get_the_ID(), "work_resume", true);
      $linkedin_url = get_post_meta(get_the_ID(), "work_linkedin_url", true);
      $github_url = get_post_meta(get_the_ID(), "work_github_url", true);
    ?>
    <span class="resume_link"><a href="<?php echo $resume_url; ?>">Click here for a printable version of resume.</a></span>
    <div class="social_media">
      <a href="<?php echo $linkedin_url; ?>"><i class="fa fa-linkedin"></i></a>
      <a href="<?php echo $github_url; ?>"><i class="fa fa-github"></i></a>
    </div>
<?php endwhile;?>
