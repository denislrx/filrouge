<?php

session_start();
session_destroy();
header("location: AccueilAgenda.php");
