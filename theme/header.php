<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width">
	<meta name="format-detection" content="telephone=no">
	<meta name="description" content="<?php if (wp_title('', false)): ?><?php bloginfo('name'); ?>の<?php echo trim(wp_title('', false)); ?>のページです。<?php endif; ?><?php bloginfo('description'); ?>">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon.png">
	<?php wp_head(); ?>
</head>

<body>
	<div class="wrap">
		<header class="header">
			<div class="container">
				<h1 class="header--logo">
					<a href="/"><img src="img/common/logo.svg" alt="LOGOTYPE" width="250" height="43" /></a>
				</h1>
				<button id="js-gnav_btn" class="gnav_btn">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<nav id="js-gnav" class="gnav">
					<ul>
						<li><a href="#about">About</a></li>
						<li><a href="#">Message</a></li>
						<li><a href="#">Case</a></li>
						<li><a href="#">Vision</a></li>
						<li><a href="#">Work-shop</a></li>
						<li><a href="#">Voice</a></li>
					</ul>
				</nav>
			</div>
		</header>