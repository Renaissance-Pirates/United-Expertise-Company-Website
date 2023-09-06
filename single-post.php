<?php 

/*
	* Template Name: Blog Post
	* Template Post Type: post
*/

get_header (); 

?>

<?php $Language = array_map (fn ($Value): String => $Value -> name, get_the_category ()) [0]; ?>

<?php
	while (have_posts ()) 
	{
		the_post ();
		?>
		<article class="Blog_Container Padding_4rem Background_Color_1">
			<h1 class="<?php echo $Language == 'Arabic' ? 'Arabic_Header' : '' ?>"><?php the_title (); ?></h1>
			<div class="<?php echo $Language == 'Arabic' ? 'Arabic_Text' : '' ?>"><?php the_content (); ?></div>
		</article>
		<?php
	}
?>

<?php get_footer(); ?>