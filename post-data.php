<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post Data Template-Part File
 *
 * @file           post-data.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/post-data.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */
?>

<?php if( !is_page() && !is_search() ) { ?>

	<div class="post-data">
		<?php the_tags( __( 'Etiketter:', 'kryss' ) . ' ', ', ', '<br />' ); ?>
	  <?php
      $organizers = get_the_terms($post->id, 'kryss_organizer_tax');
      if ( !empty($organizers) ) {
        echo 'Arrangör: ';
        foreach( $organizers as $organizer) { 
          $term_link = get_term_link($organizer, 'kryss_organizer_tax');
          if( is_wp_error( $term_link ) )
            continue;
          echo '<a href = "' . $term_link . '">' . $organizer->name . '</a> ' ; 
        }
        echo '<br />'; 
      }
    ?>
		<?php 
		  if ( get_post_type( $post ) == 'post' )  {
		    printf( __( 'Kategori: %s', 'kryss' ), get_the_category_list( ', ' ) );
		  } 
		?>
	</div><!-- end of .post-data -->

<?php } ?>

<div class="post-edit"><?php edit_post_link( __( 'Edit', 'responsive' ) ); ?></div>
