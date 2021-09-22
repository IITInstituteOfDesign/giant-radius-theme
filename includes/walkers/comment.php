<?php

require_once get_template_directory() . '/vendor/carbon/Carbon.php';
use Carbon\Carbon;

class IDIIT_Comment extends Walker_Comment {
  protected function html5_comment( $comment, $depth, $args ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
      <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      <footer class="comment-meta">
        <div class="comment-author vcard">
          <?php printf('<strong class="fn">%s</strong>', get_comment_author_link()); ?>
        </div><!-- .comment-author -->

        <div class="comment-metadata">
          <time datetime="<?php comment_time( 'c' ); ?>">
            <?php $comment_time = new Carbon(get_comment_time( 'c' )); ?>
            <?php $diff = Carbon::now()->diffInSeconds($comment_time); ?>
            <?php echo Carbon::now()->subSeconds($diff)->diffForHumans(); ?>
          </time>
        </div><!-- .comment-metadata -->

        <?php if ( '0' == $comment->comment_approved ) : ?>
          <p class="comment-awaiting-moderation">
            <?php _e( 'Your comment is awaiting moderation.', 'idiit-theme' ); ?>
          </p>
        <?php endif; ?>
      </footer><!-- .comment-meta -->

      <div class="comment-content">
        <?php comment_text(); ?>
      </div><!-- .comment-content -->

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        <?php edit_comment_link( __( 'Edit', 'idiit-theme' ), '<span class="edit-link">', '</span>' ); ?>
      </div><!-- .reply -->
    </article><!-- .comment-body -->
<?php
        }
}
