<?php
function pg($page="")
{
    print "?".trim(http_build_query($_GET)."&".$page, "&");
}
