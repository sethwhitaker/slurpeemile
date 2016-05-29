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

     <?php
        $runner_id = get_the_ID();
        // filter
        function my_posts_where( $where ) {
          $where = str_replace("meta_key = 'results_%", "meta_key LIKE 'results_%", $where);
          return $where;
        }
        add_filter('posts_where', 'my_posts_where');
        $args = array(
          'numberposts' => -1,
          'post_type'   => 'results',
          'meta_query'  => array(
            'relation'    => 'AND',
            array(
              'key'   => 'results_%_runner',
              'compare' => 'LIKE',
              'value' => '"' . $runner_id . '"' // matches exaclty "123", not just 123. This prevents a match for "1234"
            )
          )
        );
        $the_query = new WP_Query( $args );
      ?>
      <table>
        <thead>
          <tr>
            <th>Year</th>
            <th>Position</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>
        <?php if( $the_query->have_posts() ): ?>
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php if( have_rows('results', $post->ID) ): ?>
              <?php while ( have_rows('results', $post->ID) ) : the_row(); ?>

                <?php $runners = get_sub_field('runner'); ?>
                <?php if( $runners ): ?>
                  <?php foreach( $runners as $runner): ?>
                    <?php setup_postdata($runner); ?>
                    <?php if($runner->ID == $runner_id): ?>
                    <tr>
                      <td><a href="<?php the_permalink(); ?>"><?php the_field('year'); ?></a></td>
                      <td><?php the_sub_field('position'); ?></td>
                      <td><?php the_sub_field('time'); ?></td>
                    </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
        </tbody>
      </table>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php twentyfifteen_entry_meta(); ?>
    <?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
  </footer><!-- .entry-footer -->

</article><!-- #post-## -->
