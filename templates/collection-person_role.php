<?php if (empty(get_query_var('filters')) && is_tax('person_role', 'faculty')): ?>
  <?php $terms = array('full-time', 'adjunct', 'emeritus'); ?>
  <?php foreach ($terms as $term): ?>
    <?php
      global $wp_query;
      $args = filtered_query( array(
        'post_type' => 'person',
        'nopaging'  => true,
        'meta_key'  => 'last_name',
        'orderby'   => 'meta_value',
        'order'     => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'designation',
            'value' => $term
          )
        )
      ));

      $wp_query = new WP_Query($args);
    ?>

    <section class="collection-grid">

      <h2><?php 
	//	if($term == "distinguished-adjunct"){$term = "Distinguished Adjunct";}
		printf( '%s Faculty', ucwords($term)); 

	?></h2>



      <?php if (have_posts()): ?>		
			



        <div class="cards">
          
	<?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/card', get_query_var('post_type')); ?>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <h4><em>No matching results</em></h4>
      <?php endif; ?>
    </section>
  <?php endforeach; ?>
  <?php wp_reset_query(); ?>
<?php else: ?>
  <?php get_template_part('templates/collection'); ?>
<?php endif; ?>
