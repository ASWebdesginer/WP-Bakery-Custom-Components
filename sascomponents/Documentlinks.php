<?php 
class WPBakeryShortCode_vc_soda_document extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $css = '';
        $atts = shortcode_atts(array(
            'document_items' => '',
            'image' => '',
            'quote_author' => '',
            'fliping_text' => '',
            'css' => ''
              // Set a default value for 'document_items'
        ), $atts);

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        // Get the repeater field data
        $document_items = vc_param_group_parse_atts($atts['document_items']);

        // Initialize the output variable
        $output = '';

        // Check if there are items in the repeater
        if (!empty($document_items)) {
            // Start the document list
            $output .= '<div class="'. esc_attr( $css_class ) . '">';
            $output .= '<ul class="document-list">';

            foreach ($document_items as $item) {
                // Get data for each document item
                if (isset($item['image']) ) {

                $image_id = $item['image'];
                $file_path = get_attached_file($image_id);
                $filename = basename($file_path);
                if(isset($item['quote_author'])){
                    $docname=esc_html($item['quote_author']);
                }else{
                    $docname=$filename;
                }
                
                // Generate HTML for each document item
                $output .= '<li>';
                $output .= '<div class="document">';
                $output .= '<p><a href="' . wp_get_attachment_url($image_id) . '">' . $docname . '</a></p>';
                $output .= '</div>';
                $output .= '</li>';
            }
        }
            // End the document list
            $output .= '</ul> </div>';
        }

        return $output;
    }
}

vc_map(array(
    'name' => __('Document', 'sasdeveloper'),
    'base' => 'vc_soda_document',
    'icon' => 'vc_general vc_element-icon vc_icon-vc-section',
    'description' => __('Add a Document or Group Of Documents', 'sasdeveloper'),
    'category' => __('sasdeveloper Modules', 'sasdeveloper'),
    'params' => array(
        array(
            'type' => 'param_group',
            'param_name' => 'document_items',
            'edit_field_class' => 'vc_col-xs-12 mi6documentdiv',
            'class' => 'mi6documentdiv',
            'value' => '',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'edit_field_class' => 'vc_col-xs-12 document_ipload',
                    'class' => 'sasdevfile',
                    'heading' => __('Image', 'sasdeveloper'),
                    'param_name' => 'image',
                    'description' => __('Upload an image.', 'sasdeveloper'),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'edit_field_class' => 'vc_col-xs-12 namefile',
                    'heading' => __('Document Name', 'sasdeveloper'),
                    'param_name' => 'quote_author',
                    'description' => __('Add Document Name.', 'sasdeveloper'),
                ),
                array(
                    "type" => "my_param",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Flipping text", "js_composer"),
                    'edit_field_class' => 'vc_col-xs-12 custom_btn',
                    "param_name" => "fliping_text",
                    "value" => '',
                    "description" => __( "Enter text and flip it", 'my-text-domain' ),
                    )
            ),
            'group' => 'Repeater Group',
            'description' => __('Add multiple document items.', 'sasdeveloper'),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'sasdeveloper' ),
            'param_name' => 'css',
            'group' => __( 'Design options', 'sasdeveloper' ),
            ),
    ),
));
