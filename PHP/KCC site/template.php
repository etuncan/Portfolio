<!DOCTYPE html>
<html>
	<head>
		<title>Kit+Crow</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="preload" as="style" type="text/css" href="./theme/fonts.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="preconnect" href="https://fonts.googleapis.com">	
		<link rel="stylesheet" type="text/css" href="./theme/heading.css">
		<link rel="stylesheet" type="text/css" href="./theme/theme.css">
		<link rel="stylesheet" type="text/css" href="./theme/fonts.css">
		<link rel="stylesheet" type="text/css" href="./theme/about.css">
		<?php $query=htmlentities($_SERVER['QUERY_STRING']);
				parse_str(html_entity_decode($query), $arr);
				$arr=filter_var_array($arr,FILTER_SANITIZE_ENCODED);
				extract($arr);
		?>
		<link rel="stylesheet" type="text/css" href="./pages/<?php echo $page;?>.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Open+Sans:wght@300;400;500&family=Coda:wght@300;400;500&display=swap">
		<link rel="icon" href="./images/favicon.png">
	</head>
	<body>
		<div id="container">
			<?php include("./theme/header.html");?>
			<?php include("./pages/$page.html");?>
			<?php include("./theme/footer.html"); ?>
			
		</div>
		<script type="text/javascript" src="./functions/JavaScript/general.js"></script>
	</body>
</html>