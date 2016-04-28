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

$shortcodes[] = '[et_pb_section admin_label="section"][et_pb_row admin_label="row"][et_pb_column type="4_4"]';

$shortcodes[] = str_replace('%intro%', get_the_excerpt(), '[et_pb_text admin_label="Introduction" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"]%intro%[/et_pb_text]');

// Video
$has_video = get_field('has_video');
if ($has_video == 1) {
    $shortcodes[] = str_replace('%embed_video_code%', get_field('embed_video_code'), '[et_pb_text admin_label="Video" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"]%embed_video_code%[/et_pb_text]');
}

$has_form = get_field('has_form');


if ($has_form == 1) {
    $form = get_field('gravity_form');
    $shortcodes[] =  str_replace('%gravity_form_id%', \GFFormsModel::get_form_id($form['title']), '[et_pb_text admin_label="Form" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"][gravityform id="%gravity_form_id%" title="true" description="true"][/et_pb_text]');
}

$has_secondary_blurb = get_field('has_second_blurb');

if ($has_secondary_blurb) {
    $shortcodes[] = str_replace('%secondary_blurb_text%', get_field('secondary_blurb_text'), '[et_pb_text admin_label="Secondary Blurb" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"]%secondary_blurb_text%[/et_pb_text])');
}

$shortcodes[] ='[/et_pb_column][/et_pb_row][/et_pb_section]';

$has_faq = get_field('has_faq');

if ($has_faq == 'Yes') {
    // header section.
    $shortcodes[] = '[et_pb_section fullwidth="on" specialty="off" admin_label="Section"][et_pb_fullwidth_header admin_label="Fullwidth Header" title="FAQ" subhead="Frequently Asked Questions" background_layout="light" text_orientation="left" header_fullscreen="off" header_scroll_down="off" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0"] [/et_pb_fullwidth_header]
	[/et_pb_section]';

    //Make the FAQ
    $faq_items = '';

    $faq_row = get_field('faq_listing');

    if (have_rows('faq_listing')) {
        while (have_rows('faq_listing')) : the_row();
        $q = get_sub_field('question');
        $a = get_sub_field('answer');
        $faq_items .= sprintf('[et_pb_toggle admin_label="Toggle" title="%s" open="off" use_border_color="off" border_color="#ffffff" border_style="solid"]%s[/et_pb_toggle]', $q, $a);
        endwhile;
    }

    $shortcodes[] = str_replace('%faq_items%', $faq_items, '[et_pb_section fullwidth="off" specialty="off" admin_label="Section"][et_pb_row admin_label="Row"][et_pb_column type="4_4"][et_pb_text admin_label="FAQ" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"]%faq_items%[/et_pb_text][/et_pb_column][/et_pb_row][/et_pb_section]');
}

// other resources.
$has_related_resources = false;
$related_resources = get_field('related_resources');
if ($related_resources && is_array($related_resources) && !empty($related_resources)) {
    $has_related_resources = true;
    // TODO: find better UI for related resources.
    $resources_html = array('<ul>');
    foreach ($related_resources as $resource) {
        $resources_html[] = '<li>';
        $resources_html[] = sprintf('<p><b><a href="%s">%s</a><b<p>', $resource->guid, $resource->post_title);
        $resources_html[] = sprintf('<div style="display:block">%s</div>', $resource->post_excerpt);
        $resources_html[] = '</li>';
    }
    $resources_html[] = '</ul>';
    // var_dump($resources_html);
    // exit;
}

$has_helpful_links  = false;
if (have_rows('helpful_links')) {
    $link_html = array('<ul>');
    $has_helpful_links  = true;
    while (have_rows('helpful_links')) : the_row();

    $link_html[] = sprintf("<li><a href='%s'>%s</a></li>", get_sub_field('url_enpoint'), get_sub_field('link_name'));
    endwhile;
    $link_html[] = '</ul>';
}

if ($has_related_resources || $has_helpful_links) {
    $shortcodes[] = '[et_pb_section fullwidth="on" specialty="off" admin_label="Section"][et_pb_fullwidth_header admin_label="Fullwidth Header" title="Other Resources" background_layout="light" text_orientation="left" header_fullscreen="off" header_scroll_down="off" parallax="off" parallax_method="off" content_orientation="center" image_orientation="center" custom_button_one="off" button_one_letter_spacing="0" button_one_use_icon="default" button_one_icon_placement="right" button_one_on_hover="on" button_one_letter_spacing_hover="0" custom_button_two="off" button_two_letter_spacing="0" button_two_use_icon="default" button_two_icon_placement="right" button_two_on_hover="on" button_two_letter_spacing_hover="0"] [/et_pb_fullwidth_header]
	[/et_pb_section]';

    $shortcodes[] = '[et_pb_section fullwidth="off" specialty="off" admin_label="Section"][et_pb_row admin_label="Row"]';

    if ($has_related_resources) {
        $shortcodes[] = str_replace('%related_resources%', implode('', $resources_html), '[et_pb_column type="1_2"][et_pb_text admin_label="Helpful Links" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"]%related_resources%[/et_pb_text][/et_pb_column]');
    }

    if ($has_helpful_links) {
        $shortcodes[] = str_replace('%helpful_links%', implode('', $link_html), '[et_pb_column type="1_2"][et_pb_text admin_label="Related Rsources" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"]%helpful_links%[/et_pb_text][/et_pb_column]');
    }

    $shortcodes[] = '[/et_pb_row][/et_pb_section]';
}



//Build the content
$content = implode('', $shortcodes);


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


<?php get_footer(); ?>
