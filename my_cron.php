<?php 
  if(PHP_SAPI != 'cli') { die('Access denied'); }
  $fd = fopen("/home/snn/www/ins.dev/my_cron.txt","a"); 
  fwrite($fd, "Обращение к файлу - ".date("d.m.Y H:i")."\r\n"); 
  fclose($fd); 
?>