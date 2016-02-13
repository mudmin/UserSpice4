<?php
session_start();

function env($type='server'){
  if($type == 'server'){
    if($_SERVER['HTTP_HOST'] == 'localhost'){
      return $_SERVER['DOCUMENT_ROOT'].
