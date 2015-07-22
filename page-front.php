<?php
  $image = portfolio_get_option( 'headshot' );
  $name = portfolio_get_option( 'my_name' );
  $title = portfolio_get_option( 'job_title' );
?>
<img src="<?php echo $image; ?>" />
<h1><?php echo $name; ?></h1>
<h2><?php echo $title; ?></h2>
