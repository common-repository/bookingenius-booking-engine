<?php

namespace Begenius;

use Begenius\BG_PluginOption;

class CheckboxOption extends PluginOption
{

  public function __construct($name, $configuration)
  {
    if (isset($configuration['value'])) {
      $this->value = $configuration['value'];
    }
    return parent::__construct($name, $configuration);
  }

  public function render()
  {
    return <<<EOT
      <input type="checkbox" name="$this->name" id="$this->name" />
EOT;
  }
}
