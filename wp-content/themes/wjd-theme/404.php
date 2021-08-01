<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 */

get_header();
?>

<main id="site-content" role="main">

	<div class="section-inner thin error404-content container">

		<h1 class="entry-title"><?php _e( 'Die Seite konnte nicht gefunden werden', 'wjd' ); ?></h1>

		<div class="intro-text"><p><?php _e( 'Die gesuchte Seite konnte nicht gefunden werden. Sie wurde möglicherweise entfernt, umbenannt oder existierte von vornherein nicht.', 'wjd' ); ?></p></div>
	</div>

</main>
<?php
get_footer();
