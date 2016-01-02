<?php

define("DEVELOPMENT_MODE_LOCAL", 0);
define("DEVELOPMENT_MODE_STAGING", 1);
define("DEVELOPMENT_MODE_PRODUCTION", 2);
define("DEVELOPMENT_MODE", DEVELOPMENT_MODE_LOCAL);

if(DEVELOPMENT_MODE == DEVELOPMENT_MODE_LOCAL)
{
    require_once __DIR__ . "/local.php";
}
elseif(DEVELOPMENT_MODE == DEVELOPMENT_MODE_STAGING)
{
    require_once __DIR__ . "/staging.php";
}
else
{
    require_once __DIR__ . "/production.php";
}
