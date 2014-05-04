<?php
/*
Plugin Name: Codeblocks
Plugin URI: http://www.z43studio.com
Description: Add formatted code blocks into your blog posts using shortcodes.
Version: 1.0.1
Author: z43 Studio
Author URI: http://www.z43studio.com
License: GPL2
*/

include 'system.php';


define('CODEBLOCKS', __FILE__);
define('CODEBLOCK_LANG', 'codeblocks');

$codeblocks = new Codeblocks();

?>