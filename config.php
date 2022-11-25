<?php

const DB_HOST = 'database';
const DB_NAME = 'lamp';
const DB_USER = 'lamp';
const DB_PASS = 'lamp';

$connect = mysqli_connect(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME
);

if (!$connect) {
    die('Error' . mysqli_connect_error());
}

//echo 'Connected successfully';