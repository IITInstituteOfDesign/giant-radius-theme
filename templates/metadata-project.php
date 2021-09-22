
<div class="col-lg-4">
            <div class="main-data">
              <ul>


<div class="metadata">
  <?php if (get_field('completion_date')): ?>
    <div class="column">
      <strong>Completed</strong>
      <ul class="list-unstyled">
        <li>
          <a href="<?php the_date_permalink(); ?>">
            <?php the_seasonal_date( get_field('completion_date') ); ?>
          </a>
        </li>
      </ul>
    </div>
    <hr>
  <?php endif; ?>

  <?php foreach (get_public_taxonomies() as $taxonomy): ?>
    <?php $terms = get_the_terms( get_the_ID(), $taxonomy->name ); ?>
    <?php if ($terms): ?>
      <div class="column">
        <strong><?php echo $taxonomy->label; ?></strong>
        <?php echo get_the_term_list( get_the_ID(), $taxonomy->name, '<ul><li>', '</li><li>', '</li></ul>' ); ?>
      </div>
      <hr>
    <?php endif; ?>
  <?php endforeach; ?>
</div>


              </ul>
            </div>
          </div>
        </div>