<?php
add_action('learn_press_before_content_landing', 'universh_learn_press_before_content_thumbnail', 10);
function universh_learn_press_before_content_thumbnail(){
	?>
    <div class="col-sm-7">
	<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>
    </div>
    <?php
}

add_action('learn_press_before_content_landing', 'universh_learn_press_before_content_meta', 25);
function universh_learn_press_before_content_meta(){
	$course = LP()->global['course'];
	?>
    <div class="col-sm-5">
    <div class="course-detail">
        <!-- Course Content -->
        <div class="course-meta">
        	<?php $course_terms = get_the_terms( get_the_ID(), 'course_category' ); ?>
            <?php if ( ! empty( $course_terms ) && ! is_wp_error( $course_terms ) ): ?>
            <?php $i = 0; ?>
            <?php foreach ( $course_terms as $term ): ?>
            <?php if($i == 0){
				$class = 'bg-yellow';
			} elseif($i == 1){
				$class = 'bg-pink';
			} elseif($i == 2) {
				$class = 'bg-green';
			} ?>            
            <span class="cat <?php echo esc_attr($class); ?>"><?php echo esc_html($term->name); ?></span>
            <?php $i++;
			if($i == 3){
				$i = 0;
			} ?>
            <?php endforeach; ?>
            <?php endif; ?>
            <h4 class="course-title-new"><?php the_title(); ?></h4>
            <ul class="course-meta-icons">            	
                <li><i class="fa fa-dollar"></i><span><?php echo esc_html__('Price', 'universh'); ?></span><h5>
                <?php if ( $price_html = $course->get_price_html() ) : ?>
                    <?php echo wp_kses($price_html, array('span'=>array('class'=>array()))); ?>                    
                <?php else: ?>
                <?php echo esc_html__('Free', 'universh'); ?>
                <?php endif; ?>
                </h5></li>
                <li><i class="fa fa-users"></i><span><?php echo esc_html__('Students', 'universh'); ?></span><h5><?php echo esc_html($course->get_students_html()); ?></h5></li>
                <li><i class="fa fa-comments"></i><span><?php echo esc_html__('Comments', 'universh'); ?></span><h5><?php comments_number( "0", "1", "%" ) ?></h5></li>
                <li><i class="fa fa-clock-o"></i><span><?php echo esc_html__('Duration', 'universh'); ?></span><h5><?php echo esc_html($course->duration); ?></h5></li>
            </ul>
        </div>
    </div><!-- Course Detail -->
</div>
    <?php
}

add_action('learn_press_content_landing_summary', 'universh_learn_press_content_landing_summary', 5);
function universh_learn_press_content_landing_summary(){
	?>
    <div class="course-full-detail">
    	<div class="col-sm-12">
    <?php
}

add_action('learn_press_content_landing_summary', 'universh_learn_press_content_landing_summary_end', 50);
function universh_learn_press_content_landing_summary_end(){
	?>
    </div>
    </div>
    <?php
}

remove_action( 'learn_press_content_landing_summary', 'learn_press_course_thumbnail', 5 );
remove_action( 'learn_press_content_landing_summary', 'learn_press_course_meta_start_wrapper', 15 );
remove_action( 'learn_press_content_landing_summary', 'learn_press_course_price', 25 );
remove_action( 'learn_press_content_landing_summary', 'learn_press_course_students', 30 );
remove_action( 'learn_press_content_landing_summary', 'learn_press_course_meta_end_wrapper', 35 );
remove_action( 'learn_press_content_landing_summary', 'learn_press_course_enroll_button', 45 );

add_action( 'learn_press_after_single_course', 'universh_learn_press_after_single_course_related_course', 50 );

function universh_learn_press_after_single_course_related_course(){
	global $post;
	
	$terms =  array();
    $postid = get_the_ID();
	$terms = wp_get_post_terms( $postid, 'course_tag' , array('fields' => 'slugs') );
	
	if( !empty($terms) ):
	$args = array(
	'post__not_in'	  => array($postid),
	'posts_per_page' => 4,
	'tax_query' => array(
		array(
			'taxonomy' => 'course_tag',
			'field' => 'slug',
			'terms' => $terms
		))
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ):
	?>
    <div class="related-courses">
    <h4><?php echo esc_html__('Related Courses', 'universh'); ?></h4>
        
    <div class="owl-carousel show-nav-hover dots-dark nav-square dots-square navigation-color" data-animatein="zoomIn" data-animateout="slideOutDown" data-items="1" data-margin="30" data-loop="true" data-merge="true" data-nav="true" data-dots="false" data-stagepadding="" data-mobile="1" data-tablet="2" data-desktopsmall="2"  data-desktop="3" data-autoplay="true" data-delay="3000" data-navigation="true">
        <?php while ( $query->have_posts() ) :$query->the_post();
        $course = LP()->global['course'];
        ?>
        <div class="item">
        	<div class="related-wrap">
            	<div class="img-wrap">
                	<?php universh_post_thumb( 600, 300 ); ?>
                </div>
                <div class="related-content">
                	<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr__('Read More', 'universh'); ?>" class="anchor-plus">+</a><span><?php echo esc_html__('Read More', 'universh'); ?></span>
					<h5 class="title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php esc_attr(the_title()); ?>"><?php the_title(); ?></a></h5>
                </div>
             </div>    	
          </div>                  
         <?php endwhile; ?>
    </div>
    </div>
    <?php
	endif;
	wp_reset_postdata();
	endif;
}
?>