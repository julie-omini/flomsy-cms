<?php
session_start();
date_default_timezone_set('Europe/Paris');
define("__root__", dirname(__FILE__)."/");

include "./sys/class/CMS.php";
new CMS();