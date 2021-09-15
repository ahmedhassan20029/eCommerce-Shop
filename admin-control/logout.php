<?php
    // page logout system
    session_start();

    session_unset();

    session_destroy();

    header('location: http://localhost:8080/eCommerce_Shop/admin_control/');

    exit();