<?php
// archive.php automatically overrides the archive page if no such template page exist in the child theme 
/*as usual remove the genesis loop functionality & then add */
remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'archive_template_init');

function archive_template_init(){
// here we'll not declare new WP_Query > only if & while loop'll be used 

if ( have_posts() ) { ?>

    <div class="archivecontent-container">
        <?php 
	while ( have_posts() ) {
		the_post(); ?>
        
        <div class="archivep-card">
			<div class="archivep-thumbnail"><?php the_post_thumbnail( ); ?></div>
			<div class="archive-cardbody">
 <!-- categories start  -->
<?php	$cat_terms = get_the_terms(get_the_ID(), 'category');
		$term_names = array();
		if ($cat_terms) {
			foreach ($cat_terms as $term) {
// in case if uh want clickable categories link over here > use the below line 
				// $term_names[] = '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
                 $term_names[] =   $term->name ;
			}	}	?>
		<p class="archive-cat"><?php echo implode(', ', $term_names); ?></p>
		<!-- categories end  -->
<h1 class="archivep-title"><a href='<?php the_permalink(); ?>'> <?php the_title();  ?></a> </h1>
<p class="archivep-excerpt"> <?php echo wp_trim_words( get_the_excerpt(), 27, '...' ); ?> </p> 
</div></div>
		<?php 
	} // end while
} // end if


}

genesis();
?>

