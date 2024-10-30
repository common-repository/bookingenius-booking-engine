<?php

namespace Begenius;

class PluginConfiguration
{
  protected static $configuration;
  protected static $curr_plugin;
  public static function load($plugin_dir)
  {    
    $plugin_dir_name = \substr(strrchr(substr($plugin_dir, 0, -1), '/'), 1);    
    
    static::$curr_plugin = $plugin_dir_name;
    
    $config = require_once $plugin_dir . 'config' . DIRECTORY_SEPARATOR . 'plugin.php'; 
    static::$configuration[$plugin_dir_name] = $config;
  }
  
  public static function get($key)
  {    
   
    $path = \plugin_dir_path( __DIR__ );
    
    $matches = [];
    $res = \preg_match('/wp-content\/plugins(\/[a-zA-Z0-9\-]*\/)/', $path, $matches);
    $plugin_dir_name = \substr($matches[1], 1, -1);
   
    return isset(static::$configuration[static::$curr_plugin][$key]) ? static::$configuration[$plugin_dir_name][$key] : null;
  }      
}