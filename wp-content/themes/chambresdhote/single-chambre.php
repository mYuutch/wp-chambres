<?php   
get_header();

$gamme_prix = get_the_terms( get_the_ID(), 'gamme_prix' );
$type_lit = get_the_terms( get_the_ID(), 'type_lit' );
?>


<div class="single-container">

<div class="single-thumbnail"><?php the_post_thumbnail() ?></div>


<div class="single-details">
<h1 class="single-title"><?php the_title()?></h1>
<?php the_content() ?>

<div class="single-numbers">
<p><?php the_field('couchages'); ?>  <span>couchages</span> </p>
<p class="text-4xl text-red-500"><?php the_field('prix'); ?> $  <span>nuit/pers.</span></p>
<p><?php echo( $gamme_prix[0]->name ); ?> <span>gamme de prix</span></p>
<p><?php echo($type_lit[0]->name ); ?> <span>type de lit</span></p>

</div> 

</div>

</div>



