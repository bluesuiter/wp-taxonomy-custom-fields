<?php

class wtcfAdmin
{
    var $taxonomy = '';
    var $taxonomyList = [];
    var $noImage = 'image/no-image.gif';

    public function _wtcfTrigger()
    {
        add_action('current_screen', array($this, 'thisScreen'));
    }

    public function thisScreen() {
        $currentScreen = get_current_screen();
        $currentTaxonomy = $currentScreen->taxonomy;
        if(($currentScreen->base === "term" || $currentScreen->base === "edit-tags")  && in_array($currentTaxonomy, $this->taxonomyList)) {
            /*/ Add the fields to the taxonomy */
            add_action($currentTaxonomy . '_add_form_fields', array($this, 'taxonomy_add_meta_fields'), 10, 2 );
            
            /*/ Save the changes made to the taxonomy */  
            add_action($currentTaxonomy . '_edit_form_fields', array($this, 'taxonomy_edit_meta_fields'), 10, 2 );
        }
    }


    public function my_taxonomy_add_field_column_contents($content, $column_name, $term_id) 
    {
        switch($column_name) 
        {
            case 'feat_image':
                $content = get_term_meta($term_id, 'feat_image', true);
                break;
        }
	    $content = get_term_meta($term_id, 'feat_image', true);
        return $content;
    }

    function taxonomy_add_meta_fields($taxonomy) 
    {
        ?>
        <div class="form-field term-group-wrap" style="clear:both;display: inline-block;width: 100%;">            
            <label for="feat_image"><?php _e('Featured Image', 'feat_image'); ?></label>
            
            <img src="<?php echo plugin_dir_url(__FILE__) . $this->noImage ?>" class="prevwImage feat_image alignleft" width="60px" height="75px"/>
            <div class="alignright">
                <input autocomplete="false" type="hidden" id="feat_image" name="feat_image" value=""/>
                <button autocomplete="false" type="button" data-rowid="feat_image" name="upfIlE" class="button">Upload</button>
            </div>
        </div>
        <?php
    }

    function taxonomy_edit_meta_fields($term)
    {
        $my_field = get_term_meta($term->term_id, 'feat_image', true);
        $image = wp_get_attachment_image_src($my_field)[0];
        if(empty($image))
        {
            $image = plugin_dir_url(__FILE__) . $this->noImage;
        }

        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="feat_image"><?php _e('Featured Image', 'feat_image'); ?></label>
            </th>
            <td>
                <img src="<?php echo  $image; ?>" class="prevwImage feat_image" width="60px" height="75px"/>
                <input type="hidden" id="feat_image" name="feat_image" value="<?php echo $my_field; ?>" />
                <button type="button" data-rowid="feat_image" name="upfIlE" class="button">Upload</button>
            </td>
        </tr>
        <?php
    }


    function save_taxonomy_custom_meta($term_id) {
	    update_term_meta($term_id, 'feat_image', $_POST['feat_image']);	
    }  
}