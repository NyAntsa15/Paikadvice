<?php
    require('includes/autoloader.inc.php');

    $usr = new User();
    $usr->unset_all_current_session();
    