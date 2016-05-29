<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    // Post thumbnail.
    twentyfifteen_post_thumbnail();
  ?>

  <header class="entry-header">
    <?php
      if ( is_single() ) :
        the_title( '<h1 class="entry-title">', '</h1>' );
      else :
        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
      endif;
    ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php
      /* translators: %s: Name of current post */
      the_content( sprintf(
        __( 'Continue reading %s', 'twentyfifteen' ),
        the_title( '<span class="screen-reader-text">', '</span>', false )
      ) );
    ?>


      <table>
        <thead>
          <tr>
            <th width="10%">Pos</th>
            <th>Runner</th>
            <th width="15%">Time</th>
          </tr>
        </thead>

    <?php

      // check if the repeater field has rows of data
      if( have_rows('results') ):
        while ( have_rows('results') ) : the_row(); ?>

          <tr>
            <td><?= the_sub_field('position');?></td>
            <td><? $posts = get_sub_field('runner');
              if( $posts ): ?>
                <?php foreach( $posts as $post): ?>
                  <?php setup_postdata($post); ?>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
              <?php endif; ?>
            </td>
            <td><?= the_sub_field('time'); ?> </td>
          </tr>
    <?php
        endwhile;
      endif;
    ?>
      </table>

  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php twentyfifteen_entry_meta(); ?>
    <?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
  </footer><!-- .entry-footer -->

</article><!-- #post-## -->
