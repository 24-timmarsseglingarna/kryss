<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Widget Template
 *
 *
 * @file           sidebar.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */

/*
 * Load the correct sidebar according to the page layout
 */
$layout = responsive_get_layout();
switch ( $layout ) {
	case 'sidebar-content-page':
		get_sidebar( 'left' );
		return;
		break;

	case 'content-sidebar-half-page':
		get_sidebar( 'right-half' );
		return;
		break;

	case 'sidebar-content-half-page':
		get_sidebar( 'left-half' );
		return;
		break;

	case 'full-width-page':
		return;
		break;
}
?>

<?php responsive_widgets_before(); // above widgets container hook ?>
	<div id="widgets" class="<?php echo implode( ' ', responsive_get_sidebar_classes() ); ?>">

		<?php if ( !dynamic_sidebar( 'kryss_top_right' ) ) : ?>
		<?php endif; //end of kryss-top-sidebar ?>

		<?php if( is_page() ) : ?> <!-- If page then sidebar menu -->
			<div class="widget-wrapper">
				<div class="widget-title">
				  <h3>
				    <span>
				      <?php
			          $parent_title = get_the_title($post->post_parent);
			          echo $parent_title;
		            ?>  
	          </span>              
	        </h3>
	      </div> <!-- /.widget-title -->
	      
    		<nav class="kryss-menu">
    		  <ol>
    		    <?php if($post->post_parent) {
    		      echo '<li class="page_item current_page_ancestor"><a href="'.get_page_link($post->post_parent).'">'.get_the_title($post->post_parent).'</a></li>';
    		      }
    		    else {
      		    echo '<li class="page_item current_page_item"><a href="'.get_page_link($post).'">'.get_the_title($post).'</a></li>';
      		    }
    		    ?> 
    			<?php
    			if($post->post_parent){
    				$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
    			} else {
    				$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
    			}
    			if ($children) { ?>
    				<ol>
    					<?php echo $children; ?>
    				</ol>
    			<?php } ?>	
    			</ol> 	    				
    		</nav> 
  		</div> <!-- /.widget-wrapper -->
		<?php endif ?> <!-- is_page? -->
		

  		
	  <?php
	     $organizers = get_the_terms($post->id, 'kryss_organizer_tax');
        if ( !empty($organizers) && !is_front_page() ) {
    
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
            <a class="more_in_list" href ="<?php echo get_post_type_archive_link('kryss_race') . '?kryss_organizer_tax=' . $organizer->slug; ?>">Alla i <?php echo $organizer->name; ?> ...</a>
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
    }
    else
?>
  		
  		
		<?php if ( !dynamic_sidebar( 'main-sidebar' ) ) : ?>
		<?php endif; //end of main-sidebar ?>
		<?php responsive_widgets_end(); // after widgets hook ?>
	</div><!-- end of #widgets -->
<?php responsive_widgets_after(); // after widgets container hook ?>