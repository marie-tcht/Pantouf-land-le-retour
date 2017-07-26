<?php

// Fichier index.php : toujours éxécuté

require('vendor/autoload.php');

// Toujours avec anti slash \
use Shop\FrontController;

// Appelle de la class avec sa propriété static
FrontController::run();
