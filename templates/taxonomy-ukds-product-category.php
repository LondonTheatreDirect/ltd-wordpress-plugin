<?php
/**
 * The template for displaying archive pages.
 *
   Template Name:  Product Archive
 * @file           ukds-venues-archive-template.php
 * @package        ltd-tickets
 * @author         Ben Campbell
 * @copyright      2016 UK Design Services Ltd.
 */
get_header(); ?>

<div class="<?php do_action('ltd_tickets_container_class');  ?> hentry" id="ukds-container">
    <div class="ukds-row">
        <div class="ukds-col-lg-12"><?php do_action( 'ltd_tickets_breadcrumbs' ); ?>
        </div>
        <div class="ukds-col-lg-12"><?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        </div>
        <div class="ukds-col-md-9 ">
            <?php include( 'parts/ukds-archive-header.php' ); ?>
            <div class="ukds-row"><?php
                if ( have_posts() ) :
                    echo "<div id='ukds-product-grid'>";
                    $i=0;
                    while ( have_posts() ) : the_post();
					    include( 'parts/ukds-archive-item.php' );
					    $i++;
				    endwhile;
				    $args = array(
					    'prev_text'          => __('&nbsp;'),
					    'next_text'          => __('&nbsp;'),
					    'show_all'			 => true,
					    'type'				 => 'list'
				    );
                    echo "<div class='ukds-clearfix'></div></div>";
                    include( 'parts/ukds-archive-footer.php' );
			    else:
				    echo "<h2>Sorry, nothing found.</h2>";
			    endif;
			    wp_reset_query();
            ?>
            </div>
        </div>
        <div class="ukds-col-md-3"><?php get_sidebar();?>
        </div>
    </div>
</div>
<?php
get_footer();
