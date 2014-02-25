<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 24 hrs rally sidebar
 *
 *
 * @file           sidebar-24.php
 * @package        kryss
 * @author         Stefan Pettersson
 * @copyright      2014 Lumano
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/kryss/sidebar-24.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 0.2.2
 */

/*
 * If this is a full-width page, exit
 */
if( 'full-width-page' == responsive_get_layout() ) {
	return;
}
?>

<?php responsive_widgets_before(); // above widgets container hook ?>

    
	<div id="widgets" class="<?php echo implode( ' ', responsive_get_sidebar_classes() ); ?>">
	  
	  <?php responsive_widgets(); // above widgets hook ?>
	  
	
		<?php if ( dynamic_sidebar('kryss_top_right') ) : ?>
		<? endif; ?>




  <?php if( is_page() ) : ?>

    <?php
    if ($post->post_parent)	{
    	$ancestors=get_post_ancestors($post->ID);
    	$root=count($ancestors)-1;
    	$parent = $ancestors[$root];
    } else {
    	$parent = $post->ID;
    }
    ?>

      <!-- Our sub menu, here is. -->
			<div class="widget-wrapper">
			  				<div class="widget-title"><h3><? echo get_the_title($parent);  ?></h3></div>
        <?php
        
        if ($post->post_parent)	{
        	$ancestors=get_post_ancestors($post->ID);
        	$root=count($ancestors)-1;
        	$parent = $ancestors[$root];
        } else {
        	$parent = $post->ID;
        }
        
        $children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");
        
        if ($children) { ?>
        <ul id="subnav">
        <?php echo $children; ?>
        </ul>
        <?php } ?>
			</div><!-- end of .widget-wrapper -->

	<?php endif; //end of is_page ?>

  
	  <?php
	    if ( is_single() or is_page() ){
        $organizers = get_the_terms($post->id, 'kryss_organizer_tax');
        if ( !empty($organizers) ) {
          foreach( $organizers as $organizer) { 
           	echo '<div class="widget-wrapper">';
  		      echo '<div class="widget-title"><h3>Seglingar i ' .  $organizer->name . '</h3></div>';
  		      echo '<ul>';
            $args = array(
            	'post_type' => 'kryss_race',
              'kryss_organizer_tax' => $organizer->slug,
              'posts_per_page' => 5
            );
            $the_query = new WP_Query( $args ); 
            if ( $the_query->have_posts() ) {
              while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <li><a href=" <?php the_permalink(); ?> "><?php the_title(); ?></a></li> 
              <?php
              endwhile;  
              wp_reset_postdata();
            }
            ?>
            </ul>
            <a href ="<?php echo get_post_type_archive_link('kryss_race') . '?kryss_organizer_tax=' . $organizer->slug; ?>">Alla i <?php echo $organizer->name; ?> ...</a>
            </div>
            <?php
          }
        }
      }
    else   {
     	echo '<div class="widget-wrapper">';
      echo '<div class="widget-title"><h3>Seglingar </h3></div>';
      echo '<ul>';
      $args = array(
      	'post_type' => 'kryss_race',
        'posts_per_page' => 10
      );
      $the_query = new WP_Query( $args ); 
      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <li><a href=" <?php the_permalink(); ?> "><?php the_title(); ?></a></li> 
        <?php
        endwhile;  
        wp_reset_postdata();
      }
      ?>
      </ul>
      <a href ="<?php echo get_post_type_archive_link('kryss_race') ?>">Alla seglingar ...</a>
      </div>
      <?php
    }
?>

	  <?php
	    if ( is_single() or is_page() ){
        $organizers = get_the_terms($post->id, 'kryss_organizer_tax');
        if ( !empty($organizers) ) {
          foreach( $organizers as $organizer) { 
           	echo '<div class="widget-wrapper">';
  		      echo '<div class="widget-title"><h3>Resultat från ' .  $organizer->name . '</h3></div>';
  		      echo '<ul>';
            $args = array(
            	'post_type' => 'kryss_result',
              'kryss_organizer_tax' => $organizer->slug,
              'posts_per_page' => 5
            );
            $the_query = new WP_Query( $args ); 
            if ( $the_query->have_posts() ) {
              while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <li><a href=" <?php the_permalink(); ?> "><?php the_title(); ?></a></li> 
              <?php
              endwhile;  
              wp_reset_postdata();
            }
            ?>
            </ul>
            <a href ="<?php echo get_post_type_archive_link('kryss_result') . '?kryss_organizer_tax=' . $organizer->slug; ?>">Alla i <?php echo $organizer->name; ?> ...</a>
            </div>
            <?php
          }
        }
      }
?>


	  <?php
	    if ( is_single() or is_page() ){
        $organizers = get_the_terms($post->id, 'kryss_organizer_tax');
        if ( !empty($organizers) ) {
          foreach( $organizers as $organizer) { 
           	echo '<div class="widget-wrapper">';
  		      echo '<div class="widget-title"><h3>Artiklar från ' .  $organizer->name . '</h3></div>';
  		      echo '<ul>';
            $args = array(
            	'post_type' => 'post',
              'kryss_organizer_tax' => $organizer->slug,
              'posts_per_page' => 5
            );
            $the_query = new WP_Query( $args ); 
            if ( $the_query->have_posts() ) {
              while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <li><a href=" <?php the_permalink(); ?> "><?php the_title(); ?></a></li> 
              <?php
              endwhile;  
              wp_reset_postdata();
            }
            ?>
            </ul>
            
            <?php $term_link = get_term_link($organizer, 'kryss_organizer_tax');
            if( is_wp_error( $term_link ) )
              continue; ?>
            <a href ="<?php echo $term_link . '?post_type=post' ?>">Alla från <?php echo $organizer->name; ?> ...</a>
            
            </div>
            <?php
          }
        }
      }
?>

<?php if( !dynamic_sidebar( 'main-sidebar')): ?>
<? endif; ?>


		<?php responsive_widgets_end(); // after widgets hook ?>
	</div><!-- end of #widgets -->
<?php responsive_widgets_after(); // after widgets container hook ?>