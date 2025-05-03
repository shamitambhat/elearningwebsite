<?php
session_start();
session_unset();
session_destroy();
header('Location: login.html?message=You%20have%20been%20signed%20out');
exit();
