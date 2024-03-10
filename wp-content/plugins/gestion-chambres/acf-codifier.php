<?php
namespace Geniem\ACF;

use Geniem\ACF\Group;
use Geniem\ACF\RuleGroup;
use Geniem\ACF\Field\Text;
use Geniem\ACF\Field\Number;
use Geniem\ACF\Field\Select;
use Geniem\ACF\ConditionalLogicGroup;
use Geniem\ACF\Field\Multitaxonomy;
use Geniem\ACF\Field\Taxonomy;




$field_group = new Group('Détails');
$field_group->set_key( 'details_chambre' )
            ->set_position('side')
            ->set_style('seamless')
            ->hide_element('the_content');

$rule_group = new RuleGroup();
$rule_group->add_rule('post_type', '==', 'chambre');

$field_group->add_rule_group($rule_group);

$field_group->register();

// Nombre de couchages
$couchages = new Field\Number('Nombre de couchages', 'couchages', 'couchages');
$couchages->set_min(1);
$couchages->set_max(6);
$field_group->add_field( $couchages );


//Prix indicatif
$prix = new Field\Number('Prix en dollars', 'prix', 'prix');
$prix->set_prepend('$');
$prix->set_min(1);
$prix->set_max(300);
$field_group->add_field( $prix );


//Taxonomie Type de lit
$type_lit = new Field\Multitaxonomy( __( 'Type de lit', 'type_lit', 'type_lit' ) );
$type_lit->allow_save_terms();
$type_lit->set_taxonomies( [ 'type_lit' ] );
$type_lit->set_field_type('radio');

$field_group->add_field( $type_lit );



//Taxonomie gamme de prix
/** 
 * Pas vraiment besoin finalement, puisque traitement de la gamme de prix en finction du prix dans gestion-chambres.php
 * 
 * 
 * $gamme_prix = new Field\MultiTaxonomy( __( 'Gamme de prix', 'gamme_prix', 'gamme_prix'));
 * $gamme_prix->set_taxonomies( [ 'gamme_prix' ] );
 * $gamme_prix->set_field_type('radio');
 * $field_group->add_field( $gamme_prix );
*/

