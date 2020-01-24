<?php

// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>
<meta http-equiv="refresh" content="0;url=<?=$web_data['site']['url']?>">
