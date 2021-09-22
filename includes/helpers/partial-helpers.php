<?php

/**
 * Print page header content
 * @param  string $content HTML content to appear as page title.
 * @return null
 */
function the_page_header( $content ) {
  echo '
	<header class="project-header">
		<div class="badge-page">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="main-text">';
  echo "<h1>{$content}</h1>";
  echo '</div>';
}
function the_page_header_project( $content ) {
  echo '
	<header class="project-header">
		<div class="badge-page">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="main-text">';
  echo "<h1>{$content}</h1>";
  echo '</div>';
}

