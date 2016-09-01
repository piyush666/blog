<?php
/*logout page*/
session_start();
session_destroy();
header("location:../ST3/");
?>