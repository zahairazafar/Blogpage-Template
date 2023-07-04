<?php

// Template Name: Blog Template 

// Removes the standard loop > 'genesis loop ' it works same way as the WordPress loop in the sense that it loops through posts and pages to display content.

//remove_action('genesis_loop','genesis_do_loop');

// Add action adds the content after the assigned genesis hook > kindly visit https://genesistutorials.com/visual-hook-guide/ 

add_action('genesis_entry_content','blog_template_init');

function blog_template_init(){ ?>

<h1>Blog Posts</h1>
                              
<?php
// set $post globally so that we can access from anywhere 
global $post;

$blog_array = array(
'post_type' => 'post',
'posts_per_page' => 3 ,
'paged'          => get_query_var( 'paged' )  /* used for pagination */
);

// we'll use wp_query over here to override the existing one , otherwise pagination functionality won't work 
                              
global $wp_query;
$wp_query = new WP_Query($blog_array);

if($wp_query ->have_posts()){ ?>
<div class="blog-container">
	<?php while($wp_query ->have_posts()){
		$wp_query ->the_post(); ?>
<!-- 		content  -->
		<div class="blogp-card">
			<div class="blogp-thumbnail"><?php the_post_thumbnail( ); ?></div>
			<div class="blog-cardbody">
 <!--------- To get clickable categories -->
        
<?php	$cat_terms = get_the_terms(get_the_ID(), 'category');
  
		$term_names = array();
		if ($cat_terms) {
			foreach ($cat_terms as $term) {
				$term_names[] = '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
			}	}	?>
      
<!-- in simple words implode is used to add , whatever we write in the string like here we are using comma to display categories like abc,xyx,ghj  -->
        
		<p class="blog-cat"><?php echo implode(', ', $term_names); ?></p>

		<!-- categories end  -->
        
<h1 class="blogp-title"><a href='<?php the_permalink(); ?>'> <?php the_title();  ?></a> </h1>
<!--         to display limited excerpt content  -->
<p class="blogp-excerpt"> <?php echo wp_trim_words( get_the_excerpt(), 27, '...' ); ?> </p> 
</div></div>
<?php 
}?>
</div> 
<?php
do_action( 'genesis_after_endwhile' );
wp_reset_query();
}?>

<?php } 
// it is compulsory to write in genesis theme as it is used to display header & footer in genesis 
genesis();

?>




