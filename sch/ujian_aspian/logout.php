<?php
require "utils.php";

start();
session_destroy();

header("location: login.php");