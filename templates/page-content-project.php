<?php if (is_singular('project')): ?>


<!--         </div>
      </div>
    </div>
  </header>
 -->

  <main class="project-container">
    <div class="program-single--container">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-12">
            <div class="box main-box">


  <section id="page-description">
    <div class="column">

      <?php $artifacts = the_project_artifacts();?>
      <?php
				$sections = array(
					'field_54c2ebceb6b18', // assignment
					'field_54c2ecabb6b19', // synopsis
					'field_54c2ecbab6b1a', // problem
					'field_54c2eccfb6b1b', // proposed_user_experience
					'field_54c2ecdfb6b1c', // sketch
					'field_54c2ecfdb6b1d', // prototype
					'field_54c2ed08b6b1e', // final_result
				);
			?>
      <?php $stages = array_slice($sections, 5);?>
      <?php foreach ($sections as $index => $section): ?>
        <?php $field_obj = get_field_object($section);?>
        <?php $filtered = filter_stage($artifacts, $field_obj['name']);?>
        <?php $ids = wp_list_pluck($filtered->posts, 'ID');?>
        <?php $show = !empty($field_obj['value']) || (!empty($ids) && get_field('artifact'));?>

        <?php if ($show): ?>
        	<h4><?php echo $field_obj['label'];?></h4>

         <!-- <?php $truncate = 12000;?>
          <?php if ($index !== 0): ?>
        	   <?php $truncate = first_sentence_offset($field_obj['value']);?>
          <?php endif;?>

        	<div class="truncate" data-truncate="<?php echo $truncate;?>">

		-->
		<div>
        		<?php echo $field_obj['value'];?>
        	</div>

          <?php if (get_field('artifact') && $filtered->have_posts()): ?>
            <?php $slides = idiit_get_featured_posts($ids);?>

          	<?php if ($slides->have_posts()): ?>
          	  <?php if ($slides->found_posts > 1): ?>
          	    <div  class="flexslider"><ul class="slides">
          	  <?php else: ?>
          	    <div id="featured">
          	  <?php endif;?>

          	  <?php while ($slides->have_posts()): $slides->the_post();?>
	          	    <?php if ($slides->found_posts > 1): ?>
	          	      <li>
	          	    <?php endif;?>

	          	    <?php get_template_part('templates/slide');?>

	          	    <?php if ($slides->found_posts > 1): ?>
	          	      </li>
	          	    <?php endif;?>
	          	  <?php endwhile;?>

          	  <?php if ($slides->found_posts > 1): ?>
          	   </ul></div>
          	  <?php else: ?>
          	    </div>
          	  <?php endif;?>
          	<?php endif;?>
          	<?php wp_reset_postdata();?>
          <?php endif;?>
        <?php endif;?>
      <?php endforeach;?>
    </div>
</div>
</div>
          <div class="col-lg-4 col-12">
            <aside>
      <?php get_sidebar(get_post_type());?>

  </aside>
          </div>
<?php else: ?>
  <?php get_template_part('templates/page-content');?>
<?php endif;?>