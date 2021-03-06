<?php
/**
 * Copyright (c) 2013-2021, Erin Morelli.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @package EMBM\Admin\Metabox\Profile
 */

/**
 * Add the Beer Profile metabox to the Beer post type
 *
 * @return void
 */
function EMBM_Admin_Metabox_profile()
{
    // Add Beer Profile metabox to sidebar
    add_meta_box(
        'embm_beer_profile',
        __('Beer Profile', 'em-beer-manager'),
        'EMBM_Admin_Metabox_Profile_content',
        EMBM_BEER,
        'side',
        'core'
    );
}

// Add to beer post editor
add_action('add_meta_boxes_'.EMBM_BEER, 'EMBM_Admin_Metabox_profile');

/**
 * Outputs Beer Profile metabox content
 *
 * @return void
 */
function EMBM_Admin_Metabox_Profile_content()
{
    // Get global post object
    global $post;

    // Get current post custom data
    $beer_entry = get_post_meta($post->ID, EMBM_BEER_META, true);
    $beer_entry = (null == $beer_entry) ? array() : $beer_entry;

    // Set custom post data values
    $b_malts = array_key_exists('malts', $beer_entry) ? esc_attr($beer_entry['malts']) : '';
    $b_hops = array_key_exists('hops', $beer_entry) ? esc_attr($beer_entry['hops']) : '';
    $b_adds= array_key_exists('adds', $beer_entry) ? esc_attr($beer_entry['adds']) : '';
    $b_yeast = array_key_exists('yeast', $beer_entry) ? esc_attr($beer_entry['yeast']) : '';
    $b_ibu = array_key_exists('ibu', $beer_entry) ? esc_attr($beer_entry['ibu']) : '0';
    $b_abv = array_key_exists('abv', $beer_entry) ? esc_attr($beer_entry['abv']) : '0';

    // Setup nonce field for options
    wp_nonce_field('embm_profile_save', '_embm_profile_save_nonce');

?>
<div class="embm-metabox embm-metabox--profile">
    <div class="embm-metabox__field embm-metabox--profile-malts">
        <p>
            <label for="embm_malts"><strong><?php _e('Malts', 'em-beer-manager'); ?></strong></label><br />
            <input type="text" name="embm_malts" id="embm_malts" style="width:100%;" value="<?php echo $b_malts; ?>" />
        </p>
    </div>
    <div class="embm-metabox__field embm-metabox--profile-hops">
        <p>
            <label for="embm_hops"><strong><?php _e('Hops', 'em-beer-manager'); ?></strong></label><br />
            <input type="text" name="embm_hops" id="embm_hops" style="width:100%;" value="<?php echo $b_hops; ?>" />
        </p>
    </div>
    <div class="embm-metabox__field embm-metabox--profile-adds">
        <p>
            <label for="embm_adds"><strong><?php _e('Additions/Spices', 'em-beer-manager'); ?></strong></label><br />
            <input type="text" name="embm_adds" id="embm_adds" style="width:100%;" value="<?php echo $b_adds; ?>" />
        </p>
    </div>
    <div class="embm-metabox__field embm-metabox--profile-yeast">
        <p>
            <label for="embm_yeast"><strong><?php _e('Yeast', 'em-beer-manager'); ?></strong></label><br />
            <input type="text" name="embm_yeast" id="embm_yeast" style="width:100%;" value="<?php echo $b_yeast; ?>" />
        </p>
    </div>
    <hr />
    <div class="embm-metabox__field embm-metabox--profile-abv">
        <p>
            <label for="embm_abv"><strong><?php _e('ABV', 'em-beer-manager'); ?></strong></label><br />
            <input type="number" name="embm_abv" id="embm_abv" min="0.0" max="100.0" step="0.1" value="<?php echo $b_abv; ?>" /> %
        </p>
    </div>
    <div class="embm-metabox__field embm-metabox--profile-ibu">
        <p>
            <label for="embm_ibu"><strong><?php _e('IBU', 'em-beer-manager'); ?></strong></label><br />
            <input type="number" name="embm_ibu" id="embm_style" min="0" max="100" step="1" value="<?php echo $b_ibu; ?>" />
        </p>
    </div>
</div>
<?php
}

/**
 * Save the options from the Beer Profile metabox
 *
 * @param int $post_id WP post ID
 *
 * @return void
 */
function EMBM_Admin_Metabox_Profile_save($post_id)
{
    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Validate nonce
    if (!isset($_POST['_embm_profile_save_nonce']) || !wp_verify_nonce($_POST['_embm_profile_save_nonce'], 'embm_profile_save')) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Get current post meta
    $beer_meta = get_post_meta($post_id, EMBM_BEER_META, true);
    $beer_meta = (null == $beer_meta) ? array() : $beer_meta;

    // Get list of attrs
    $beer_attrs = array('malts', 'hops', 'adds', 'yeast', 'ibu', 'abv');

    // Save inputs
    foreach ($beer_attrs as $beer_attr) {
        $beer_meta[$beer_attr] = isset($_POST['embm_'.$beer_attr]) ? esc_attr($_POST['embm_'.$beer_attr]) : null;
    }

    // Update post meta
    update_post_meta($post_id, EMBM_BEER_META, $beer_meta);
}

// Save Beer Profile metabox inputs
add_action('save_post', 'EMBM_Admin_Metabox_Profile_save');
