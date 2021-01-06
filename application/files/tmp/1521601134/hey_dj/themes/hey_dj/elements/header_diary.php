<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage();?>">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Custom Fonts -->
<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet' type='text/css'>
<link href="<?php echo $this->getThemePath(); ?>/font-awesome/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<!-- Bootstrap CSS -->
<link href="<?php echo $this->getThemePath(); ?>/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
<!-- Custom CSS -->
<?php echo $html->css($view->getStylesheet('diary.less'))?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php Loader::element('header_required'); ?>

<?php if(id(new User)->isLoggedin()){ ?>
	<style>
	body {
		margin-top: 99px !important;
	}
	.navbar.navbar-default.navbar-fixed-top {
		margin-top: 50px !important;
	}
	</style>
<?php } ?>

</head>

<body>
<div class="<?php echo $c->getPageWrapperClass()?>">
	<div id="skrollr-body">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<?php
					$a = new GlobalArea('global navi');
					$a->display();
				?>
			</div>
		</nav>