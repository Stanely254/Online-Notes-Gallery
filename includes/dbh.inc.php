<?php

$conn = mysqli_connect("localhost", "your username", "your password", "your database");

if(mysqli_connect_errno()){
  printf("Connection failed: %s\n", mysqli_connect_error());
  exit();
}
