<?php
include_once'../../Config.php';

session_start();
session_destroy();
header('Location: ../../index.php');
