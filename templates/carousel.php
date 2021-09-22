<?php $post_id = get_queried_object(); ?>
<?php if (is_post_type_archive() || is_home()): ?>
	<?php $post_id = $post_id->name; ?>
<?php elseif (is_tax()): ?>
	<?php $post_id = "{$post_id->taxonomy}_{$post_id->term_id}"; ?>
<?php else: ?>
	<?php $post_id = $post_id->ID; ?>
<?php endif; ?>

<?php if (is_post_type_archive() || is_home()): ?>
	<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>
	<?php $ids = get_option( sprintf('idiit_%s_featured', $post_type->name) ); ?>
<?php elseif (is_tax()): ?>
	<?php $term = get_term_by('slug', get_query_var('term'), $taxonomy); ?>
	<?php $term_meta = get_option( "taxonomy_term_$term->term_id" ); ?>
	<?php $ids = isset($term_meta['featured']) ? $term_meta['featured'] : array(); ?>
<?php endif; ?>

<?php if (!empty($ids)): ?>
	<?php $slides = idiit_get_featured_posts($ids); ?>

	<?php if ($slides->have_posts()): ?>
	  <?php if ($slides->found_posts > 1): ?>
	  	
	    <div  class="flexslider"><ul class="slides">
	  <?php else: ?>
	    <div id="featured">
	  <?php endif; ?>

	  <?php while($slides->have_posts()): $slides->the_post(); ?>
	    <?php if ($slides->found_posts > 1): ?>
	      <li>
	    <?php endif; ?>

	    <?php get_template_part('templates/slide', get_post_type()); ?>

	    <?php if ($slides->found_posts > 1): ?>
	      </li>
	    <?php endif; ?>
	  <?php endwhile; ?>

	  <?php if ($slides->found_posts > 1): ?>
	    </ul></div>
	  <?php else: ?>
	    </div>
	  <?php endif; ?>
	<?php endif; ?>
<?php elseif (have_rows('slides', $post_id)): ?>
	<?php if (count(get_field('slides', $post_id)) > 1): ?>
		<div  class="flexslider">
			<ul class="slides">
				<?php while ( have_rows('slides', $post_id) ) : the_row(); ?>
					<li><?php get_template_part('templates/slide', get_post_type()); ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php else: ?>
		<?php while ( have_rows('slides', $post_id) ) : the_row(); ?>
	    <div id="featured"><?php get_template_part('templates/slide', get_post_type()); ?></div>
		<?php endwhile; ?>
	<?php endif; ?>
<?php elseif (is_single() || is_page()): ?>
	<?php if(get_field('image') || has_post_thumbnail( $post_id )): ?>
		<!-- <div class="main-img"> -->
			<?php get_template_part('templates/slide', get_post_type()); ?>
		<!-- </div> -->
	<!-- </div> -->
	<!-- if is page -->
      <?php // get_template_part('templates/metadata', get_post_type());?>
<!-- 
				</div>
			</div>
		</div>
	</header> -->
	<?php endif; ?>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
