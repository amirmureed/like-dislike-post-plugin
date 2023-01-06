<?php

function show_like_dislike_on_frontend($content){

    global $wpdb;

    $post_id = get_the_ID();
    $table_name = $wpdb->prefix . "coutlikedislikes";

    $like_btn_label = get_option('applicon-like-btn-lable', 'Like');
    $dislike_btn_label = get_option('applicon-dislike-btn-lable', 'Dislike');

    $post_likes_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE likes_count = 1 AND post_id = $post_id");
    $post_dislikes_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislikes_count = 1 AND post_id = $post_id");
  
    $like_btn = '<a style="background:green;" data-id='. get_the_ID().' class="btn like-btn">' . $like_btn_label .  ' <span> (<span class="likes-count">'. $post_likes_count .'</span>) </span> </a>';
    $dislike_btn = '<a style="background:red;" class="btn dislike-btn">' . $dislike_btn_label . ' <span> (<span class="dislikes-count">'. $post_dislikes_count .'</span>) </span> </a>' ;
    $response = '<p class="click-feedback"> </p>';


    $content .= $like_btn;
    $content .= $dislike_btn;
    $content .= $response;
    return $content;
  }
  
  add_filter('the_content', 'show_like_dislike_on_frontend');
  ?>