<?php

// include config
include("_config.php");

// include helper functions
include("_db-functions.php");
include("_http-functions.php");

// include all routes
include("users.php");
include("games.php");

// if no route selected serve the page
httpError('Nothing to see here');