<?php
/**
 * Template for displaying archive course content
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php get_header(); ?>

<?php get_template_part( 'layout/before', '' ); ?> 

<?php do_action( 'learn_press_before_main_content' ); ?>

<?php do_action( 'learn_press_archive_description' ); ?>

<?php if ( have_posts() ) : ?>

	<div class="row">

	<?php do_action( 'learn_press_before_courses_loop' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php learn_press_get_template_part( 'content', 'course' ); ?>

	<?php endwhile; ?>

	<?php do_action( 'learn_press_after_courses_loop' ); ?>
    
    </div>

<?php endif; ?>

<?php do_action( 'learn_press_after_main_content' ); ?>

<?php get_template_part( 'layout/after', '' ); ?>

<?php get_footer(); ?>
