<?php

get_header();


$args = array(
    'posts_per_page'    => 6,
    'post_type'     => 'chambre',  //choose post type here
    'order' => 'DESC',
);

$link = get_post_type_archive_link('chambre');

$the_query = new WP_Query( $args );
?>




<div class="presentation">
<h1 class="presentation-title">Le Manoir d'Élégance</h1>
<p class="presentation-desc">
Séjournez dans le luxe et l'histoire

Au cœur d'un domaine majestueux, niché dans un écrin de verdure, se trouve le Manoir d'Élégance. Cet établissement prestigieux offre une expérience hôtelière unique, alliant raffinement, culture et confort absolu.

Dès votre arrivée, vous serez séduit par l'architecture imposante du manoir, datant du XIXe siècle, et par ses jardins à la française parfaitement entretenus. À l'intérieur, le charme d'antan se mêle à des installations modernes, offrant un cadre incomparable pour un séjour inoubliable.

Le Manoir d'Élégance propose une sélection de chambres et de suites, chacune ornée d'une décoration raffinée et inspirée d'une époque dorée de l'histoire. De la Renaissance italienne à la Belle Époque française, chaque hébergement offre un voyage à travers le temps, tout en garantissant un confort contemporain.

Nos clients peuvent se détendre dans nos espaces communs élégamment aménagés, tels que notre salon bibliothèque où des œuvres littéraires classiques côtoient des antiquités rares. Pour les amateurs de gastronomie, notre restaurant gastronomique propose une cuisine raffinée mettant en valeur les produits locaux de saison, dans un cadre d'exception.

Que vous soyez en quête d'une escapade romantique, d'un séjour culturel ou d'un événement privé, le Manoir d'Élégance saura vous combler. Notre équipe dévouée est à votre disposition pour répondre à tous vos besoins et vous offrir une expérience sur mesure, digne des plus grands palais.

Venez découvrir le charme intemporel du Manoir d'Élégance et laissez-vous envoûter par son atmosphère unique, où luxe et histoire se rencontrent pour créer des souvenirs inoubliables.
</p>

</div>

<div class="gallery-container">
    <?php
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
    ?>
            <div><?php the_post_thumbnail(); ?></div>
    <?php
        endwhile;
    else :
        // If no posts found
    endif;
    ?>
</div>


<div class="link-container">
<a class="link" href="<?php echo $link ?>">Voir tout </a>
</div>



<div class="contact-wrapper">



<div class="contact">
   <h2>Enchantés par le Manoir d'élégance ? </h2>
   <h3>Contactez nous !</h3>

   <div class="contact-details">
    <span>manoirelegance@contact.fr</span>
    <span>0321212121</span>
   </div>
 </div>
 </div>

<?php get_footer() ?>