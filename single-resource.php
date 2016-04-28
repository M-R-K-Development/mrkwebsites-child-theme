<?php
//Get the Standard Wordpress Header
get_header();

echo '<!--';

$shortcodes = array();

// Section - Header
$shortcodes[] = '[et_pb_section admin_label="Section" fullwidth="on" specialty="off" background_image="https://3d101ab0d2432bf95181-5b3ac6d5ab3650fbd513d05bc768b370.ssl.cf1.rackcdn.com/2015/10/skyline.jpg" transparent_background="on" allow_player_pause="off" inner_shadow="on" parallax="on" parallax_method="on" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="on" make_equal="off" use_custom_gutter="off"]';

$shortcodes[] = str_replace('%title%', get_the_title(), '[et_pb_fullwidth_header admin_label="Fullwidth Header with Breadcrumb" title="%title%" background_layout="dark" text_orientation="center" header_fullscreen="off" header_scroll_down="on" scroll_down_icon="%%2%%" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0" saved_tabs="all"] [yoast-breadcrumb]');

$shortcodes[] = '[/et_pb_fullwidth_header][/et_pb_section]';

// Section - Introduction

$shortcodes[] = '[et_pb_section admin_label="section"]';


$shortcodes[] = str_replace('%intro%', get_the_excerpt(), '[et_pb_row admin_label="row"][et_pb_column type="4_4"][et_pb_text admin_label="Introduction" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][et_pb_text admin_label="Video" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"]%intro%[/et_pb_text][et_pb_text admin_label="Form" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][et_pb_text admin_label="Secondary Blurb" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][/et_pb_column]');
$shortcodes[] ='[/et_pb_row][/et_pb_section]';



//Build the content
$content = implode('', $shortcodes);



//Make the FAQ
$faq_items = '';

$faq_row = get_field('faq_listing');

if (have_rows('faq_listing')) {
    while (have_rows('faq_listing')) : the_row();
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
	<?php while (have_posts()) : the_post(); ?>

			<?php
                //the_content();
                //remove_filter('the_content', 'wpautop');

                echo apply_filters('the_content', $content);

                wp_link_pages(array( 'before' => '<div class="page-links">' . __('Pages:', 'Divi'), 'after' => '</div>' ));
            ?>

	<?php endwhile; ?>
</div> <!-- #main-content -->


<?php
    // TODO delete
    $template_string = '[et_pb_section admin_label="Section" fullwidth="on" specialty="off" background_image="https://3d101ab0d2432bf95181-5b3ac6d5ab3650fbd513d05bc768b370.ssl.cf1.rackcdn.com/2015/10/skyline.jpg" transparent_background="on" allow_player_pause="off" inner_shadow="on" parallax="on" parallax_method="on" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="on" make_equal="off" use_custom_gutter="off"]
	  [et_pb_fullwidth_header admin_label="Fullwidth Header with Breadcrumb" title="The Wordpress Dashboard" background_layout="dark" text_orientation="center" header_fullscreen="off" header_scroll_down="on" scroll_down_icon="%%2%%" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0" saved_tabs="all"] [yoast-breadcrumb]
	  [/et_pb_fullwidth_header]
	[/et_pb_section]

	[et_pb_section admin_label="section"]
	  [et_pb_row admin_label="row"][et_pb_column type="4_4"][et_pb_text admin_label="Introduction" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][et_pb_text admin_label="Video" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][et_pb_text admin_label="Form" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][et_pb_text admin_label="Secondary Blurb" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][/et_pb_column]
	  [/et_pb_row]
	[/et_pb_section]

	[et_pb_section fullwidth="on" specialty="off" admin_label="Section"]
	  [et_pb_fullwidth_header admin_label="Fullwidth Header" title="FAQ" subhead="Frequently Asked Questions" background_layout="light" text_orientation="left" header_fullscreen="off" header_scroll_down="off" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0"] [/et_pb_fullwidth_header]
	[/et_pb_section]

	[et_pb_section fullwidth="off" specialty="off" admin_label="Section"]
	  [et_pb_row admin_label="Row"][et_pb_column type="4_4"][et_pb_text admin_label="FAQ" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][/et_pb_column]
	  [/et_pb_row]
	[/et_pb_section]

	[et_pb_section fullwidth="on" specialty="off" admin_label="Section"]
	  [et_pb_fullwidth_header admin_label="Fullwidth Header" title="Other Resources" background_layout="light" text_orientation="left" header_fullscreen="off" header_scroll_down="off" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0"] [/et_pb_fullwidth_header]
	[/et_pb_section]

	[et_pb_section fullwidth="off" specialty="off" admin_label="Section"]
	  [et_pb_row admin_label="Row"][et_pb_column type="1_2"][et_pb_text admin_label="Helpful Links" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][/et_pb_column][et_pb_column type="1_2"][et_pb_text admin_label="Related Rsources" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"] [/et_pb_text][/et_pb_column]
	  [/et_pb_row]
	[/et_pb_section]';
 ?>

<?php get_footer(); ?>
