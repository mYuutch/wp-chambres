<?php
/**
 * @package Chambres_Hôte
 * @version 1.0.0
 */
/*
Plugin Name: Gestionnaire de chambres d'hôte
Plugin URI: http://wordpress.org/plugins/gestion-chambre/
Description: Plugin de gestion de chambres d'hôte. 
Author: Enzo Bouchez
Version: 1.0.0
Author URI: 
*/



//Type post chambre
function chambre_custom_post_type() {
    register_post_type('chambre',
        array(
            'labels'      => array(
                'name'          => __('Chambres', 'textdomain'),
                'singular_name' => __('Chambre', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'show_in_rest' => true,
            'supports'    => array('title', 'editor', 'excerpt', 'thumbnail'),
        )
    );
}


add_action('init', 'chambre_custom_post_type');



//Taxonomie type de lit
function register_bed_type_taxonomy() {
    $labels = array(
        'name'              => _x( 'Type de lit', 'taxonomy general name' ),
        'singular_name'     => _x( 'Type de lit', 'taxonomy singular name' ),
        'search_items'      => __( 'Rechercher un type de lit' ),
        'all_items'         => __( 'Tous les types de lit' ),
        'edit_item'         => __( 'Modifier le type de lit' ),
        'update_item'       => __( 'Mettre à jour le type de lit' ),
        'add_new_item'      => __( 'Ajouter un nouveau type de lit' ),
        'new_item_name'     => __( 'Nouveau nom du type de lit' ),
        'menu_name'         => __( 'Types de lit' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'type-lit' ),
    );

    register_taxonomy( 'type_lit', 'chambre', $args );
}
add_action( 'init', 'register_bed_type_taxonomy', 0 );


//Taxonomie gamme de prix 
function register_price_range_taxonomy() {
    $labels = array(
        'name'              => _x( 'Gamme de prix', 'taxonomy general name' ),
        'singular_name'     => _x( 'Gamme de prix', 'taxonomy singular name' ),
        'search_items'      => __( 'Rechercher une gamme de prix' ),
        'all_items'         => __( 'Toutes les gammes de prix' ),
        'edit_item'         => __( 'Modifier la gamme de prix' ),
        'update_item'       => __( 'Mettre à jour la gamme de prix' ),
        'add_new_item'      => __( 'Ajouter une nouvelle gamme de prix' ),
        'new_item_name'     => __( 'Nouveau nom de la gamme de prix' ),
        'menu_name'         => __( 'Gammes de prix' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'gamme-prix' ),
    );

    register_taxonomy( 'gamme_prix', 'chambre', $args );
}
add_action( 'init', 'register_price_range_taxonomy', 0 );


add_action( 'create_post_chambre', 'update_price_range_based_on_price' );
add_action( 'update_post_chambre', 'update_price_range_based_on_price' );
add_action( 'save_post_chambre', 'update_price_range_based_on_price' );


function update_price_range_based_on_price( $post_id ) {
    
    $prix = get_field( 'prix', $post_id );

   
    if ( $prix < 50 ) {
        $price_range = 'e';
    } elseif ( $prix >= 50 && $prix < 100 ) {
        $price_range = 'ee';
    } else {
        $price_range = 'eee';
    }

    $terms = wp_get_post_terms( $post_id, 'gamme_prix' );
    $current_price_range = ! empty( $terms ) ? $terms[0]->name : '';

  
    if ( $price_range !== $current_price_range ) {
 
        $term = term_exists( $price_range, 'gamme_prix' );

      
        if ( ! $term ) {
            $term = wp_insert_term( $price_range, 'gamme_prix' );
        }

     
        if ( ! is_wp_error( $term ) ) {
            wp_remove_object_terms( $post_id, array_values( get_terms( 'gamme_prix', array( 'fields' => 'ids' ) ) ), 'gamme_prix' );
            wp_set_post_terms( $post_id, $term['term_id'], 'gamme_prix', true );
        }
    }
}


require_once(__DIR__ . '/acf-codifier.php');





