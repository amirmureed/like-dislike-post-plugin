<?php

function my_ajax_handler_dislikes(){

    global $wpdb;

    $user_id = get_current_user_id();
    $post_id = $_POST['postid'];
    $table_name = $wpdb->prefix . "coutlikedislikes";

    $arr = array();

    $checklike = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE user_id = $user_id AND post_id = $post_id AND likes_count = 1");
    $checkdeslike = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE user_id = $user_id AND post_id = $post_id AND dislikes_count = 1");
    if($checklike == 0 && $checkdeslike == 0){

        $wpdb->insert(
            $table_name,
            array(
                'user_id'        => $user_id,
                'post_id'        => $post_id,
                'likes_count'    => 0,
                'dislikes_count' => 1,
            ),
            array(
                '%d',
                '%d',
                '%d',
                '%d',
            )
        );
    
        if($wpdb->insert_id){
            $post_likes_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE likes_count = 1 AND post_id = $post_id");
            $post_dislikes_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislikes_count = 1 AND post_id = $post_id");
            $arr['response'] = 'Thanks for your Feedback!';
            $arr['lcount'] = $post_likes_count;
            $arr['dcount'] = $post_dislikes_count;
        }else{
            $arr['response'] = "Unknown Error, Please try again latter.";
        }

    }else if($checkdeslike == 1){
        $arr['response'] = "You already disliked the post";
    }else{
        $wpdb->update(
            ''. $table_name .'',
            array(
                'likes_count' => 0,	// string
                'dislikes_count' => 1,	// integer (number)
            ),
            array(
                 'post_id' => $post_id,
                 'user_id' => $user_id,
                ),
            array(
                '%d',	// value1
                '%d'	// value2
            ),
            array(
                '%d',
                '%d',
                )
        );

        $arr['response'] = "Feedback changed successfully! Thank you!";
        $post_likes_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE likes_count = 1 AND post_id = $post_id");
        $post_dislikes_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislikes_count = 1 AND post_id = $post_id");
        $arr['lcount'] = $post_likes_count;
        $arr['dcount'] = $post_dislikes_count;
    }
    echo json_encode($arr);
    die();
}

add_action('wp_ajax_my_ajax_handler_dislikes', 'my_ajax_handler_dislikes');
add_action('wp_ajax_nopriv_my_ajax_handler_dislikes', 'my_ajax_handler_dislikes');


?>