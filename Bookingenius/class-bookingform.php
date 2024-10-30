<?php

namespace Bookingenius;

use Begenius\Plugin;
use Bookingenius\CalendarSkin;

class BookingForm
{

  protected $plugin;
  private $_config;

  public function __construct(Plugin $plugin, $config)
  {
    $this->_config = $config;
    $this->plugin = $plugin;
  }


  public function render()
  {
    \extract(\shortcode_atts(array(
        'hotelName' => get_option('bookingenius_hotel_id'),
        'test' => false,
            ), $this->_config));

    $this->plugin->options('bookingenius_icon_pos')->load();

    $this->plugin->options('bookingenius_button_label')->load();

    $this->plugin->options('bookingenius_form_sticky')->load();

    $this->plugin->options('bookingenius_form_orientation')->load();

    $this->plugin->options('max_adults')->load();

    $this->plugin->options('max_children')->load();

    $this->plugin->options('bookingenius_form_labels')->load();
    $this->plugin->options('bookingenius_form_labels')->value = unserialize($this->plugin->options('bookingenius_form_labels')->value);

    $plugin = $this->plugin;

    // Imposta il locale di php per visualizzare
    // le date nel formato corretto
    \setlocale(LC_TIME, get_locale());

    $from = strftime("%d %b %G", strtotime('today'));
    $to = strftime("%d %b %G", strtotime('tomorrow'));

    // Il form html
    require_once $this->plugin->dir() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'form.php';
  }

}
