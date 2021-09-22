<?php echo $before_widget; ?>
<?php
$custom_title = esc_attr( $instance['custom_title'] );
$custom_summary = esc_attr( $instance['custom_summary'] );
?>
<div id="person_widget" class="container p-0 box">
	<?php if($custom_title!="") { ?><h2 class="box-title1"><?php echo $custom_title ?></h2><?php } ?>
	<?php if($custom_summary!="") { ?><p><?php echo $custom_summary ?></p><?php } ?>

<?php if ($btn_person):?>

	<article class="content <?php echo (isset($instance['image_size']) && $instance['image_size'] == 'big') ? 'big_image' : '' ?>">	
		<?php if (isset($instance['person_image']) && $instance['person_image'] != ''): ?>
			<figure>
				<img src="<?php echo $instance['person_image'] ?>" alt="<?php echo isset($instance['person_name']) ? $instance['person_name'] : '' ?>">
			</figure>
		<?php endif; ?>
		<div class="main-content">
			<?php echo isset($instance['person_name']) ? '<h3>'.$instance['person_name'].'</h3>' : '' ?>
			<?php echo isset($instance['person_role']) ? '<p>'.$instance['person_role'].'</p>' : '' ?>
			<?php if (isset($instance['person_email'])): ?>
				<a class="email" href="mailto:<?php echo $instance['person_email'] ?>">
					<span class="icn">
						<svg enable-background="new 0 0 510 510" version="1.1" viewBox="0 0 510 510" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
							<path d="M459,51H51C22.95,51,0,73.95,0,102v306c0,28.05,22.95,51,51,51h408c28.05,0,51-22.95,51-51V102    C510,73.95,487.05,51,459,51z M459,408h-51V183.6l-153,96.9l-153-96.9V408H51V102h30.6L255,209.1L428.4,102H459V408z"/>
						</svg>
					</span>
					<?php echo $instance['person_email'] ?></a>
				<?php endif ?>
			</div>
		</article>

	<?php elseif(isset($instance['post'])): ?>

<?php
$args = array(
  'p'         => $instance['post'], // ID of a page, post, or custom type
  'post_type' => 'person'
);
$my_posts = new WP_Query($args); ?>
	<article class="content <?php echo (isset($instance['image_size']) && $instance['image_size'] == 'big') ? 'big_image' : '' ?>">	
		<?php if (has_post_thumbnail($instance['post'])): ?>
			<figure>
				<a href="<?php echo get_the_permalink($instance['post']); ?>"><img src="<?php echo get_the_post_thumbnail_url($instance['post']); ?>" alt="<?php the_field('first_name', $instance['post']); ?> <?php the_field('last_name', $instance['post']); ?>"></a>
			</figure>
		<?php endif; ?>
		<div class="main-content">
			<?php if (null !== get_field('first_name', $instance['post']) && get_field('first_name', $instance['post']) != ''): ?>
				<h3><?php the_field('first_name', $instance['post']); ?> <?php the_field('last_name', $instance['post']); ?></h3>
			<?php endif; ?>

			<?php if ( null !== get_field('email', $instance['post']) && get_field('email', $instance['post']) != ''): ?>
				<a class="email" href="mailto:<?php the_field('email', $instance['post']) ?>">
					<span class="icn">
						<svg enable-background="new 0 0 510 510" version="1.1" viewBox="0 0 510 510" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
							<path d="M459,51H51C22.95,51,0,73.95,0,102v306c0,28.05,22.95,51,51,51h408c28.05,0,51-22.95,51-51V102    C510,73.95,487.05,51,459,51z M459,408h-51V183.6l-153,96.9l-153-96.9V408H51V102h30.6L255,209.1L428.4,102H459V408z"/>
						</svg>
					</span>
					<?php the_field('email', $instance['post']) ?></a>
			<?php endif; ?>
			</div>
		</article>

	<?php endif; ?>
</div>

	<?php echo $after_widget; ?>
