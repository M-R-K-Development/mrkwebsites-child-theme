<?php 
//Get the Standard Wordpress Header
get_header();

echo '<!--';

//Section templates from Shortcode
$header = '[et_pb_section admin_label="Section" fullwidth="on" specialty="off" background_image="https://mrkwebsites.com/wp-content/uploads/2015/10/skyline.jpg" transparent_background="on" allow_player_pause="off" inner_shadow="on" parallax="on" parallax_method="on" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="on" make_equal="off" use_custom_gutter="off"][et_pb_fullwidth_header admin_label="Fullwidth Header with Breadcrumb" title="%resource_title%" background_layout="dark" text_orientation="center" header_fullscreen="off" header_scroll_down="on" scroll_down_icon="%%2%%" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0" saved_tabs="all"] [yoast-breadcrumb] [/et_pb_fullwidth_header][/et_pb_section]';

$start_block = '[et_pb_section admin_label="section"][et_pb_row admin_label="row"][et_pb_column type="4_4"]';

$intro_block = '[et_pb_text admin_label="Introduction" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text]';

$video_block = '[et_pb_text admin_label="Video" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text]';

$form_block = '[et_pb_text admin_label="Form" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text]';

$second_blurb_block = '[et_pb_text admin_label="Secondary Blurb" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text]';

$end_block = '[/et_pb_column][/et_pb_row][/et_pb_section]';

//Build the content
$content = $header.$start_block.$intro_block.$video_block.$form_block.$second_blurb_block.$end_block;

//Setup my core variables
$resource_title = get_the_title();

//Make the FAQ
$faq_items = '';

$faq_row = get_field('faq_listing');	

if( have_rows('faq_listing') ) {
	while ( have_rows('faq_listing') ) : the_row();
    	$q = get_sub_field('question');
    	$a = get_sub_field('answer');
    	$faq_items .= '<h3>'.$q.'</h3><p>'.$a.'</p>';
	endwhile;
}
	
$faq_items = $faq_items;

//Parse and Populate the Template
$content = str_replace('%FormId%', $resource_gravity_form, $content);
$content = str_replace('%resource_title%', $resource_title, $content);
$content = str_replace('%faq%', $faq_items, $content);

echo '-->';
?>
<div id="main-content">	
	<?php while ( have_posts() ) : the_post(); ?>
		
			<?php
				//the_content();
				//remove_filter('the_content', 'wpautop');
				
				echo apply_filters('the_content', $content);
				
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
			?>
		
	<?php endwhile; ?>
</div> <!-- #main-content -->

<?php get_footer(); ?>