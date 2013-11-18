<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loop Header Template-Part File
 *
 * @file           loop-header.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/loop-header.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */

/**
 * Globalize Theme Options
 */
global $responsive_options;
$responsive_options = responsive_get_options();

/**
 * Display breadcrumb except on search page
 */
if( 0 == $responsive_options['breadcrumb'] && !is_search() ) :
	echo responsive_breadcrumb_lists();
endif;

/**
 * Display archive information
 */


if( is_category() || is_tag() || is_author() || is_date() ) {
	?>
	<div class="archive-post-header">
	<h6 class="title-archive">
		<?php
		if( is_day() ) :
			printf( __( 'Daily Archives: %s', 'responsive' ), '<span>' . get_the_date() . '</span>' );
		elseif( is_month() ) :
			printf( __( 'Monthly Archives: %s', 'responsive' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		elseif( is_year() ) :
			printf( __( 'Yearly Archives: %s', 'responsive' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		elseif( is_author() ):
			_e( 'Skribentarkiv', 'responsive' );
		else :
			_e( 'Arkiv', 'responsive' );
		endif;
		?>
	</h6>
		<?php
		if( is_author() ) : ?>
                       <h1><?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?> (<?php the_author_meta( 'display_name' ); ?>)</h1>
			

                        <div class="category_archive_description">
                           <?php the_author_meta( 'user_description' ); ?>
                        </div>
		<?php
		else : ?>

        <h1 class="category_archive_title"><?php single_cat_title(); ?></h1>
        	<div class="category_archive_description"><?php echo category_description(); ?></div>

		<?php
		endif;
		?>

</div> <!-- /archive-post-header -->


<?php
}

/**
 * Display Search information
 */

if( is_search() ) {
	?>
        <div class="search-post-header">
	  <h6 class="title-search-results"><?php printf( __( 'Search results for: %s', 'responsive' ), '<span>' . get_search_query() . '</span>' ); ?></h6>
        </div>
<?php
}