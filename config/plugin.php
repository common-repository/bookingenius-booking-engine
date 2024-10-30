<?php
return [
    'plugin_name' => 'Bookingenius Booking Engine',

    // Il namespace del plugin
    // Deve esistere una cartella omonima nella root del progetto
    'plugin_namespace' => 'Bookingenius',

    'menu_page' => [
        'page_title' => 'BookinGenius',
        'menu_title' => 'BookinGenius',
        'menu_slug' => 'bookingenius',
        'capability' => 'manage_options',
        'icon' => [
            'type' => 'icon',
            'name' => 'dashicons-welcome-learn-more',
        ],
        'position' => null,
    ],
    // Variabili di configurazione runtime
    'config' => [
        'supported_languages' => [
          'en',
          'de',
          'fr',
          'es',
          'pt',
          'ru'
        ],
        'form_labels' => [
          'checkin' => 'Arrivo',
          'checkout' => 'Partenza',
          'guests' => 'Ospiti',
          'rooms' => 'Camere',
          'code' => 'Codice',
          'button' => 'Testo del pulsante',
        ],
        'form_labels_it' => [
          'checkin' => 'Arrivo',
          'checkout' => 'Partenza',
          'guests' => 'Ospiti',
          'rooms' => 'Camere',
          'code' => 'Codice',
          'button' => 'Verifica disponibilità',
        ],
        'form_labels_en' => [
          'checkin' => 'Arrival',
          'checkout' => 'Departure',
          'guests' => 'Guests',
          'rooms' => 'Rooms',
          'code' => 'Code',
          'button' => 'Check availability',
        ],
        'form_labels_de' => [
          'checkin' => 'Ankunft',
          'checkout' => 'Überprüfen',
          'guests' => 'Besucher',
          'rooms' => 'Zimmer',
          'code' => 'Code',
          'button' => 'Verfügbarkeit prüfen',
        ],
        'form_labels_es' => [
          'checkin' => 'llegada',
          'checkout' => 'Salida',
          'guests' => 'Visitantes',
          'rooms' => 'Habitaciones',
          'code' => 'Código',
          'button' => 'Ver disponibilidad',
        ],
        'form_labels_fr' => [
          'checkin' => 'Arrivée',
          'checkout' => 'Consultez',
          'guests' => 'Visiteurs',
          'rooms' => 'Chambres',
          'code' => 'Código',
          'button' => 'Vérifier la disponibilité',
        ],
        'form_labels_pt' => [
          'checkin' => 'Chegada',
          'checkout' => 'Começo',
          'guests' => 'Visitantes',
          'rooms' => 'Quartos',
          'code' => 'Code',
          'button' => 'Verificar disponibilidade',
        ],
        'form_labels_ru' => [
          'checkin' => 'прибытие',
          'checkout' => 'проверять',
          'guests' => 'посетителей',
          'rooms' => 'комнаты',
          'code' => 'код',
          'button' => 'Проверить наличие мест',
        ],
    ],
    // Opzioni plugin salvate sul db
    'options' => [
        'channel_2_label' => [
            'title' => 'Etichetta del canale 2',
            'required' => false,
            'type' => 'text'
        ],
        'channel_3_label' => [
            'title' => 'Etichetta del canale 3',
            'required' => false,
            'type' => 'text'
        ],
        'channel_4_label' => [
            'title' => 'Etichetta del canale 4',
            'required' => false,
            'type' => 'text'
        ],
        'max_adults' => [
          'title' => 'Numero massimo adulti per camera',
          'type' => 'dropdown',
          'required' => true,
          'values' => [
              2 => 2,
              3 => 3,
              4 => 4,
              5 => 5,
              6 => 6,
              7 => 7,
              8 => 8,
              9 => 9,
              10 => 10
          ]
        ],
        'max_children' => [
          'title' => 'Numero massimo bambini per camera',
          'type' => 'dropdown',
          'required' => true,
          'values' => [
              2 => 2,
              3 => 3,
              4 => 4,
              5 => 5,
              6 => 6,
              7 => 7,
              8 => 8,
              9 => 9,
              10 => 10
          ]
        ],
        'bookingenius_hotel_id' => [
            'type' => 'text',
            'required' => 'true',
            'value' => 'hoteldemo'
        ],
        'bookingenius_form_labels' => [
          'type' => 'text',
          'required' => false,
          'value' => '',
        ],
        'bookingenius_button_label' => [
            'type' => 'dropdown',
            'required' => true,
            'values' => [
                'Preventivo' => 'Preventivo',
                'Verifica disponibilità' => 'Verifica disponibilità',
            ],
        ],
        'bookingenius_form_orientation' => [
          'type' => 'dropdown',
            'title' => __('Orientamento del form', 'bookingenius-booking-engine'),
            'required' => true,
            'values' => [
                'horizontal' => __('Orizzontale', 'bookingenius-booking-engine' ),
                'vertical' => __('Verticale', 'bookingenius-booking-engine' ),
            ]
        ],
        'bookingenius_form_sticky' => [
            'type' => 'dropdown',
            'required' => true,
            'values' => [
              '0' => 'No',
              '1' => 'Sì',
            ],
        ],
        'bookingenius_icon_pos' => [
          'title' => 'Posizione icona form mobile',
          'required' => true,
          'type' => 'dropdown',
          'values' => [
              'icon-top-left'      => 'In alto a sinistra',
              'icon-top-center'    => 'In alto centrato',
              'icon-top-right'     => 'In alto a destra',
              'icon-left-center'   => 'A sinistra centrato',
              'icon-right-center'  => 'A destra centrato',
              'icon-bottom-left'   => 'In basso a sinistra',
              'icon-bottom-center' => 'In basso centrato',
              'icon-bottom-right'  => 'In basso a destra',
          ]
        ],
        'form_styles' => [
          'type'   => 'multiple',
          'required' => true,
          'values' => [
              'font_family' => [
                  'title' => 'Font family',
                  'type' => 'dropdown',
                  'required' => true,
                  'values' => [
                      'inherit' => 'Inherited',
                      'sans-serif' => 'Sans serif',
                      'Palanquin' => 'Palanquin',
                  ]
              ],
              'label_color' => [
                  'title' => 'Label color',
                  'type' => 'color',
                  'required' => true,
                  'value' => 'rgba(0,0,0,0.87)'
              ],
              'controls_color' => [
                  'title' => 'Text inside form controls',
                  'type' => 'color',
                  'required' => true,
                  'value' => 'rgba(0,0,0,0.87)'
              ],
              'controls_border_color' => [
                  'title' => 'Controls border color',
                  'type' => 'color',
                  'required' => true,
                  'value' => 'rgba(0,0,0,0.87)'
              ],
              'controls_border_width' => [
                  'title' => 'Controls border width',
                  'type' => 'dropdown',
                  'required' => true,
                  'values' => [
                      '0px' => '0 pixels',
                      '1px' => '1 pixel',
                      '2px' => '2 pixels',
                      '3px' => '3 pixels',
                      '4px' => '4 pixels'
                  ]
              ],
              'icons_color' => [
                  'title' => 'Icons color',
                  'type' => 'color',
                  'required' => true,
                  'value' => 'rgba(0,0,0,0.87)'
              ],
              'button_text_color' => [
                  'title' => 'Button text color',
                  'type' => 'color',
                  'required' => true,
                  'value' => 'rgba(0,0,0,0.87)'
              ],
              'button_background_color' => [
                  'title' => 'Button background color',
                  'type' => 'color',
                  'required' => true,
                  'value' => 'rgba(0,0,0,0.87)'
              ],
              'sticky_form_width' => [
                  'title' => 'Width of the form when sticky',
                  'type' => 'dropdown',
                  'required' => true,
                  'values' => [
                      'auto' => 'Fluid',
                      'same' => 'Same width',
                  ]
              ],
              'sticky_breakpoint_1' => [
                  'title' => 'Breakpoint 1 form fisso (px)',
                  'type' => 'text',
                  'required' => true,
                  'value' => 960
              ],
              'sticky_header_height_to_breakpoint_1' => [
                  'title' => 'Altezza intestazione fino al breakpoint 1 (px)',
                  'type' => 'text',
                  'required' => true,
                  'value' => 0,
              ],
              'sticky_header_height_at_breakpoint_1' => [
                  'title' => 'Altezza intestazione dal breakpoint 1 (px)',
                  'type' => 'text',
                  'required' => true,
                  'value' => 0,
              ],
              'sticky_breakpoint_2' => [
                  'title' => 'Breakpoint 2 form fisso (px)',
                  'type' => 'text',
                  'required' => true,
                  'value' => 768
              ],
              'sticky_header_height_at_breakpoint_2' => [
                  'title' => 'Altezza intestazione dal breakpoint 2 (px)',
                  'type' => 'text',
                  'required' => true,
                  'value' => 0,
              ]
          ]
        ],
        'use_theme_calendar_skin' => [
          'type' => 'dropdown',
          'title' => 'Usa gli stili del tema',
          'required' => true,
          'values' => [
            '0'=> 'No',
            '1' => 'Sì'
          ]
        ],
        'custom_styles' => [
            'type' => 'multiple',
            'required' => true,
            'values' => [
                'calendar_font_family' => [
                    'title' => 'Font family',
                    'type' => 'dropdown',
                    'required' => true,
                    'values' => [
                        'inherit' => 'Inherited',
                        'sans-serif' => 'Sans serif',
                        'Palanquin' => 'Palanquin',
                    ],
                ],
                'primary_color' => [
                    'title' => 'Primary color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#FFC107'
                ],
                'light_primary_color' => [
                    'title' => 'Light primary color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#FFD54F'
                ],
                'dark_primary_color' => [
                    'title' => 'Dark primary color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#FFA000'
                ],
                'text_color' => [
                    'title' => 'Text color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#000000'
                ]
            ]
        ],
        'multi_room_styles' => [
            'type' => 'multiple',
            'required' => true,
            'values' => [
                'multi_room_font_family' => [
                    'title' => 'Font family',
                    'type' => 'dropdown',
                    'required' => true,
                    'values' => [
                        'inherit' => 'Inherited',
                        'sans-serif' => 'Sans serif',
                        'Palanquin' => 'Palanquin',
                        'Playfair Display' => 'Playfair Display'
                    ],
                ],
                'multi_room_primary_color' => [
                    'title' => 'Primary color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#FFC107'
                ],
                'multi_room_light_primary_color' => [
                    'title' => 'Light primary color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#FFD54F'
                ],
                'multi_room_dark_primary_color' => [
                    'title' => 'Dark primary color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#FFA000'
                ],
                'multi_room_text_color' => [
                    'title' => 'Text color',
                    'type' => 'color',
                    'required' => true,
                    'value' => '#000000'
                ]
            ]
        ]
    ],
];
