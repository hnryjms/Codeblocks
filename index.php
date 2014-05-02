<?php

header("HTTP/1.0 500 Internal Server Error");
header("Content-Type: text/plain");
echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
exit;

?>