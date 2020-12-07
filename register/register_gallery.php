<?php



  function add_gallery_metabox($post_type) {
    $types = array('autos');

    if (in_array($post_type, $types)) {
      add_meta_box(
        'gallery-metabox',
        'Galerij',
        'gallery_meta_callback',
        $post_type,
        'normal',
        'high'
      );
    }
  }
  add_action('add_meta_boxes', 'add_gallery_metabox');

  function gallery_meta_callback($post) {
    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);

    ?>
    <table class="form-table">
      <tr><td>
        <a class="gallery-add button" href="#" data-uploader-title="Foto's toevoegen" data-uploader-button-text="Foto's toevoegen">Foto's toevoegen</a>

        <ul id="gallery-metabox-list">
        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

          <li>
            <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <div class="image-preview change-image" style='width: 156px;height: 119px;background:url("<?php echo $image[0]; ?>");background-size:cover;'></div>
            <div class="gallerycontrols remove-image" style="">&#10006;</div>
          </li>

        <?php endforeach; endif; ?>
        </ul>

      </td></tr>
    </table>
  <?php }

  function gallery_meta_save($post_id) {
    if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if(isset($_POST['vdw_gallery_id'])) {
      update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
    }
  }
  
  add_action('save_post', 'gallery_meta_save');

?>