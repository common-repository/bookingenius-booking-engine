<?php

namespace Bookingenius;

use Begenius\Plugin;
use Bookingenius\BookingForm;
use Begenius\Request;
use Bookingenius\CalendarSkin;
use Bookingenius\DefaultTheme;
use Begenius\ConsoleLogger;

class BookingEngine extends Plugin
{
  public $language;

  public function options_page()
  {
    \wp_enqueue_style('bg-bookingenius-admin', $this->url() . 'assets/css/admin/admin.css');

    $plugin = $this;

    $request = Request::from_server();

    if ($request->is_post()) {

      $this->options('custom_styles')->from_request($request);
      $this->options('custom_styles')->save();

      $this->options('multi_room_styles')->from_request($request);
      $this->options('multi_room_styles')->save();

      $this->options('form_styles')->from_request($request);
      $this->options('form_styles')->save();

      $this->options('bookingenius_form_labels')->value = serialize($request->get('bookingenius_form_labels'));
      $this->options('bookingenius_form_labels')->save();

      foreach ($this->options() as $option) {

        if ($option->name !== 'multi_room_styles' &&
            $option->name !== 'custom_styles' &&
            $option->name !== 'form_styles' &&
            $option->name !== 'bookingenius_form_labels' ) {

          $option->value = $request->get($option->name);
          $option->save();
        }
      }
    } else {
      foreach ($this->options() as $option) {
        $option->load();
      }

    }
    require_once $this->_plugin_dir . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin-page.php';
  }

  public function display_form($config)
  {
    $form = new BookingForm($this, $config);

    $form->render();
  }

  protected function get_lang()
  {
    $locale = substr(\get_locale(), 0, 2);
    switch ($locale) {
      case 'de':
      case 'fr':
      case 'es':
      case 'en':
      case 'it':
        return $locale;
      default:
        return \get_option('bookingenius_language');
    }
  }

  public function enqueue_styles()
  {
    $this->options('form_styles')->load();
    $this->options('custom_styles')->load();
    $this->options('multi_room_styles')->load();

    $this->options('bookingenius_form_sticky')->load();
    $this->options('use_theme_calendar_skin')->load();

    // Custom font
    if ($this->options('form_styles')->get('font_family')->value === 'Palanquin' ||
        $this->options('custom_styles')->get('calendar_font_family')->value === 'Palanquin') {

      \wp_enqueue_style('bg-palanquin-font', $this->url() . 'assets/fonts/palanquin/palanquin.css');
    }

    \wp_enqueue_style('bg-booking-form', $this->url() . 'assets/css/form.css');

    \wp_enqueue_style('bg-bookingenius-fontawesome', $this->url() . '/assets/fonts/font-awesome/css/font-awesome.css');

    // Popover
    \wp_enqueue_style('webui-popover', $this->url() . '/assets/plugins/webui-popover/dist/jquery.webui-popover.min.css');

    if ($this->options('use_theme_calendar_skin')->value == '0') {
      $styles = new CalendarSkin($this);
      $calendar_popover_styles = $styles->render();

      \wp_add_inline_style( 'bg-booking-form', $calendar_popover_styles);
    }

    $styles = new DefaultTheme($this);
    $form_styles = $styles->render();

    \wp_add_inline_style( 'bg-booking-form', $form_styles);
  }

  public function enqueue_scripts($atts)
  {
    $lang = $this->get_lang();
    $this->language = $lang;

    $logger = new ConsoleLogger();

    $this->options('bookingenius_hotel_id')->load();
    $this->options('channel_2_label')->load();
    $this->options('channel_3_label')->load();
    $this->options('channel_4_label')->load();


    $logger->log( 'Channel 1: ' . $this->options('bookingenius_hotel_id')->value);
    $logger->log( 'Channel 2: ' . $this->options('channel_2_label')->value);
    $logger->log( 'Channel 3: ' . $this->options('channel_3_label')->value);
    $logger->log( 'Channel 4: ' . $this->options('channel_4_label')->value);

    $booking_channel = '';
    if (isset($atts['chan'])) {
      $booking_channel = $this->options('channel_'.(int)$atts['chan'].'_label')->value;
    }

    // Usa il canale di default anche nel caso in cui
    // venga passato come argomento un canale non valorizzato
    // in configurazione plugin
    if (strlen($booking_channel) === 0) {
      $booking_channel = $this->options('bookingenius_hotel_id')->value;
    }

    $this->options('bookingenius_form_sticky')->load();

    $this->options('bookingenius_hotel_id')->load();

    $this->options('form_styles')->load();

    \wp_enqueue_script('jquery');

    // Moment js
    \wp_enqueue_script('moment-js', $this->url() . 'assets/plugins/moment/moment-with-locales.min.js');

    \wp_enqueue_script('jquery-sticky', $this->url() . 'assets/plugins/sticky/jquery.sticky.js');    

    // Lo script js per la gestione del form
    \wp_enqueue_script('bookingenius-forminit', $this->url() . 'assets/plugins/begenius/forminit.js');

    // Imposta il locale di php per visualizzare
    // le date nel formato corretto
    \setlocale(LC_TIME, get_locale());
    $from = strftime("%d %b %G", strtotime('today'));
    $to = strftime("%d %b %G", strtotime('tomorrow'));


    $widget_config = array(
        'layout' => 'wide',
        'lang' => $lang,
        'startDate' => $from,
        'endDate' => $to,
        'admin_bar_width' => is_admin_bar_showing() ? 32 : 0,
        'booking_channel' => $booking_channel,
        'sticky_form' => $this->options('bookingenius_form_sticky')->value,
        'sticky_form_width' => $this->options('form_styles')->get('sticky_form_width')->value,
        'sticky_breakpoint_1' => $this->options('form_styles')->get('sticky_breakpoint_1')->value,
        'sticky_header_height_to_breakpoint_1' => $this->options('form_styles')->get('sticky_header_height_to_breakpoint_1')->value,
        'sticky_header_height_at_breakpoint_1' => $this->options('form_styles')->get('sticky_header_height_at_breakpoint_1')->value,
        'sticky_breakpoint_2' => $this->options('form_styles')->get('sticky_breakpoint_2')->value,
        'sticky_header_height_at_breakpoint_2' => $this->options('form_styles')->get('sticky_header_height_at_breakpoint_2')->value,
    );

    // Passiamo l'oggetto bgconfig allo script
    // In modo da poter avere tramite js
    // le opzioni presenti in wp-admin
    \wp_localize_script('bookingenius-forminit', 'bgconfig', $widget_config);

    $logger->log( $widget_config, true);

    // Script per la localizzazione del calendario di jQuery UI
    \wp_enqueue_script('jquery-ui-datepicker', '', ['jquery']);
    \wp_enqueue_script('jquery-ui-datepicker-i18n', $this->url() . 'assets/plugins/jqueryui/i18n/datepicker-' . $lang . '.js');


    // Popover
    \wp_enqueue_script('webui-popover', $this->url() . '/assets/plugins/webui-popover/dist/jquery.webui-popover.min.js');


    // Tabs
    \wp_enqueue_script('begenius-tabs', $this->url() . '/assets/plugins/begenius/tabs.js');

    // Select
    \wp_enqueue_script('begenius-select', $this->url() . '/assets/plugins/begenius/select.js');

    // Popover
   \wp_enqueue_script('begenius-popover', $this->url() . '/assets/plugins/begenius/popover.js');

  }
}
