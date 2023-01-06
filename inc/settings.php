<?php

function applicon_menu_settings(){

    if(!is_admin()){
      return;
    }

    ?>
      <div class="wrap">
        <form action="options.php" method="POST">
          <?php
            do_settings_sections('like-dislike-settings');
            settings_fields('like-dislike-settings');
            submit_button('Save Changes');
          ?>
        </form>
      </div>
  <?php
}

  function applicon_menu_register(){
    add_menu_page('like dislike', 'Like Dislike Settings', 'manage_options', 'like-dislike-settings',
    'applicon_menu_settings', 'dashicons-thumbs-up', 30);
  }

  add_action('admin_menu', 'applicon_menu_register');

  function applicon_register_settings(){

    register_setting('like-dislike-settings', 'applicon-like-btn-lable');
    register_setting('like-dislike-settings', 'applicon-dislike-btn-lable');

    add_settings_section('applicon_lablel_section', 'Applicon Button Labels', 'applicon_lables_section_cb', 'like-dislike-settings');

    add_settings_field('applicon_lable_like_field', 'Like Button Label', 'like_lablel_field_cb', 'like-dislike-settings', 'applicon_lablel_section');
    add_settings_field('applicon_lable_dislike_field', 'Dislike Button Label', 'dislike_lablel_field_cb', 'like-dislike-settings', 'applicon_lablel_section');
  }

  add_action('admin_init', 'applicon_register_settings');

  function applicon_lables_section_cb(){
    echo '<p> Settings Section Lable </p>';
  }

  function like_lablel_field_cb(){
    $field_value = get_option('applicon-like-btn-lable');
    ?>
    <input type="text" name="applicon-like-btn-lable" value="<?php echo isset( $field_value ) ? esc_attr( $field_value ) : ''; ?>">
    
    <?php
  }

  function dislike_lablel_field_cb(){
    $field_value = get_option('applicon-dislike-btn-lable');
    ?>
    <input type="text" name="applicon-dislike-btn-lable" value="<?php echo isset( $field_value ) ? esc_attr( $field_value ) : ''; ?>">
    
    <?php
  }
