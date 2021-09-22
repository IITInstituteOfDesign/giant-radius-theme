
<?php

$post_type = get_query_var('post_type');
if ('any' === $post_type || empty($post_type)):
	$post_type = 'post';
endif;
$post_type = get_post_type_object( $post_type );
$post_type_name = $post_type->name;

$intro = get_field( "project_intro_text","option" );
$loopct = 1;
?>
<style>

    .archive_header {
        padding:25px 0 0 0;
    }

    .archive_main .archive_item {
        margin-bottom:0;
    }

    .projIntro a, .projTags a {
        font-weight: 700;
    }
    .projIntro a {
        color: #efab2b;
    }

    .projTags a {
        color: #333243;
    }

    .main-posts .projWrap{
        margin-bottom:1em;
    }

    .taglink {
        color: #333243;
    }

    .taglink:hover {
        color: #333243;
        text-decoration: none;
    }

    .projTags {
        margin:50px 0;
    }

    .projTags ul {
        list-style: none;
        padding-left: 0;
    }

    .projTags li {
        display: inline;
        margin-right:1em;
    }

    .projTags li a {
        font-size: 18px;
        text-decoration: none;
    }

    .projTags li a:hover {
        text-decoration: none;
    }

    .projTags li a:after {
        content: '|';
        padding-left:8px;
    }

    .projTags li:last-of-type a::after {
        content: '';
    }

    .projTitle {
        color: #333243;
    }

    .projTitle:hover {
        text-decoration: none;
        color: inherit;
    }

    .archive_main .firstProj img {
        max-width: 100%;
        width: 100%;
        height: auto;
    }

    .firstProj {
        margin-bottom:2em;
    }

</style>
<header class="archive_header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="archive_header__title"><?php get_template_part('templates/page-header-text', $post_type->name); ?></h1>
			</div>
		</div>
	</div>
</header>

<main class="archive_main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="projIntro">
                    <?php echo $intro;  ?>
                </div>
                <div class="projTags">
                    <ul>
                        <?php
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $custom_post_tags = get_terms([
                                'taxonomy' => 'project_type',
                                'hide_empty' => false,
                            ]);
                            if ( $custom_post_tags ) {
                                foreach( $custom_post_tags as $tag ) {
                                    $tags_arr[] = $tag -> name;
                                }
                            }
                        endwhile; endif;
                        if( $tags_arr ) {
                            $uniq_tags_arr = array_unique( $tags_arr );
                            foreach( $uniq_tags_arr as $tag ) {
                                // LIST ALL THE TAGS FOR DESIRED POST TYPE
                                $sanitizeTag =  sanitize_title($tag);
                                $tag_link = get_term_by('name', $tag, 'project_type');
                                echo '<li><a href="'. get_tag_link($tag_link->term_id).'">' .$tag. '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

	    <?php if (have_posts()): ?>
	        <?php while (have_posts()) : the_post(); ?>
	            <?php if ($loopct == 1){ ?>

                    <div class="row firstProj">
                        <div class="col-md-6 col-sm-12">
                            <a href="<?php the_permalink(); ?>">
                                <figure><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'card') ?>" alt=""></figure>
                            </a>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <a href="<?php the_permalink(); ?>" class="projTitle">
                                <h3><?php the_title(); ?></h3>
                            </a>

                            <?php the_excerpt(); ?>

                            <?php
                            $tags = get_the_terms(get_the_ID(),'project_type');
                            $output = '';
                            $separator = ' | ';
                            if ($tags) {
                                foreach ($tags as $tag) {
                                    $output .= '<a class="taglink" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
                                }
                                echo trim($output, $separator);
                            }
                            ?>

                        </div>
                    </div>
	            <?php } else { ?>
                    <?php if ($loopct == 2) { ?>
                        <div class="row listProj main-posts"> <!--- start main-posts --->
		            <?php } ?>
                            <div class="col-xl-3 col-lg-4 col-sm-6 projWrap">
                                <a href="<?php the_permalink(); ?>" class="archive_item">
                                    <figure><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'card') ?>" alt=""></figure>
                                    <h3><?php the_title(); ?></h3>
                                    <?php
                                    $tags = get_the_terms(get_the_ID(),'project_type');
                                    $output = '';
                                    $separator = ' | ';
                                    if ($tags) {
                                        foreach ($tags as $tag) {
                                            $output .= '<a class="taglink" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
                                        }
                                        echo trim($output, $separator);
                                    }
                                    ?>
                                </a>
                            </div>
                <?php }
		    $loopct++;
		    endwhile; ?>
                        </div> <!--- end main-posts --->
        <?php else : ?>
            <h4><em>No matching results</em></h4>
        <?php endif; ?>

        <?php if (!empty(paginate_links())):?>

        </div>

		<div class="row">
			<div class="col-12 text-center">
				<div class="misha_loadmore custom-btn">LOAD MORE</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</main>



