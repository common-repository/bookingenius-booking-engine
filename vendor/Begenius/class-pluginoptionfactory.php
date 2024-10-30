<?php

namespace Begenius;

use Begenius\TextOption;
use Begenius\DropdownOption;
use Begenius\MultipleOptions;
use Begenius\LongTextOption;
use Begenius\ColorOption;
use Begenius\CheckboxOption;

class PluginOptionsFactory
{
  const TEXT='text';
  const LONGTEXT='longtext';
  const DROPDOWN='dropdown';
  const MULTIPLE='multiple';
  const COLOR='color';
  const CHECKBOX='checkbox';

  public static function create($name, $configuration)
  {
    $type = $configuration['type'];
print_r($type);
    switch($type) {
      case self::TEXT:
        return new TextOption($name, $configuration);
        break;
      case self::LONGTEXT:
        return new LongTextOption($name, $configuration);
        break;
      case self::DROPDOWN:
        return new DropdownOption($name, $configuration);
        break;
      case self::MULTIPLE:
        return new MultipleOptions($name, $configuration);
        break;
      case self::COLOR:
        return new ColorOption($name, $configuration);
      case self::CHECKBOX:
        return new CheckboxOption($name, $configuration);
    }
  }
}
