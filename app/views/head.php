<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$title?></title>

<meta name="twitter:card" content="summary" />
<meta property="og:title" content="<?=$title?>">
<meta name="twitter:title" content="<?=$title?>">
<meta name="revisit-after" content="1 days" />
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="description" content="<?=isset($description) ? $description : ''?>" />
<meta property="og:description" content="<?=isset($description) ? $description : ''?>" />
<meta name="twitter:description" content="<?=isset($description) ? $description : ''?>" />
<meta property="og:image" content="<?=isset($thumb) ? $thumb : ''?>" />
<meta property="og:image:secure_url" content="<?=isset($thumb) ? $thumb : ''?>" />
<meta property="og:image:width" content="600" />
<meta property="og:image:height" content="500" />
<meta name="twitter:image" content="<?=isset($thumb) ? $thumb : ''?>" />
<meta property="og:url" content="<?=URL . $_SERVER['REQUEST_URI']?>" />
<link rel="canonical" href="<?=URL . $_SERVER['REQUEST_URI']?>" />
<meta name="twitter:creator" content="@ashion" />
<meta property="og:site_name" content="ashion" />
<meta name="copyright" content="Copyright © 2021 by doan.test" />
<meta property="og:type" content="website" />

<!--Load Bootstrap 4.6 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!--Load Thư Viện icon font awsome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- Load file css-->
<link rel="stylesheet" href="/public/css/style.css?v=<?=time()?>">   