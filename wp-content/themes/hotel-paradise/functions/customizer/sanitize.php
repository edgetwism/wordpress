<?php 
function hotel_paradise_sanitize_css($string) {
    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags($string);
    return trim( $string );
}

function hotel_paradise_sanitize_color_alpha( $color ){
    $color = str_replace( '#', '', $color );
    if ( '' === $color ){
        return '';
    }
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', '#' . $color ) ) {
        // convert to rgb
        $colour = $color;
        if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
            return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return 'rgba('.join( ',', array( 'r' => $r, 'g' => $g, 'b' => $b, 'a' => 1 ) ).')';

    }

    return strpos( trim( $color ), 'rgb' ) !== false ?  $color : false;
}

function hotel_paradise_sanitize_repeatable_data_field( $input , $setting ){
    $control = $setting->manager->get_control( $setting->id );

    $fields = $control->fields;
    if ( is_string( $input ) ) {
        $input = json_decode( wp_unslash( $input ) , true );
    }
    $data = wp_parse_args( $input, array() );

    if ( ! is_array( $data ) ) {
        return false;
    }
    if ( ! isset( $data['_items'] ) ) {
        return  false;
    }
    $data = $data['_items'];

    foreach( $data as $i => $item_data ){
        foreach( $item_data as $id => $value ){

            if ( isset( $fields[ $id ] ) ){
                switch( strtolower( $fields[ $id ]['type'] ) ) {
                    case 'text':
                        $data[ $i ][ $id ] = sanitize_text_field( $value );
                        break;
                    case 'textarea':
                    case 'editor':
                        $data[ $i ][ $id ] = wp_kses_post( $value );
                        break;
                    case 'color':
                        $data[ $i ][ $id ] = sanitize_hex_color_no_hash( $value );
                        break;
                    case 'coloralpha':
                        $data[ $i ][ $id ] = hotel_paradise_sanitize_color_alpha( $value );
                        break;
                    case 'checkbox':
                        $data[ $i ][ $id ] =  hotel_paradise_sanitize_checkbox( $value );
                        break;
                    case 'select':
                        $data[ $i ][ $id ] = '';
                        if ( is_array( $fields[ $id ]['options'] ) && ! empty( $fields[ $id ]['options'] ) ){
                            // if is multiple choices
                            if ( is_array( $value ) ) {
                                foreach ( $value as $k => $v ) {
                                    if ( isset( $fields[ $id ]['options'][ $v ] ) ) {
                                        $value [ $k ] =  $v;
                                    }
                                }
                                $data[ $i ][ $id ] = $value;
                            }else { // is single choice
                                if (  isset( $fields[ $id ]['options'][ $value ] ) ) {
                                    $data[ $i ][ $id ] = $value;
                                }
                            }
                        }

                        break;
                    case 'radio':
                        $data[ $i ][ $id ] = sanitize_text_field( $value );
                        break;
                    case 'media':
                        $value = wp_parse_args( $value,
                            array(
                                'url' => '',
                                'id'=> false
                            )
                        );
                        $value['id'] = absint( $value['id'] );
                        $data[ $i ][ $id ]['url'] = sanitize_text_field( $value['url'] );

                        if ( $url = wp_get_attachment_url( $value['id'] ) ) {
                            $data[ $i ][ $id ]['id']   = $value['id'];
                            $data[ $i ][ $id ]['url']  = $url;
                        } else {
                            $data[ $i ][ $id ]['id'] = '';
                        }

                        break;
                    default:
                        $data[ $i ][ $id ] = wp_kses_post( $value );
                }

            }else {
                $data[ $i ][ $id ] = wp_kses_post( $value );
            }

            if ( count( $data[ $i ] ) !=  count( $fields ) ) {
                foreach ( $fields as $k => $f ){
                    if ( ! isset( $data[ $i ][ $k ] ) ) {
                        $data[ $i ][ $k ] = '';
                    }
                }
            }

        }
    }

    return $data;
}

function hotel_paradise_sanitize_file_url( $file_url ) {
    $output = '';
    $filetype = wp_check_filetype( $file_url );
    if ( $filetype["ext"] ) {
        $output = esc_url( $file_url );
    }
    return $output;
}

function hotel_paradise_hero_fullscreen_callback ( $control ) {
    if ( $control->manager->get_setting('hotel_paradise_hero_fullscreen')->value() == '' ) {
        return true;
    } else {
        return false;
    }
}

function hotel_paradise_sanitize_select( $input, $setting ){

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

function hotel_paradise_sanitize_number( $input ) {
    return balanceTags( $input );
}

function hotel_paradise_sanitize_hex_color( $color ) {
    if ( $color === '' ) {
        return '';
    }
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }
    return null;
}

function hotel_paradise_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function hotel_paradise_sanitize_text( $string ) {
    return wp_kses_post( balanceTags( $string ) );
}

function hotel_paradise_sanitize_html_input( $string ) {
    return wp_kses_allowed_html( $string );
}

function hotel_paradise_showon_frontpage() {
    return is_page_template( 'template-frontpage.php' );
}

function hotel_paradise_gallery_source_validate( $validity, $value ){
    if ( ! class_exists( 'hotel_paradise_Pro' ) ) {
        if ( $value != 'page' ) {
            $validity->add('notice', sprintf( esc_html__('Upgrade to %1s to unlock this feature.', 'hotel-paradise' ), '<a target="_blank" href="https://redfoxthemes.com/themes/">Hotel Paradise Pro</a>' ) );
        }
    }
    return $validity;
}


/**
 * Image sanitization callback function.
 */
function hotel_paradise_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        //'bmp'          => 'image/bmp',
        //'tif|tiff'     => 'image/tiff',
        //'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}