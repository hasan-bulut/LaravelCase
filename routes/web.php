<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/error/{type}', function ($type) {
  if($type=="banned"){
    echo "Buraya erişiminiz yasaklandı!";
  }else if($type=="noKey"){
    echo "Buraya erişmenize izin verilmiyor.";
  }
});