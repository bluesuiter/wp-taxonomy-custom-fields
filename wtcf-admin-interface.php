<?php

class wtcfAdmin
{
    var $taxonomy = '';

    public function _wtcfTrigger()
    {
        add_action('current_screen', array($this, 'this_screen'));
    }

    public function this_screen() {
        $current_screen = get_current_screen();
        if(($current_screen->base === "term" || $current_screen->base === "edit-tags")  && $current_screen->taxonomy == $this->taxonomy) {
            /*/ Add the fields to the taxonomy */
            add_action($this->taxonomy . '_add_form_fields', array($this, 'taxonomy_add_meta_fields'), 10, 2 );
            
            /*/ Save the changes made to the taxonomy */  
            add_action($this->taxonomy . '_edit_form_fields', array($this, 'taxonomy_edit_meta_fields'), 10, 2 );
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
        <div class="form-field term-group-wrap">            
            <label for="feat_image"><?php _e('Featured Image', 'feat_image'); ?></label>
            <input type="text" id="feat_image" name="feat_image" value="" />
            <button type="button" name="upfIlE" class="button">Upload</button>
        </div>
        <?php
    }

    function taxonomy_edit_meta_fields($term)
    {
        $my_field = get_term_meta($term->term_id, 'feat_image', true);
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="feat_image"><?php _e('Featured Image', 'feat_image'); ?></label>
            </th>
            <td>
                <input type="text" size="25" id="feat_image" name="feat_image" value="<?php echo $my_field; ?>" />
            </td>
        </tr>
        <?php
    }


    function save_taxonomy_custom_meta( $term_id ) {
	    update_term_meta($term_id, 'feat_image', $_POST['feat_image']);	
    }  
}