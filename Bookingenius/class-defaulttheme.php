<?php

namespace Bookingenius;

use Begenius\DynamicCss;

class DefaultTheme extends DynamicCss
{
  protected $id = 'bookingenius-bookingenius-custom-css';

  protected function content()
  {
    $dark_primary_color = $this->plugin->options('custom_styles')->get('dark_primary_color')->value;

    return <<<EOT
        /* Form */
        #bgform form label, #bg-form-mobile form label, #bg-booking-popover form label,
        #bgform form button {
          font-family: {$this->plugin->options('form_styles')->get('font_family')->value}!important;
          color: {$this->plugin->options('form_styles')->get('label_color')->value}!important;
        }

        #bgform form button,
        #bgform form input,
        #bgform form select,
        #bgform form .bg-booking-select,
        #bgform form #bg-room-guests {
          font-family: {$this->plugin->options('form_styles')->get('font_family')->value}!important;
          color: {$this->plugin->options('form_styles')->get('controls_color')->value}!important;
          border: {$this->plugin->options('form_styles')->get('controls_border_width')->value} solid {$this->plugin->options('form_styles')->get('controls_border_color')->value}!important;
        }

        #bgform form button {
          color: {$this->plugin->options('form_styles')->get('button_text_color')->value}!important;
          background-color: {$this->plugin->options('form_styles')->get('button_background_color')->value}!important;
        }

        #bgform form .bg-booking-append,
        #bgform form .bg-booking-select:after{
          color: {$this->plugin->options('form_styles')->get('icons_color')->value}!important;
        }

        #bgform .bg-booking-select {
            border: 0;
            height: 42px;
            line-height: 42px;
            font-size: inherit;
            font-family: inherit;
            background-color: #FFFFFF;
            font-family: {$this->plugin->options('form_styles')->get('font_family')->value}!important;
        }

        #bgform .bg-booking-select:after {
            color: #5E5E5E!important;
        }



        #bg-form-mobile {
          background-color: #FFFFFF;
          font-family: {$this->plugin->options('form_styles')->get('font_family')->value}!important;
        }


        #bg-form-mobile a {
          color: {$this->plugin->options('custom_styles')->get('primary_color')->value}!important;
          text-decoration: none;
          font-family: {$this->plugin->options('form_styles')->get('font_family')->value}!important;
          font-weight: bold;
          font-size: 20px;
        }

        #bg-form-mobile .bg-booking-append,
        #bg-form-mobile .bg-booking-select:after {
          color: {$this->plugin->options('form_styles')->get('icons_color')->value}!important;
        }

        #bg-booking-icon {
          background-color: {$this->plugin->options('custom_styles')->get('dark_primary_color')->value}!important;
        }

        #bg-form-mobile input,
        #bg-form-mobile select,
        #bg-form-mobile #bg-room-guests {
            border: 1px solid #EAEAEA!important;
            background-color: #FFFFFF;
            color: {$this->plugin->options('custom_styles')->get('text_color')->value}!important;
        }

        #bg-form-mobile label {
            color: {$this->plugin->options('custom_styles')->get('dark_primary_color')->value}!important;
            font-family: sans-serif;
            font-style: normal;
            font-size: 11px;
            margin: 10px 0 2px 0!important;
        }

        #bg-form-mobile button {
            background-color: {$this->plugin->options('custom_styles')->get('dark_primary_color')->value}!important;
            border: 0;
            font-style: normal!important;
            color: #FFFFFF;
        }

        #bgform button {
            color: #FFFFFF;
            background-color: #3E3A31;
        }


        .bg-booking-select:after {
          color: {$this->plugin->options('custom_styles')->get('primary_color')->value}!important;
        }

        .bg-booking-tabs ul.bg-booking-nav li a,
        .bg-booking-select,
        .bg-booking-menu {
          color: {$this->plugin->options('custom_styles')->get('text_color')->value};
        }
        
        .bg-booking-menu ul {
          overflow: hidden;
        }

        .bg-booking-tabs ul.bg-booking-nav li {
            border-color: {$this->plugin->options('custom_styles')->get('dark_primary_color')->value}!important;
        }


        /* Multicamera */

        .webui-popover {
          border-radius: 0!important;
          webkit-box-shadow: 0px 5px 6px 0px rgba(100, 100, 100, 0.38) !important;
          -moz-box-shadow: 0px 5px 6px 0px rgba(100, 100, 100, 0.38) !important;
          box-shadow: 0px 5px 6px 0px rgba(100, 100, 100, 0.38) !important;
        }

        .webui-popover .bg-booking-tabs ul.bg-booking-nav li {
            border-color: {$this->plugin->options('multi_room_styles')->get('multi_room_dark_primary_color')->value}!important;
        }

        .webui-popover label {
            color: {$this->plugin->options('multi_room_styles')->get('multi_room_dark_primary_color')->value}!important;
        }

        .webui-popover .bg-booking-select:after {
            color: {$this->plugin->options('multi_room_styles')->get('multi_room_primary_color')->value}!important;
        }

        .bg-booking-menu {
          font-family: {$this->plugin->options('form_styles')->get('font_family')->value}!important;
        }

        .webui-popover label,
        .webui-popover ul.bg-booking-nav,
        ul.bg-booking-menu-popover,
        .webui-popover .bg-booking-select {
          font-family: {$this->plugin->options('multi_room_styles')->get('multi_room_font_family')->value}!important;
        }
EOT;
  }


}
