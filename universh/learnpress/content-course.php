<?php
/**
 * Template for displaying course content within the loop
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 wow fadeIn">

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <?php do_action( 'learn_press_before_courses_loop_item' ); ?>
        <div class="course-detail-wrap">
		<a href="<?php esc_url(the_permalink()); ?>"><?php do_action( 'learn_press_courses_loop_item_title' ); ?></a>	                
    
        <?php do_action( 'learn_press_after_courses_loop_item' ); ?>
        </div>
    
    </div>

</div>