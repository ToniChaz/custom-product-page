<?php
/**
 * Plugin Name: Custom product page
 * Plugin URI: http://www.tonichaz.com
 * Description: Make a custom product details page.
 * Version: 1.0.0
 * Author: Toni Chaz
 * Author URI: http://www.tonichaz.com
 * License: GNU
 */
include 'add-product-template.php';

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function product_add_meta_box() {

    add_meta_box(
            'product_metabox', __('Ficha producto', 'product_textdomain'), 'product_meta_box_callback', 'page', 'normal', 'high'
    );
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function product_meta_box_callback($post) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('product_meta_box', 'product_meta_box_nonce');

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $product_price = get_post_meta($post->ID, '_product_price', true);
    $product_description = get_post_meta($post->ID, '_product_description', true);
    $product_detail = get_post_meta($post->ID, '_product_detail', true);
    $product_detail_table_key = get_post_meta(get_the_ID(), '_product_detail_table_key', true);
    $product_detail_table_value = get_post_meta(get_the_ID(), '_product_detail_table_value', true);
    $product_detail_table_select = get_post_meta(get_the_ID(), '_product_detail_table_select', true);
    $product_detail_table_select2 = get_post_meta(get_the_ID(), '_product_detail_table_select2', true);
    ?>
    <p>
        <label for="product_price">
            <?php _e('Precio', 'product_textdomain'); ?>
        </label>
        <input type="text" id="product_price" name="product_price" value="<?php echo esc_attr($product_price) ?>" size="5" />	&euro;
    </p>
    <p>
        <label for="product_description">
            <?php _e('Descripción', 'product_textdomain'); ?>
        </label>
    <div class="wp-editor-container">
        <textarea class="wp-editor-area" autocomplete="off" cols="40" name="product_description" id="product_description"><?php echo esc_attr($product_description) ?></textarea>
    </div>
    </p>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Detalles del producto</a></li>
            <li><a href="#tabs-2">Detalles del producto</a></li>
        </ul>
        <div id="tabs-1" class="wp-editor-container">
            <textarea class="wp-editor-area" autocomplete="off" cols="40" name="product_detail"><?php echo esc_attr($product_detail) ?></textarea>
        </div>  
        <div id="tabs-2">
            <p> 
                <button type="button" onClick="Product.addRow('dataTable')" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">
                    <span class="ui-button-text">Add row</span>
                </button>
                <button type="button" onClick="Product.deleteRow('dataTable')" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">
                    <span class="ui-button-text">Remove row</span>
                </button>
            <p>(All acions apply only to entries with check marked check boxes only.)</p>
            </p>		    				
            <table id="dataTable" class="form" border="1">
                <tbody>
                    <?php                        
                    if ($product_detail_table_key == "") {                        
                        ?>
                        <tr>
                            <td >
                                <input type="checkbox" name="product_detail_table_chk[]"/>
                            </td>
                            <td>
                                <label>Key</label>
                                <input type="text" name="product_detail_table_key[]">
                            </td>
                            <td>
                                <label for="product_detail_table_value">Value</label>
                                <input type="text" class="small"  name="product_detail_table_value[]">
                            </td>
                            <td>
                                <label for="product_detail_table_select">Select</label>
                                <select id="select" name="product_detail_table_select[]">
                                    <option value="">...</option>				
                                    <option value="One">One</option>				
                                    <option value="Two">Two</option>				
                                    <option value="Three">Three</option>				
                                </select>
                            </td>
                            <td>
                                <label for="product_detail_table_select2">Select 2</label>
                                <select id="select2" name="product_detail_table_select2[]">
                                    <option value="">...</option>				
                                    <option value="One">One</option>				
                                    <option value="Two">Two</option>				
                                    <option value="Three">Three</option>
                                </select>
                        </tr>
                        <?php
                    } else {
                        foreach ($product_detail_table_key as $a => $b) {
                            ?>
                            <tr>
                                <td >
                                    <input type="checkbox" name="product_detail_table_chk[]"/>
                                </td>
                                <td>
                                    <label>Key</label>
                                    <input type="text" name="product_detail_table_key[]" value="<?php echo $product_detail_table_key[$a]; ?>">
                                </td>
                                <td>
                                    <label for="product_detail_table_value">Value</label>
                                    <input type="text" class="small"  name="product_detail_table_value[]" value="<?php echo $product_detail_table_value[$a]; ?>">
                                </td>
                                <td>
                                    <label for="product_detail_table_select">Select</label>
                                    <select id="select" name="product_detail_table_select[]" value="<?php echo $product_detail_table_select[$a]; ?>">
                                        <?php
                                        $options = array('...', 'One', 'Two', 'Three');
                                        $output = '';
                                        for ($i = 0; $i < count($options); $i++) {
                                            $output .= '<option '
                                                    . ( $product_detail_table_select[$a] == $options[$i] ? 'selected="selected"' : '' ) . '>'
                                                    . $options[$i]
                                                    . '</option>';
                                        }
                                        echo $output;
                                        ?>						
                                    </select>
                                </td>
                                <td>
                                    <label for="product_detail_table_select2">Select 2</label>
                                    <select id="select2" name="product_detail_table_select2[]" value="<?php echo $product_detail_table_select2[$a]; ?>">
                                        <?php
                                        $options = array('...', 'One', 'Two', 'Three');
                                        $output = '';
                                        for ($i = 0; $i < count($options); $i++) {
                                            $output .= '<option '
                                                    . ( $product_detail_table_select2[$a] == $options[$i] ? 'selected="selected"' : '' ) . '>'
                                                    . $options[$i]
                                                    . '</option>';
                                        }
                                        echo $output;
                                        ?>
                                    </select>
                            </tr>
                        <?php }
                    }
                    ?>  	
                </tbody>
            </table>
        </div> 
    </div>
    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function product_save_meta_box_data($post_id) {
    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if (!isset($_POST['product_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['product_meta_box_nonce'], 'product_meta_box')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if (!isset($_POST['product_price']) || !isset($_POST['product_description'])) {
        return;
    }

    // Add data in array.
    $product_data = array(
        '_product_price' => sanitize_text_field($_POST['product_price']),
        '_product_description' => sanitize_text_field($_POST['product_description']),
        '_product_detail' => sanitize_text_field($_POST['product_detail']),
        '_product_detail_table_chk' => $_POST['product_detail_table_chk'],
        '_product_detail_table_key' => $_POST['product_detail_table_key'],
        '_product_detail_table_value' => $_POST['product_detail_table_value'],
        '_product_detail_table_select' => $_POST['product_detail_table_select'],
        '_product_detail_table_select2' => $_POST['product_detail_table_select2']
    );
    
    // // Update the meta field in the database.
    foreach ($product_data as $key => $value) {
        update_post_meta($post_id, $key, $value);
    }
    
}

add_action('save_post', 'product_save_meta_box_data');

/**
 * Init product template.
 *
 */
function init_product_template() {
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    if (!isset($post_id)) {
        return;
    }

    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ($template_file == 'page-product.php') { // edit the template name
        remove_post_type_support('page', 'editor');
        add_action('add_meta_boxes', 'product_add_meta_box');
    }

    $plugin_url = plugins_url();
    wp_enqueue_script('jquery-ui', "{$plugin_url}/custom-product-page/js/vendor/jquery-ui.min.js", array('jquery'));
    wp_enqueue_script('admin-main', "{$plugin_url}/custom-product-page/js/admin-main.js");
    wp_enqueue_style('jquery-ui-css', "{$plugin_url}/custom-product-page/css/jquery-ui.min.css");
}

add_action('admin_init', 'init_product_template');

/**
 * Registers scripts for the theme and enqueue those used site wide.
 *
 */
function inject_scripts() {

    if (is_page_template('page-product.php')) {
        $plugin_url = plugins_url();
        wp_enqueue_script('jquery-ui', "{$plugin_url}/custom-product-page/js/vendor/jquery-ui.min.js", array('jquery'));
        wp_enqueue_script('page-main', "{$plugin_url}/custom-product-page/js/page-main.js");
        wp_enqueue_style('jquery-ui-css', "{$plugin_url}/custom-product-page/css/jquery-ui.min.css");
    }
}

/* Enqueue scripts (and related stylesheets) */
add_action('wp_enqueue_scripts', 'inject_scripts');

