<?php
    $url = "https://boardgamegeek.com/xmlapi2/plays?username=RendlyTheFriendly";

    $dom = new DOMDocument();
    $dom->load($url);
    $dom->save('../assets/xml/bgg_plays.xml');

    echo '<meta http-equiv="refresh" content="0;url=/admin/home/">';
?>
<i class="fa fa-refresh"></i>