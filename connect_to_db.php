<?php

$connect = mysqli_connect(
    'db', # service name
    'root', # username
    'example', # password
    'jbustore_db' # db table
);

if ($connect->connect_errno)
{
    die('Could not connect: ' . $connect->connect_errno);
}

