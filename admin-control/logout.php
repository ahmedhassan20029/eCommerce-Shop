<?php
    // page logout system
    session_start();

    session_unset();

    session_destroy();

    exit();