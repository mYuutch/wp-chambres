<?php
function twentytwentyone_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_child_enqueue_styles' );


function custom_modify_main_query( $query ) {
    if ( ! is_admin() && is_post_type_archive( 'chambre' ) ) {
        
        $query->set( 'posts_per_page', 10 );

        if ( isset( $_GET['gamme_prix'] ) || isset( $_GET['type_lit'] ) ) {
            $tax_query = array();

            if ( isset( $_GET['gamme_prix'] ) && $_GET['gamme_prix'] != '' ) {
                $tax_query[] = array(
                    'taxonomy' => 'gamme_prix',
                    'field'    => 'slug',
                    'terms'    => $_GET['gamme_prix'],
                );
            }

            if ( isset( $_GET['type_lit'] ) && $_GET['type_lit'] != '' ) {
                $tax_query[] = array(
                    'taxonomy' => 'type_lit',
                    'field'    => 'slug',
                    'terms'    => $_GET['type_lit'],
                );
            }

           
            $query->set( 'tax_query', $tax_query );
        }
    }
}
add_action( 'pre_get_posts', 'custom_modify_main_query' );
