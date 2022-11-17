<?php

$dbconn = pg_connect("host=pg-bd dbname=per user=user password=example")
    or die('Could not connect: ' . pg_last_error());