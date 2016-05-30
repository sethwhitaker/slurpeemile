<?php
/**
 * The template used for displaying page content
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
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php the_content(); ?>



    <?php
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
              'key'   => 'results_%_time',
              'compare' => '!=',
              'value' => ''
            )
          )
        );
        $the_query = new WP_Query( $args );

        $alltime = []; $i=0;
         if( $the_query->have_posts() ){
          while ( $the_query->have_posts() ) {
            $the_query->the_post();
            if( have_rows('results', $post->ID) ) {
              while ( have_rows('results', $post->ID) ) {
                the_row();

                $alltime[$i]['year'] = get_field('year');
                $alltime[$i]['year_permalink'] = get_the_permalink();
                $alltime[$i]['position'] = get_row_index();
                // $alltime[$i]['position'] = get_sub_field('position');
                $alltime[$i]['time'] = get_sub_field('time');
                $alltime[$i]['time_ms'] = getMilliseconds(get_sub_field('time'));

                $runners = get_sub_field('runner');
                if( $runners ){
                  foreach( $runners as $runner){
                    setup_postdata($runner);
                    $alltime[$i]['runner'] = $runner->post_title;
                    $alltime[$i]['runner_permalink'] = get_the_permalink($runner->ID);
                  }
                }
                $i++;
              }
            }
          }
        }

        usort($alltime, function($a, $b) {
          return $a['time_ms'] - $b['time_ms'];
        });?>
        <? //echo "<pre>"; print_r($alltime); echo "</pre>"; ?>

        <table>
          <thead>
            <tr>
              <th width="15%">Rank</th>
              <th>Runner</th>
              <th width="15%">Year</th>
              <th width="10%">Pos</th>
              <th width="18%">Time</th>
            </tr>
          </thead>
          <tbody>
            <?php $rank = 1; ?>
            <?php foreach($alltime as $time): ?>
            <tr>
              <td><?= $rank; ?></td>
              <td><a href="<?= $time['runner_permalink'];?>"><?= $time['runner'];?></a></td>
              <td><a href="<?= $time['year_permalink'];?>"><?= $time['year'];?></a></td>
              <td><?= $time['position'];?></td>
              <td><?= $time['time'];?></td>
            </tr>
            <?php $rank++; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

  </div><!-- .entry-content -->

  <?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
