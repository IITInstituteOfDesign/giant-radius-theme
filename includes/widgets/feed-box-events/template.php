<?php echo $before_widget; ?>

<?php if (class_exists('Eventbrite_Query')): ?>
    <div class="box">
        <h2 class="box-title"><?php echo isset($instance['title']) && $instance['title'] != '' ? $instance['title'] : '' ?></h2>
        <?php
        if(isset($instance['limit'])) {
            $ets = intval($instance['limit']);
        } else {
            $ets = 5;
        }
        $featured_show = array();
    // Set up and call our Eventbrite query.
        $events = new Eventbrite_Query(
            apply_filters( 'eventbrite_query_args',
                array(
                'display_private' => true, // boolean
                'status' => 'live',         // string (only available for display_private true)
                // 'nopaging' => false,        // boolean
                 // 'limit' => $ets,            // integer
                // 'organizer_id' => null,     // integer
                'organizer_id' => 2741168798,
                // 'p' => null,                // integer
                // 'post__not_in' => null,     // array of integers
                // 'venue_id' => null,         // integer
                // 'category_id' => null,      // integer
                // 'subcategory_id' => null,   // integer
                // 'format_id' => null,        // integer
            )
            )
        );
        $i = 0;
        if ( $events->have_posts() ) :
            while ( $events->have_posts() ) : $events->the_post();
                if ($i == 0 && $instance['first_event'] == true):
                    $featured_show[] = get_the_title();
                    ?>
                    <a class="article-container incoming" href="<?php echo eb_event_url() ?>">
                        <article>
                            <?php if(isset($instance['img']) && $instance['img'] == 1 || isset($instance['img']) &&  $instance['img'] == 2): ?>
                            <div class="left">
                                <figure>
                                    <?php
                                    $api_request = eventbrite_get_event(get_the_ID(), true);
                                    $api_request_array = json_decode(json_encode($api_request),TRUE);
                                    $event_image = $api_request_array['events'][0]['logo_url'];
                                    ?>
                                    <img src="<?php echo $event_image ?>" alt="">
                                </figure>
                            </div>
                        <?php endif; ?>
                        <div class="right">
                            <?php if($instance['first_event'] == true){
                                echo '<h5>UPCOMING EVENT</h5>';
                            } ?>
                            <h3><?php the_title(); ?></h3>
                            <div class="date"><?php echo eventbrite_event_time();?></div>
                        </div>
                    </article>
                </a>
            <?php elseif(isset($instance['post'][0]) && in_array(get_the_title(), $instance['post'][0])):
            $featured_show[] = get_the_title();
            ?>
            <a class="article-container featured" href="<?php echo eb_event_url() ?>">
                <article>
                    <?php if(isset($instance['img']) && $instance['img'] == 1 || isset($instance['img']) &&  $instance['img'] == 2): ?>
                    <div class="left">
                        <figure>
                            <?php
                            $api_request = eventbrite_get_event(get_the_ID(), true);
                            $api_request_array = json_decode(json_encode($api_request),TRUE);
                            $event_image = $api_request_array['events'][0]['logo_url'];
                            ?>
                            <img src="<?php echo $event_image ?>" alt="">
                        </figure>
                    </div>
                <?php endif; ?>
                <div class="right">
                    <h3><?php the_title(); ?></h3>
                    <div class="date"><?php echo eventbrite_event_time();?></div>
                </div>
            </article>
        </a>
    <?php endif; ?>

    <?php
    $i++;
endwhile;
else:
    echo "<div class='empty-box'>Oops, seems we're having trouble with our events informaiton, please visit our <a style='color: #394e6d' target='_blank' href='https://www.eventbrite.com/o/iit-institute-of-design-2741168798'>Eventbrite Page</a></div>";
endif;
wp_reset_postdata();


// Not Featured
$events_normal = new Eventbrite_Query(
    apply_filters( 'eventbrite_query_args',
        array(
            'display_private' => true,
            'status' => 'live',
            'organizer_id' => 2741168798,
        )
    )
);
if ( $events_normal->have_posts() ) :
    $count = 0;
    while ( $events_normal->have_posts() && ($count >= $ets) != true) : $events_normal->the_post();
    if (in_array(get_the_title(), $featured_show) == false):
        ?>
        <a class="article-container" href="<?php echo eb_event_url() ?>">
         <article>
            <?php if(isset($instance['img']) &&  $instance['img'] == 1): ?>
                <div class="left">
                    <figure>
                        <?php
                        $api_request = eventbrite_get_event(get_the_ID(), true);
                        $api_request_array = json_decode(json_encode($api_request),TRUE);
                        $event_image = $api_request_array['events'][0]['logo_url'];
                        ?>
                        <img src="<?php echo $event_image ?>" alt="">
                    </figure>
                </div>
            <?php endif; ?>
            <div class="right">
             <h3><?php the_title(); ?></h3>
             <div class="date"><?php echo eventbrite_event_time();?></div>
         </div>
     </article>
 </a>
 <?php
 $count++;
endif;
endwhile;
endif;
wp_reset_postdata();
?>


<?php if ($instance['show_btn'] == true):?>
    <div class="bottom-btn">
        <a href='<?php if(isset($instance['btn_url'])){ echo $instance['btn_url']; } ?>' class='custom-btn'>
            <?php if(isset($instance['btn_text'])){
                echo $instance['btn_text'];
            } ?>
        </a>
    </div>
<?php endif ?>
</div>
<?php endif ?>

<?php echo $after_widget; ?>
