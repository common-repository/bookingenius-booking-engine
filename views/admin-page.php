<div class="wrap">
    <div id="icon-options-general" class="icon32"><br /></div>
    <h2>BookinGenius Tool Embedding Page</h2>
    <form method="post">
        <?php wp_nonce_field('update-options'); ?>
        <table>
            <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;"><?php echo __('Etichetta canale principale', 'bookingenius-booking-engine'); ?></td>
                <td style="padding: 5px 5px 7px 5px;">
                    <input name="bookingenius_hotel_id" type="text" id="bookingenius_hotel_id" size=6 maxlength=100 style="width:200px; padding:6px; font-size:16px;"
                           value="<?php echo get_option('bookingenius_hotel_id'); ?>"/>
                    <p class="description">You will find your <b>hotel label</b> into your <a href="https://admin.bookingenius.it">backoffice area</a> under Configuration > Sales Channels.<br/>
                        If you want to test our system, please register yourself at <a href="http://www.begenius.it?utm_campaign=wpplugin&utm_source=adminpage&utm_medium=link">BeGenius</a>.<br/>
                    </p>
                </td>
            </tr>
            <!-- Channels -->
            <tr valign="top">
                <td><?php echo $plugin->options('channel_2_label')->title; ?>:</td>
                <td style="padding: 5px 5px 7px 5px;">
                    <?php echo $plugin->options('channel_2_label')->render(); ?>
                </td>
            </tr>
            <tr valign="top">
                <td><?php echo $plugin->options('channel_3_label')->title; ?>:</td>
                <td style="padding: 5px 5px 7px 5px;">
                     <?php echo $plugin->options('channel_3_label')->render(); ?>
                </td>
            </tr>
            <tr valign="top">
                <td><?php echo $plugin->options('channel_4_label')->title; ?>:</td>
                <td style="padding: 5px 5px 7px 5px;">
                     <?php echo $plugin->options('channel_4_label')->render(); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Per selezionare i canali di vendita, aggiungi allo shortcode del form il parametro chan=numero del canale</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr />
                </td>
            </tr>
            <!-- Channels -->
            <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;"><?php echo gettext('Aggiornamenti automatici'); ?>:</td>
                <td style="padding: 5px 5px 7px 5px;">
                    <select id="bookingenius_language" name="bookingenius_auto_update">
                        <option value="0"><?php echo gettext('No'); ?></option>
                        <option value="1" selected><?php echo gettext('Sì'); ?></option>
                    </select>
                    <p class="description"><?php echo gettext('NON ANCORA SUPPORTATO! Abilita/disabilita gli aggiornamenti automatici del plugin'); ?></p>
                </td>
            </tr>
            <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;">Etichetta pulsante form:</td>
                <td style="padding: 5px 5px 7px 5px;">
                    <?php
                    echo $plugin->options('bookingenius_button_label')->render();
                    ?>
                    <p class="description">
                        Etichetta utilizzata dal pulsante del modulo di Bookingenius
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;">Form sempre visibile:</td>
                <td style="padding: 5px 5px 7px 5px;">
                    <?php
                    echo $plugin->options('bookingenius_form_sticky')->render();
                    ?>
                    <p class="description">
                        Determina se il modulo di prenotazione è sempre visibile sulla pagina oppure no
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <td><?php echo $plugin->options('bookingenius_form_orientation')->title; ?>:</td>
                <td style="padding: 5px 5px 7px 5px;">
                     <?php echo $plugin->options('bookingenius_form_orientation')->render(); ?>
                </td>
            </tr>
            <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;"><?php echo __ ('Numero massimo di adulti per camera', 'bookingenius-booking-engine'); ?></td>
                <td style="padding: 5px 5px 7px 5px;">
                    <?php
                      echo $plugin->options('max_adults')->render();
                    ?>
                </td>
            </tr>
            <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;"><?php echo __ ('Numero massimo di bambini per camera', 'bookingenius-booking-engine'); ?></td>
                <td style="padding: 5px 5px 7px 5px;">
                    <?php
                      echo $plugin->options('max_children')->render();
                    ?>
                </td>
            </tr>
        </table>
        <br/>
        <h2><?php echo __('Form Labels', 'bookingenius-booking-engine'); ?></h2>
        <hr />
        <?php
          $labels = $plugin->config('form_labels');
          $languages = $plugin->config('supported_languages');
        ?>
        <table>
          <?php foreach ($labels as $field => $label): ?>
            <?php
              $saved_translations = unserialize($plugin->options('bookingenius_form_labels')->value);
              $default_translations_it = $plugin->config('form_labels_it');            
              $field_value_it = isset($saved_translations['it'][$field]) ? $saved_translations['it'][$field] : $default_translations_it[$field];
            ?>
            <tr>
              <td>
                <label><strong><?php echo __($label, 'bookingenius-booking-engine'); ?></strong></label>
                <input class="flag flag-it" type="text" class="bg-translate-field" name="bookingenius_form_labels[it][<?php echo $field; ?>]" value="<?php echo $field_value_it; ?>"/>
                <button type="button" class="button btn-translate" data-translate="<?php echo $field; ?>"><?php echo __('Traduci', 'bookingenius-booking-engine'); ?></button>
                <div>
                  <?php foreach ($languages as $lang): ?>
                    <?php
                      $default_translations = $plugin->config('form_labels_'.$lang);
                      $field_value = isset($saved_translations[$lang][$field]) ? $saved_translations[$lang][$field] : $default_translations[$field];
                    ?>
                    <input class="flag flag-<?php echo $lang; ?>" type="text" class="bg-translate-field" name="bookingenius_form_labels[<?php echo $lang; ?>][<?php echo $field; ?>]" value="<?php echo $field_value; ?>"/>
                  <?php endforeach; ?>
                </div>
                <br /><br />
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <h2><?php echo __('Form style', 'bookingenius-booking-engine'); ?></h2>
        <hr />
        <table>
        <tr class="form-field" valign="top">
            <?php
              $options = $plugin->options('form_styles');

              foreach ($options->values as $option): ?>
              <tr>
                  <td scope="row"  align="left">
                      <label for="<?php echo $option->name; ?>">
                          <?php echo __($option->title, 'bookingenius-booking-engine'); ?>
                          <?php if ($option->required): ?>
                          <span class="description">(<?php echo __('required'); ?>)</span>
                          <?php endif; ?>
                      </label>
                  </td>
                  <td>
                      <?php echo $option->render(); ?>
                      <p>
                        <?php if (isset($errors[$option->name])): ?>
                          <?php foreach ($errors[$option->name] as $error): ?>
                            <?php echo $error->message; ?><br/>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </p>
                  </td>
              </tr>
              <?php endforeach; ?>
              <tr valign="top">
                <td style="width: 160px; padding: 5px 5px 7px 5px;"><?php echo __ ('Posizione icona form mobile', 'bookingenius-booking-engine'); ?></td>
                <td style="padding: 5px 5px 7px 5px;">
                    <?php
                      echo $plugin->options('bookingenius_icon_pos')->render();
                    ?>
                </td>
            </tr>
        </table>
        <br/>
        <h2><?php echo __('Calendar styles', 'bookingenius-booking-engine'); ?>&nbsp;
          <small style="float:right;">(
           <?php echo __ ('Usa gli stili del tema', 'bookingenius-booking-engine'); ?>

                  <?php
                    echo $plugin->options('use_theme_calendar_skin')->render();
                  ?>)</small>
</h2>
        <hr />
        <table id="bgbe-calendar-skin-options">
        <tr class="form-field <?php if (isset($errors[$option->name])): ?>form-invalid<?php endif; ?>" valign="top">
            <?php
              $options = $plugin->options('custom_styles');
              foreach ($options->values as $option): ?>
              <tr>
                  <td scope="row" align="left">
                      <label for="<?php echo $option->name; ?>">
                          <?php echo __($option->title, 'bookingenius-booking-engine'); ?>
                          <?php if ($option->required): ?>
                          <span class="description">(<?php echo __('required'); ?>)</span>
                          <?php endif; ?>
                      </label>
                  </th>
                  <td>
                      <?php echo $option->render(); ?>
                      <p>
                        <?php if (isset($errors[$option->name])): ?>
                          <?php foreach ($errors[$option->name] as $error): ?>
                            <?php echo $error->message; ?><br/>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </p>
                  </td>
              </tr>
              <?php endforeach; ?>
        </table>
        <br/>
        <h2><?php echo __('Multi room selector styles', 'bookingenius-booking-engine'); ?></h2>
        <hr />
        <table>
        <tr class="form-field <?php if (isset($errors[$option->name])): ?>form-invalid<?php endif; ?>" valign="top">
            <?php
              $options = $plugin->options('multi_room_styles');
              foreach ($options->values as $option): ?>
              <tr>
                  <td scope="row" align="left">
                      <label for="<?php echo $option->name; ?>">
                          <?php echo __($option->title, 'bookingenius-booking-engine'); ?>
                          <?php if ($option->required): ?>
                          <span class="description">(<?php echo __('required'); ?>)</span>
                          <?php endif; ?>
                      </label>
                  </th>
                  <td>
                      <?php echo $option->render(); ?>
                      <p>
                        <?php if (isset($errors[$option->name])): ?>
                          <?php foreach ($errors[$option->name] as $error): ?>
                            <?php echo $error->message; ?><br/>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </p>
                  </td>
              </tr>
              <?php endforeach; ?>
               <tr valign="top">
                <td colspan="2" style="padding: 5px 5px 7px 5px;">
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="page_options" value="bookingenius_hotel_id,bookingenius_language,bookingenius_wide,bookingenius_custom_css,bookingenius_button_label" />
                    <input type="submit" value="<?php _e('Save Changes') ?>" class="button button-primary" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div class="notice notice-warning">
    <p><?php echo __('Lo shortcode per la generazione del modulo di prenotazione deve essere inserito <b>una sola volta</b> per pagina.', 'bookingenius-booking-engine'); ?></p>
</div>
<script>
(function( $ ) {
$( document ).ready(function(){

  var key = 'trnsl.1.1.20170306T164906Z.cbf1cf968377cfc7.2446a34e1726590fbe1c309769cd6d56b75850a8';
  var endpoint = "https://translate.yandex.net/api/v1.5/tr.json/translate";

  $( "#use_theme_calendar_skin" ).on( "change", function( e ){
      var $this = $( this );
      var val = parseInt( $this.val(), 10 );
      switch( val ) {
        case 0:
          $("#bgbe-calendar-skin-options").removeClass("hidden");
        break;
        case 1:
          $("#bgbe-calendar-skin-options").addClass("hidden");
        break;
      }
    });
    $( "#use_theme_calendar_skin" ).trigger( "change" );
  });
  $( ".btn-translate" ).on( "click", function( e ){
    var field = e.currentTarget.getAttribute( "data-translate" );
    var textToTranslate = $( "input[name='bookingenius_form_labels[it][" + field + "]']" ).val();
    translate( textToTranslate, field );
  });

  function translate( text, field ) {
    var i = 0;

    var languages = [
      'en',
      'de',
      'fr',
      'es',
      'pt',
      'ru'
    ];
    var l = languages.length;
    for (i; i < l; i++) {
      $.ajax({
        url: "https://translate.yandex.net/api/v1.5/tr.json/translate",
        method: "GET",
        dataType: "JSON",
        data: {
          key: "trnsl.1.1.20170306T164906Z.cbf1cf968377cfc7.2446a34e1726590fbe1c309769cd6d56b75850a8",
          text: text,
          format: "plain",
          lang: "it-" + languages[ i ]
        }
      }).done(function( data ){
        if ( data.code === 200) {
          var lang = data.lang.substr(3, 4);
          $( "input[name='bookingenius_form_labels[" + lang + "][" + field +  "]']")
          .val( data.text[ 0 ] );
        }
      });
    }
  }

})( jQuery );
</script>
