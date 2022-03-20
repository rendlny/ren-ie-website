<?php
use Models\BggXml;

$bggXml = New BggXml();
$bggXml->fetchLatestData();
echo '<meta http-equiv="refresh" content="0;url=/admin/home/">';
?>
<i class="fa fa-refresh"></i>