<?php

// Translations can be filed in the /lang/ directory
load_theme_textdomain( 'themejunkie', get_template_directory() . '/lang' );

require_once(get_template_directory() . '/includes/sidebar-init.php');
require_once(get_template_directory() . '/includes/custom-functions.php'); 
require_once(get_template_directory() . '/includes/post-thumbnails.php');

require_once(get_template_directory() . '/includes/theme-options.php');
require_once(get_template_directory() . '/includes/theme-widgets.php');

require_once(get_template_directory() . '/functions/theme_functions.php'); 
require_once(get_template_directory() . '/functions/admin_functions.php');

// Uncomment this to test your localization, make sure to enter the right language code.
// function test_localization( $locale ) {
// 	return "nl_NL";
// }
// add_filter('locale','test_localization');

add_filter('the_content', 'wpse_ad_content');

function wpse_ad_content($content)
{
    if (!is_single()) return $content;
    $paragraphAfter = 3; //Enter number of paragraphs to display ad after.
    $content = explode("</p>", $content);
    $new_content = '';
    for ($i = 0; $i < count($content); $i++) {
        if ($i == $paragraphAfter) {
            $new_content.= '<center style="width: 100%; height: auto; padding: 6px 6px 6px 0; float: left; margin-left: 0; margin-right: 18px;">';
            $new_content.= get_option('newswire_inside_content_ad_code');
            $new_content.= '</center>';
        }


        $new_content.= $content[$i] . "</p>";
    }

    return $new_content;
}
?>