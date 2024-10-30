jQuery(document).ready(function($) {
    // var saved_data_input   = control_settings.saved_data_input;
    jQuery(".apollothemes-sortable").sortable({
        axis: 'y',
        items: '> li',
        update: function(event, ui) {
            update_apt_shotable($(this));
        }
    }).disableSelection();
    
    $(document).on('click', '.apollothemes-sortable-item .dashicons-visibility', function(event) {
        var s_item = $(this).parent();
        var parent = $(this).parent().parent();
        console.log(s_item);
        if (s_item.hasClass('invisible')) {
            s_item.removeClass('invisible');
        } else {
            s_item.addClass('invisible');
        }

        update_apt_shotable(parent);
    });

    var update_apt_shotable = function(obj) {
        //var data = JSON.stringify(obj.sortable( 'toArray' , { attribute : "data-value" }));
        // jQuery( saved_data_input ).trigger( 'change' );
        var data = [];
        obj.children('li').each(function() {
            if (!$(this).hasClass('invisible')) {
                data.push($(this).data('value'));
            }
        });


        obj.children('.apollothemes-sortable-data').val(JSON.stringify(data));
        obj.children('.apollothemes-sortable-data').trigger('change');
    }

});