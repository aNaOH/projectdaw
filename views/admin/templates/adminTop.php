<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="/admin/img/icons/icon-48x48.png" />

	<title>Blank Page | Admin</title>

	<link href="/assets/admin/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<?php

	if (isset($styles)) {
		foreach ($styles as $style) {
	?> <link href="<?=$style?>" rel="stylesheet"/> <?php
		}
	}

	?>
</head>

<body>
	<div class="wrapper">
		<?php include('./views/admin/partials/sidebar.php') ?>

		<div class="main">
			
			<?php include('./views/admin/partials/navbar.php') ?>

			<main class="content">
				<div class="container-fluid p-0">