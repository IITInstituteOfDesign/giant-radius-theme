<?php echo $before_widget; ?>
<?php if (isset($instance['custom_title'])): ?>
    <h4 class="custom-title"><?php echo $instance['custom_title']; ?></h4>
<?php endif; ?>
<?php if (isset($instance['custom_summary'])): ?>
    <p><?php echo $instance['custom_summary']; ?></p>
<?php endif; ?>

<div class="container">
    <div class="row">
            <form id="studentFilter" class="form-inline col-sm-12 my-4 ml-0" action="<?php echo $currentUrl; ?>" method="post">
                <div class="form-group col-md-4">
                    <label for="gradYear">Graduation Year</label>

                    <select class="form-control w-100" name="gradYear" id="gradYear">
                        <option value=""></option>
                        <?php foreach($yearSelect['choices'] as $choice) { ?>
                            <option value="<?php echo $choice; ?>"
                                <?php if(isset($_POST['gradYear']) && $_POST['gradYear'] == $choice) { ?>
                                    selected="selected"
                                <?php } ?>
                            >
                                <?php echo $choice; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="dType">Degree Type</label>
                    <select class="form-control w-100" name="dType" id="dType">
                        <option value=""></option>
	                    <?php foreach($degreeSelect['choices'] as $choice) { ?>
                            <option value="<?php echo $choice; ?>"
			                    <?php if(isset($_POST['dType']) && $_POST['dType'] == $choice) { ?>
                                    selected="selected"
			                    <?php } ?>
                            >
			                    <?php echo $choice; ?>
                            </option>
	                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="submit">&nbsp;</label>
                    <button type="submit" class="custom-btn" name="studentFilter">Filter</button>
                </div>
                <?php if (isset($_POST['gradYear']) || isset($_POST['dType'])) { ?>
                    <a href="<?php echo is_ssl() ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="mt-3 ml-3">clear filters</a>
                <?php } ?>
            </form>
        </div>

        <div class="row">
	        <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ):
                    $query->the_post(); ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <?php echo get_template_part('templates/card-student'); ?>
                    </div>
                <?php endwhile; ?>
	        <?php else: ?>
                <div class="col-sm-12">
                    <h4>No Student Results</h4>
                </div>
            <?php endif; ?>
        </div>



    <?php if ($query->max_num_pages > 1 ):?>
        <div class="row">
            <div class="col-sm-12 text-center mt-4">
                <?php wp_pagenavi(['query'=>$query]); ?>
            </div>
        </div>
    <?php endif; ?>
	<?php //wp_reset_postdata(); ?>
</div>
<?php echo $after_widget; ?>
