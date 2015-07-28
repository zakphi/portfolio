<?php
  $args = array( 'post_type' => 'work', 'orderby' => 'menu_order', 'order' => 'ASC');
  $loop = new WP_Query( $args );
?>
<ul class="portfolio">
  <?php while ( $loop->have_posts() ) : $loop->the_post();?>
    <li>
      <?php $url = get_post_meta(get_the_ID(), "work_url", true);?>
      <a href="<?php echo $url; ?>"><?php the_post_thumbnail($post->ID, 'medium'); ?></a>
    </li>
  <?php endwhile;?>
</ul>
