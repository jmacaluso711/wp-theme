<?php

// GET ACF IMAGE
// Gets image URL through ACF on the current page
// ACF must provide attachment ID
function acf_image_url($acf_image, $wp_thumb, $inline_style = false) {

    // Could be normal field or sub_field
    if (get_sub_field($acf_image)) {

        $acf_field = get_sub_field($acf_image);

    } elseif (get_field($acf_image)) {

        $acf_field = get_field($acf_image);

    }

    if (isset($acf_field)) {

        $image = wp_get_attachment_image_src($acf_field, $wp_thumb);

        if ($inline_style) {

            $result = 'style="background-image: url(\'';
            $result .= $image[0]; // ACF stores images in arrays
            $result .= '\');"';

        } else {

            $result = $image[0]; // ACF stores images in arrays

        }

    }

    return ! empty( $result ) ? $result : false;

}

// GET POST RELATIONSHIP URL LIST
// Produce URL list of post relationship array
function acf_post_relationship_list($acf_post_array) {

    $acf_post_array = get_field($acf_post_array);
                                    
    if (isset($acf_post_array)) {

        $acf_post_count = count($acf_post_array);

        $result = "";

        foreach ($acf_post_array as $acf_post_object) {

            $acf_post_count--;

            $result .= '<a href="' . get_the_permalink($acf_post_object->ID) . '" title="Permalink to ' . get_the_title($acf_post_object->ID) . '">' . get_the_title($acf_post_object->ID) . '</a>';

            if ($acf_post_count >= 2) {
                $result .= ', ';
            } elseif ($acf_post_count == 1) {
                $result .= ' and ';
            }

        }

    }

    return ! empty( $result ) ? $result : false;

}

// GET BACKGROUND COLOR INLINE STYLE
function acf_background_color_style($background_color) {

    // Could be normal field or sub_field
    if (get_sub_field($background_color)) {

        $background_color = get_sub_field($background_color);

    } elseif (get_field($background_color)) {

        $background_color = get_field($background_color);

    }

    if (isset($background_color)) {

        $result = 'style="background-color: ';
        $result .= $background_color;
        $result .= ';"';

    }

    return ! empty( $result ) ? $result : false;

}

?>