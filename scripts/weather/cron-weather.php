<?php
  require_once("pushweather.php");
  require_once("../../lib/common.php");
  $weather = new PushWeather();
  $weather->pushAll();
?>