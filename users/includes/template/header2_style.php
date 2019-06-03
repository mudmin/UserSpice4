<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- AKA Primary CSS -->
<link href="<?=$us_url_root?><?=str_replace('../','',$settings->us_css1);?>" rel="stylesheet">

<!-- Template CSS -->
<!-- AKA Secondary CSS -->
<link href="<?=$us_url_root?><?=str_replace('../','',$settings->us_css2);?>" rel="stylesheet">

<!-- Table Sorting and Such -->
<link href="<?=$us_url_root?>users/css/datatables.css" rel="stylesheet">

<!-- Your Custom CSS Goes Here and will override everything above this!-->
<link href="<?=$us_url_root?><?=str_replace('../','',$settings->us_css3);?>" rel="stylesheet">

<!-- Custom Fonts/Animation/Styling-->
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<!-- jQuery Fallback -->
<script type="text/javascript">
if (typeof jQuery == 'undefined') {
  document.write(unescape("%3Cscript src='<?=$us_url_root?>users/js/jquery.js' type='text/javascript'%3E%3C/script%3E"));
}
</script>

<?php require_once $abs_us_root.$us_url_root.'usersc/includes/bootstrap_corrections.php'; ?>
</head>
<body class="nav-md">
