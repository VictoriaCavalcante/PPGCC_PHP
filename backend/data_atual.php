<?php

    header('Content-Type: application/json');

    $res = ['dia'=>date('d'),'mes'=>date('m'),'ano'=>date('Y')];


    echo json_encode($res);
