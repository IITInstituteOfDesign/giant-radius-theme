<div class="col-md-4">
  <div class="dropdown" id="share-button">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
      <span class="glyphicon glyphicon-share-alt"></span>
      Share
    </button>
    <ul class="services">
      <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" rel="nofollow" target="_blank"><span class="fa fa-facebook-square"></span></a></li>
      <li><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php bloginfo('name'); ?>:%20<?php the_title(); ?>" rel="nofollow" target="_blank"><span class="fa fa-twitter-square"></span></a></li>
      <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php echo get_the_excerpt(); ?>" rel="nofollow" target="_blank"><span class="fa fa-linkedin-square"></span></a></li>
      <li><a href="mailto:?subject=<?php bloginfo('name'); ?>:%20<?php the_title(); ?>&amp;body=<?php echo get_the_excerpt(); ?>%0A%0A<?php the_permalink(); ?>"><span class="fa fa-envelope-square"></span></a></li>
    </ul>
  </div>
</div>
