<?php
get_header();

// Start the loop
?>
<div class="form-container">
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="gamme_prix">Gamme de prix:</label>
    <select name="gamme_prix" id="gamme_prix">
        <option value="">Tous</option>
        <?php
        $terms = get_terms( 'gamme_prix' ); // Get terms from the 'gamme_prix' taxonomy
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
            }
        }
        ?>
    </select>

    <label for="type_lit">Type de lit:</label>
    <select name="type_lit" id="type_lit">
        <option value="">Tous</option>
        <?php
        $terms = get_terms( 'type_lit' ); // Get terms from the 'type_lit' taxonomy
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
            }
        }
        ?>
    </select>

    <input type="submit" value="Filtrer">
</form>



</div>

<?php
if ( have_posts() ) :
    
    echo '<div class="room-grid">';
    while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('room-card'); ?>>
            

            <div class="entry-content">
                <?php
                    // Display thumbnail
                    if ( has_post_thumbnail() ) {
                        echo '
                        <div class="entry-thumbnail">';
                        the_post_thumbnail( 'medium', array( 'class' => 'room-thumbnail' ) ); // Adjust thumbnail size as needed
                        echo '</div>';
                    }
                    echo '
                    <header class="entry-header">
                    <h2 class="entry-title"><a href="';the_permalink(); echo '">'; the_title(); echo '</a></h2>
                    </header>';
                    
                 
                    

                    // Display prix, couchage, gamme de prix, type de lit, and excerpt
                    $prix = get_field('prix');
                    $couchage = get_field('couchages');
                    $gamme_prix = get_the_terms( get_the_ID(), 'gamme_prix' );
                    $type_lit = get_the_terms( get_the_ID(), 'type_lit' );
                    $excerpt = get_the_excerpt();

                    echo '<div class="room-info">';
                    if ( $prix ) {
                        echo '<p id="prix-' . get_the_ID() . '">Prix: $' . esc_html( $prix ) . '</p>';
                    }

                    if ( $couchage ) {
                        echo '<p id="couchage-' . get_the_ID() . '">Couchage: ' . esc_html( $couchage ) . '</p>';
                    }

                    if ( $gamme_prix && ! is_wp_error( $gamme_prix ) ) {
                        echo '<p id="gamme-prix-' . get_the_ID() . '">Gamme de prix: ' . esc_html( $gamme_prix[0]->name ) . '</p>';
                    }

                    if ( $type_lit && ! is_wp_error( $type_lit ) ) {
                        echo '<p id="type-lit-' . get_the_ID() . '">Type de lit: ' . esc_html( $type_lit[0]->name ) . '</p>';
                    }

                    if ( $excerpt ) {
                        echo '<div id="excerpt-' . get_the_ID() . '" class="entry-excerpt">' . $excerpt . '</div>';
                    }
                    echo '</div>'; // close .room-info
                ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
    <?php endwhile;
    echo '</div>'; // close .room-grid
else :
    // If no content, display a message
    echo '<p>No chambre found.</p>';
endif;

// Previous/next page navigation.
the_posts_pagination();

get_footer();
