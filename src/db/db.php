<?php

// TODO: check sulle variabili d'ambiente

$CONNECTION_STRING = "mysql:host=localhost;dbname=" . getenv('DB_NAME');

return new PDO($CONNECTION_STRING, getenv('DB_USER'), getenv('DB_PASSWD'));