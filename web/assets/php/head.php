<head>
  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$config['analytics_id']?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?=$config["analytics_id"]?>');
  </script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="theme-color" content="#333">

  <title><?=$web_data["site"]["title"]?><?=isset($page_title)? ' | '.$page_title : NULL?></title>
  <meta name="description" content="<?=$web_data["site"]["meta_description"]?> <?=isset($meta_desc)? ' | '.$meta_desc : NULL?>">
  <meta name="keywords" content="<?=$web_data["site"]["meta_keywords"]?>">
  <?php
    if(isset($item)){
      include $_SERVER['DOCUMENT_ROOT'].'/web/includes/item_meta_data.php';
    }
  ?>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="/web/assets/css/preload.min.css">
  <link rel="stylesheet" href="/web/assets/css/plugins.min.css">
  <link rel="stylesheet" href="/web/assets/css/style.light-blue-500.min.css">
  <link rel="stylesheet" href="/web/assets/css/website_custom.css">
  <link rel="stylesheet" href="/web/assets/css/bgg_widget.css">
  <link rel="stylesheet" href="/web/assets/css/army_list.css">
  <link rel="stylesheet" href="/web/assets/css/goodreads_widget.css">
  <link href="/web/assets/css/all.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="/web/assets/js/html5shiv.min.js"></script>
    <script src="/web/assets/js/respond.min.js"></script>
  <![endif]-->

  <script src="/vendor/tinymce/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea.tinymce',
      theme: "silver",
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
      ],
      toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
      toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",

      external_filemanager_path:"/web/assets/responsive_filemanager/filemanager/",
      filemanager_title:"Responsive Filemanager" ,
      filemanager_access_key:"<?=$config['filemanager_key']?>" ,
      external_plugins: { "filemanager" : "/web/assets/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js"}
    });
  </script>

  <link rel="apple-touch-icon" sizes="57x57" href="/web/assets/icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/web/assets/icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/web/assets/icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/web/assets/icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/web/assets/icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/web/assets/icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/web/assets/icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/web/assets/icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/web/assets/icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/web/assets/icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/web/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/web/assets/icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/web/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="/web/assets/icons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/web/assets/icons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <script src="https://kit.fontawesome.com/<?=$config["font_awesome_code"]?>.js" crossorigin="anonymous"></script>
</head>
