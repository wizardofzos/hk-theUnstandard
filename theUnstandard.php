<?php
/*
Plugin Name: hk theUnstandard
Plugin URI: http://weblog.kuipersite.nl
Description: This plugin auto adds lead and secondary image custom fields if you add images to the post
Version: 0.4
Author: Henri Kuiper
Author URI: http://twitter.com/henrikuiper
*/

// only in Admin Section
if (is_admin())
{
  add_action('save_post','addCustomFields');
}

function addCustomFields($post_ID){
  // This will add the two custom fields needed for theUnstandard theme
  
  // Are there images added to the post?
  $query = 'post_parent='.$post_ID.'&post_mime_type=image';
  $images =& get_children($query);
  $image = array_rand($images);
  update_post_meta($post_ID, 'debughk', count($images));
  if (count($images) > 0){
    $imageURL = wp_get_attachment_url($image);
    update_post_meta($post_ID, 'lead_image', $imageURL);
    update_post_meta($post_ID, 'secondary_image', $imageURL);
  }
}


