<?php

$conn = mysqli_connect("localhost", "root", "", "online");

if(mysqli_connect_errno()){
  printf("Connection failed: %s\n", mysqli_connect_error());
  exit();
}