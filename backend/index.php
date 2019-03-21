<?php

// include config
include("_config.php");

// include db functions
include("_db-functions.php");

// include all routes
include("users.php");
include("games.php");

// if no route selected serve the page
include("../frontend/index.html");