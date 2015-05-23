<?php
defined('ABSPATH') or die('Cannot access pages directly.');

function automatic_tagging($the_post_id) {
	$post = get_post($the_post_id);
    if ($post->post_type == 'post') {
        $post_categories = wp_get_post_categories($the_post_id);
        $aet_automatic_tagging_included_categories = get_option('aet_automatic_tagging_included_categories');
        $the_post_content = get_post($the_post_id)->post_content;
        $the_post_content = strtolower($the_post_content);
        $the_post_content = wp_strip_all_tags($the_post_content);
        $existingtags = get_terms('post_tag', array('hide_empty' => false));
        if (is_array($aet_automatic_tagging_included_categories)) {
            $comparison = array_intersect($post_categories, $aet_automatic_tagging_included_categories);
            $matches = count($comparison);
        }
        else {
            $matches = 0;
        }
        if (($existingtags) && ($matches > 0)) {
            wp_delete_object_term_relationships($the_post_id, 'post_tag');
            foreach ($existingtags as $newtag) {
                $pattern = strtolower($newtag->name);
                if (preg_match('/(\W|\A)' . $pattern . '(\W|\z)/', $the_post_content)) {
                    wp_set_post_terms($the_post_id, $newtag->name, 'post_tag', true);
                }
            }
        }
    }
}

if (get_option('aet_automatic_tagging') == 1) {
    add_action('wp_insert_post', 'automatic_tagging');
}
?>