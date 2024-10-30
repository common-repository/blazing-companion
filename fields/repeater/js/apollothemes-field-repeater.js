/* global jQuery */
/* global wp */
/**
 * File repeater.js
 *
 * The main.
 *
 * @package Blazing
 */

/* global control_settings */
jQuery(document).ready(function($) {
    'use strict';
    // var saved_data_input   = control_settings.saved_data_input;
    var apt_repeater = jQuery(".apollothemes-repeater").sortable({
        axis: 'y',
        items: '> li',
        update: function(event, ui) {
            update_apt_repeater($(this));
        }
    }).disableSelection();

    var update_apt_repeater = function(obj) {
        var data = [];
        obj.children('li').each(function(index, obj) {
            // console.log();
            var repeater_item = {};
            $(this).children().find('span.index').text(index + 1);

            $(this).find('.apollothemes-repeater-field').each(function(i, iobj) {
                var apt_index = $(this).data('apt-index');
                var apt_value = $(this).val();
                repeater_item[apt_index] = apt_value;
            });

            var repeater_repeater_item = [];
            $(this).children().find('.apollothemes-repeater-repeater-group').each(function(j, jobj) {
                var r_r_data = {};
                $(this).find('.apollothemes-repeater-repeater-field').each(function(k, kobj) {
                    var r_apt_index = $(this).data('apt-index');
                    var r_apt_value = $(this).val();
                    var r_r_e_data = {};
                    r_r_data[r_apt_index] = r_apt_value;
                    // r_r_data.push(r_r_e_data);
                });
                // console.log(r_r_e_data);
                repeater_repeater_item.push(r_r_data);
            });
            repeater_item['team_socials'] = repeater_repeater_item;
            //console.log(repeater_repeater_item);
            // console.log(repeater_item);
            data.push(repeater_item);
        });

        obj.children('.apollothemes-repeater-data').val(JSON.stringify(data));
        obj.children('.apollothemes-repeater-data').trigger('change');
    }


    $(document).on('keyup', '.apollothemes-repeater-field, .apollothemes-repeater-repeater-field', function(event) {
        $(this).trigger('change');
    });

    $(document).on('change', '.apollothemes-repeater-field, .apollothemes-repeater-repeater-field', function(event) {
        var selector = $(this).parents('.apollothemes-repeater');
        update_apt_repeater(selector);
    });

    $(document).on('click', '.apollothemes-repeater-add-new', function(event) {
        var repeater = $(this).siblings('.apollothemes-repeater');
        var repeater_item = $(this).siblings('.apollothemes-repeater-copy').children('.apollothemes-repeater-item-copy').clone();
        repeater_item.removeClass('apollothemes-repeater-item-copy').addClass('apollothemes-repeater-item');
        console.log(repeater_item);
        var index = repeater.children('.apollothemes-repeater-item').length;
        repeater_item.find('.index').text(index + 1);
        repeater.append(repeater_item);
        var selector = $(this).siblings('.apollothemes-repeater');
        update_apt_repeater(selector);
    });

    $(document).on('click', '.apollothemes-repeater-add-repeater', function(event) {
        var r_repeater = $(this).siblings('.apollothemes-repeater-repeater-group');
        var r_repeater_item = $(this).parents('.apollothemes-repeater-repeater').siblings('.apollothemes-repeater-repeater-copy').children('.apollothemes-repeater-repeater-group-copy').clone();
        r_repeater_item.removeClass('apollothemes-repeater-repeater-group-copy').addClass('apollothemes-repeater-repeater-group');
        $(this).before(r_repeater_item);
        var selector = $(this).parents('.apollothemes-repeater');
        update_apt_repeater(selector);
    });

    $(document).on('click', '.apollothemes-repeater-remove-item', function(event) {
        var selector = $(this).parents('.apollothemes-repeater');
        $(this).parents('.apollothemes-repeater-item').remove();
        update_apt_repeater(selector);
    });

    $(document).on('click', '.apollothemes-repeater-remove-repeater', function(event) {
        var selector = $(this).parents('.apollothemes-repeater');
        $(this).parents('.apollothemes-repeater-repeater-group').remove();
        update_apt_repeater(selector);
    });

});
jQuery(document).ready(function($) {
    'use strict';
    var button_class = '.image-select-button';
    jQuery(document).on('click', button_class, function() {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        return false;
    });









    $(document).on('click', '.repeater-head', function(event) {
        var r_contaier = $(this).parent();
        if (r_contaier.hasClass('repeater-expanded')) {
            r_contaier.removeClass('repeater-expanded');
            r_contaier.children('.repeater-body').hide('fast');

        } else {
            r_contaier.addClass('repeater-expanded');
            r_contaier.children('.repeater-body').show('fast');
        }
    });


});


function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function() {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function(html) {

        };
        return false;
    });
}