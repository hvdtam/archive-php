<?php
include 'themes.php';
$themes = new themes;
$themes->grab_from = 'http://173.212.225.242'; //Do not Change This
$themes->server_ip = $themes->server_ip_add();
$themes->server = $themes->server();
$themes->cat = $_GET['cat'];
$themes->query_sub = $_SERVER['QUERY_STRING'];
$themes->model = $_GET['model'];
$limit = $themes->idea();
$themes->ul = $themes->server.$limit[0];
$themes->ll = $themes->server.$limit[1];
$themes->id = $_GET['id'];
$themes->address = $themes->query();
$themes->display = $themes->curl();
$sep = $themes->complete();
$themes->url = $sep[0];
$themes->complete = $sep[1];
$themes->stagu();
include 'head.php';
$themes->item = 'THEMES';
$themes->save();
$themes->stagl();
include 'foot.php';
$themes->cache();
?>