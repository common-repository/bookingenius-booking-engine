<?php

namespace Bookingenius;

use Begenius\DynamicCss;

class CalendarSkin extends DynamicCss
{

  protected $id = 'bookingenius-calendar-css';

  protected function content() {
    return <<<EOT

    /* Reset degli stili del datepicker di jqueryui */
    #ui-datepicker-div {
      margin: auto!important;
      width: auto!important;
      max-width: 350px!important;
    }

    .ui-datepicker,
    .ui-widget,
    .ui-widget-content,
    .ui-helper-clearfix,
    .ui-corner-all,
    .ui-datepicker-header,
    .ui-widget-header,
    .ui-helper-clearfix,
    .ui-datepicker-prev,
    .ui-datepicker-next
    .ui-corner-all,
    .ui-state-disabled,
    .ui-corner-all {
      border-radius: 0!important;
      margin: auto!important;
      border: none!important;
      background-color: default!important;
      background-image: none!important;
      background-size: 100%;
      background-repeat: no-repeat;
      font-weight: normal!important;
      color: #000000!important;
    }

    .ui-datepicker table tbody td a {
      text-decoration: none!important;
      text-align: center!important;
      font-weight: normal!important;
    }

    .ui-datepicker table {
      display: table!important;
    }

    .ui-datepicker table > thead,
    .ui-datepicker table > tbody,
    .ui-datepicker table > tfoot{
      display: table-header-group!important;
      width: auto!important;
    }

    .ui-datepicker table > thead > th, td,
    .ui-datepicker table > tbody > th, td,
    .ui-datepicker table > tfoot > th, td {
      display: table-cell!important;
      text-align: center!important;
    }

    .ui-datepicker td > span {
      border: none!important;
      background-color: default!important;
      background-image: none!important;
      background-size: 100%;
      background-repeat: no-repeat;
      font-weight: normal!important;
      color: inherit!important;
      text-align: center!important;
    }

    .ui-datepicker-prev,
    .ui-datepicker-next {
      top: auto!important;
    }
    /* Fine reset degli stili del datepicker di jqueryui */

    .bg-booking-calendar-mobile {
      left: 50%!important;
      margin-left: -152px;
    }

    #ui-datepicker-div {
      display: none;
    }

   .ui-datepicker.bg-booking-calendar {
     font-family: {$this->plugin->options('custom_styles')->get('calendar_font_family')->value};
     background: #FFFFFF;
     padding: 1px;
     border: 1px solid #DEDEDE;
     display: none;
     webkit-box-shadow: 0px 5px 6px 0px rgba(100, 100, 100, 0.38);
     -moz-box-shadow: 0px 5px 6px 0px rgba(100, 100, 100, 0.38);
     box-shadow: 0px 5px 6px 0px rgba(100, 100, 100, 0.38);
     z-index: 99999!important;
   }
   .ui-datepicker-multi-2 {
     width: auto!important;
   }
   .ui-datepicker.bg-booking-calendar {
     /* Table styles reset */
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-group-first {
     float: left;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-group-last {
     float: right;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-header {
     background-color: {$this->plugin->options('custom_styles')->get('primary_color')->value};
     font-size: 20px;
     padding: 15px 10px;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-title {
     color: #FFFFFF;
     line-height: 40px;
     margin: 0 50px;
     text-align: center;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-prev,
   .ui-datepicker.bg-booking-calendar .ui-datepicker-next {
     background-color: transparent;
     padding: 0;
     height: auto;
     width: auto;
     margin: 0;
     padding: 0 20px;
     line-height: 40px;
     position: absolute;
     cursor: pointer;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-prev span,
   .ui-datepicker.bg-booking-calendar .ui-datepicker-next span {
     display: none;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-prev {
     left: 0;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-next {
     right: 0;
   }
   .ui-datepicker.bg-booking-calendar .ui-state-hover {
     color: {$this->plugin->options('custom_styles')->get('dark_primary_color')->value};
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-prev:before {
     content: "\\f104";
     font-family: FontAwesome;
     position: relative;
     color: #FFFFFF;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-next:before {
     content: "\\f105";
     font-family: FontAwesome;
     position: relative;
     color: #FFFFFF;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-next:after {
     content: "";
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-calendar {
     margin: 10px 10px;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-unselectable {
     background-color: #FFFFFF;
     color: #DADADA;
   }
   .ui-datepicker.bg-booking-calendar .ui-datepicker-week-end {
     color: {$this->plugin->options('custom_styles')->get('light_primary_color')->value};
   }


   .ui-datepicker.bg-booking-calendar table,
   .ui-datepicker.bg-booking-calendar caption,
   .ui-datepicker.bg-booking-calendar tbody,
   .ui-datepicker.bg-booking-calendar tfoot,
   .ui-datepicker.bg-booking-calendar thead,
   .ui-datepicker.bg-booking-calendar tr,
   .ui-datepicker.bg-booking-calendar th,
   .ui-datepicker.bg-booking-calendar td,
   .ui-datepicker.bg-booking-calendar a {
     margin: 0;
     padding: 0;
     border: 0;
     outline: 0;
     font-size: 100%;
     vertical-align: baseline;
     background: transparent;
   }
   .ui-datepicker.bg-booking-calendar table {
     width: 280px;
   }
   .ui-datepicker.bg-booking-calendar table thead th {
     font-size: 11px;
     padding: 0;
     margin: 0;
     font-weight: bold;
   }
   .ui-datepicker.bg-booking-calendar table tbody td {
     font-size: 11px;
     padding: 0;
     margin: 0;
     width: 20px;
   }
   .ui-datepicker.bg-booking-calendar table tbody td a,
   .ui-datepicker.bg-booking-calendar table tbody td span {
     margin: 2px;
     padding: 2px;
     width: 20px;
     text-decoration: none;
     display: inline-block;
     color: {$this->plugin->options('custom_styles')->get('text_color')->value};
   }
   .ui-datepicker.bg-booking-calendar table tbody td a.ui-state-active {
     margin-bottom: 0;
     border-bottom: 2px solid {$this->plugin->options('custom_styles')->get('dark_primary_color')->value};
   }
   .ui-datepicker.bg-booking-calendar .ui-state-disabled .ui-state-default,
   .ui-datepicker.bg-booking-calendar .ui-state-disabled .ui-state-default:hover {
     background-color: transparent;
   }
   .ui-datepicker.bg-booking-calendar .ui-state-active {
     color: {$this->plugin->options('custom_styles')->get('primary_color')->value};
   }
   .ui-datepicker.bg-booking-calendar .ui-state-disabled span {
     color: #DEDEDE;
   }


EOT;
  }

  public function render() {
    return $this->content();
  }

}
