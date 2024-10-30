<?php
$is_vertical = $plugin->options('bookingenius_form_orientation')->value === 'vertical' ? true : false;
$form_labels = $plugin->options('bookingenius_form_labels')->value;
$language = $plugin->language;
?>
<div id="bgform">
    <form id="form-prebooking" name="bookingform">
        <div class="bg-booking-form-inline bg-booking-row">
            <div class="bg-booking-form-group <?php if ($is_vertical) { ?> bg-booking-col-phone-1-1 <?php } else { ?> bg-booking-col-phone-4-12 bg-booking-col-tablet-5-24 bg-booking-col-desktop-5-24 <?php } ?>">
                <label>
                  <?php if (isset($form_labels[$language]['checkin'])) { ?>
                    <?php echo $form_labels[$language]['checkin']; ?>
                  <?php } else { ?>
                     <?php echo __('Arrivo', 'bookingenius-booking-engine'); ?>
                  <?php } ?>
                </label>
                <div class="bg-booking-input-group">
                    <input name="checkin" type="text" value="<?php echo $from; ?>" readonly="readonly"/>
                    <span class="bg-booking-append fa fa-calendar-o"></span>
                </div>
            </div>
            <div class="bg-booking-form-group <?php if ($is_vertical) { ?> bg-booking-col-phone-1-1 <?php } else { ?> bg-booking-col-phone-4-12 bg-booking-col-tablet-5-24 bg-booking-col-desktop-5-24<?php } ?>">
                <label for="departure">
                  <?php if (isset($form_labels[$language]['checkout'])) { ?>
                    <?php echo $form_labels[$language]['checkout']; ?>
                  <?php } else { ?>
                     <?php echo __('Partenza', 'bookingenius-booking-engine'); ?>
                  <?php } ?>
                </label>
                <div class="bg-booking-input-group">
                    <input  name="checkout" type="text" value="<?php echo $to; ?>" readonly="readonly" />
                    <span class="bg-booking-append fa fa-calendar-o"></span>
                </div>
            </div>
            <div class="bg-booking-form-group <?php if ($is_vertical) { ?> bg-booking-col-phone-1-1 <?php } else { ?>  bg-booking-col-phone-4-12 bg-booking-col-tablet-2-24 bg-booking-col-desktop-2-24<?php } ?>">
              <label for="bg-num-rooms">
                <?php if (isset($form_labels[$language]['rooms'])) { ?>
                  <?php echo $form_labels[$language]['rooms']; ?>
                <?php } else { ?>
                  <?php echo __('Camere', 'bookingenius-booking-engine'); ?>
                <?php } ?>
              </label>
                  <div class="bg-booking-select" name="bg-num-rooms" id="bg-num-rooms" data-role="select">
                      <ul class="bg-booking-menu">
                          <li data-role="default">1</li>
                          <li>2</li>
                          <li>3</li>
                      </ul>
              </div>
            </div>
            <div class="bg-booking-form-group <?php if ($is_vertical) { ?> bg-booking-col-phone-1-1 <?php } else { ?> bg-booking-col-phone-4-12 bg-booking-col-tablet-5-24 bg-booking-col-desktop-4-24<?php } ?>">
                <label for="bg-room-guests">
                  <?php if (isset($form_labels[$language]['guests'])) { ?>
                    <?php echo $form_labels[$language]['guests']; ?>
                  <?php } else { ?>
                    <?php _e('Ospiti', 'bookingenius-booking-engine'); ?>
                  <?php } ?>
                </label>
                <div id="bg-room-guests" class="bg-guests bg-room-guests">
                    <div class="bg-total-guests total">2</div>
                    <div class="adults"><?php echo __('Adulti', 'bookingenius-booking-engine'); ?>: <span id="bg-num-adults">2</span></div>
                    <div class="children"><?php echo __('Bambini', 'bookingenius-booking-engine'); ?>: <span id="bg-num-children">0</span></div>
                </div>
                <div id="bg-booking-popover" class="webui-popover-content">
                    <nav class="bg-booking-tabs" data-role="tabs">
                        <ul id="bg-rooms-nav" class="bg-booking-nav">
                            <li class="active"><a href="#" data-ref="bg-room-1"><?php echo __('Camera', 'bookingenius-booking-engine'); ?> 1</a></li><li class="bg-booking-hidden"><a href="#" data-ref="bg-room-2"><?php echo __('Camera', 'bookingenius-booking-engine'); ?> 2</a></li><li class="bg-booking-hidden"><a href="#" data-ref="bg-room-3"><?php echo __('Camera', 'bookingenius-booking-engine'); ?> 3</a></li>
                        </ul>
                        <div class="bg-booking-tab-content">
                            <?php for ($k = 1; $k <= 3; $k++): ?>
                            <div data-tab="bg-room-<?php echo $k; ?>" class="tab" >
                                <label><?php echo __('Adulti','bookingenius-booking-engine'); ?></label>
                                <div class="bg-booking-select bg-room-<?php echo $k; ?>-adults" data-role="select">
                                    <ul class="bg-booking-menu bg-booking-menu-popover">
                                        <?php for ($i = 1; $i <= $plugin->options('max_adults')->value; $i++): ?>
                                          <li <?php if( $i===2): ?>data-role="default" <?php endif; ?>><?php echo $i . ' ' . _n('adulto', 'adulti', $i, 'bookingenius-booking-engine'); ?></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                                <label><?php echo __('Bambini','bookingenius-booking-engine'); ?></label>
                                <div data-tab="bg-room-<?php echo $k; ?>-children" class="bg-booking-select bg-room-children bg-room-<?php echo $k; ?>-children" data-role="select">
                                    <ul class="bg-booking-menu bg-booking-menu-popover">
                                        <li data-role="default">0 <?php echo __('bambini', 'bookingenius-booking-engine'); ?></li>
                                        <?php for ($i = 1; $i <= $plugin->options('max_children')->value; $i++): ?>
                                          <li><?php echo $i . ' ' . _n('bambino', 'bambini', $i, 'bookingenius-booking-engine'); ?></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                                <div data-tab="bg-room-<?php echo $k; ?>-children-setup" class="bg-booking-hidden">
                                  <label><?php echo __('Età dei bambini (anni)', 'bookingenius-booking-engine'); ?></label>
                                  <?php for ($j = 0; $j < $plugin->options('max_children')->value; $j++): ?>
                                    <div class="bg-booking-col-no-stack-6-12 bg-booking-col-phone-6-12" <?php if($j>1) echo 'style="margin-top:10px;"'; ?>>
                                        <div class="bg-booking-select bg-booking-hidden bg-room-<?php echo $k; ?>-child-<?php echo $j+1; ?>" data-role="select">
                                            <ul class="bg-booking-menu bg-booking-menu-popover">
                                                <li data-role="default" class="bg-booking-hidden"><?php echo __('Età', 'bookingenius-booking-engine'); ?></li>
                                                <li>0-1</li>
                                                <?php for ($i = 1; $i <= 17; $i++): ?>
                                                  <li><?php echo $i; ?></li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
                                  <?php endfor; ?>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </nav>
                </div>
                <input type="hidden" id="room-guests"  name="room-guests"  type="text" value="2" />
            </div>
            <div class="bg-booking-form-group <?php if ($is_vertical) { ?> bg-booking-col-phone-1-1 <?php } else { ?> bg-booking-col-phone-2-12 bg-booking-col-tablet-2-24 bg-booking-col-desktop-3-24<?php } ?>">
                  <label for="code">
                    <?php if (isset($form_labels[$language]['code'])) { ?>
                      <?php echo $form_labels[$language]['code']; ?>
                    <?php } else { ?>
                      <?php _e('Codice', 'bookingenius-booking-engine'); ?>
                    <?php } ?>
                  </label>
                  <input type="text" name="code" />
            </div>
            <div class="bg-booking-form-group <?php if ($is_vertical) { ?> bg-booking-col-phone-1-1 <?php } else { ?> bg-booking-col-phone-6-12 bg-booking-col-tablet-5-24 bg-booking-col-desktop-5-24<?php } ?>">
                <button class="<?php if ($is_vertical) { ?> bg-booking-submit-vertical <?php } else { ?> bg-booking-submit <?php } ?>" type="button" name="submit-booking">
                    <?php if (isset($form_labels[$language]['button'])) { ?>
                      <?php echo $form_labels[$language]['button']; ?>
                    <?php } else { ?>
                      <?php _e($plugin->options('bookingenius_button_label')->value, 'bookingenius-booking-engine'); ?>
                    <?php } ?>
                </button>
            </div>
        </div>
    </form>
</div>
