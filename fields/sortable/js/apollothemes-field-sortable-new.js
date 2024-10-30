wp.customize.controlConstructor['apollothemes-sortable'] = wp.customize.Control.extend({

    ready: function() {

        'use strict';
        console.log('fired');

        var control = this;

        // The hidden field that keeps the data saved
        this.settingField = this.container.find( '.apollothemes-customize-setting-link' ).first();

        // The sortable container
        this.sortableContainer = this.container.find( 'ul.sortable' ).first();

        // Set the field value for the first time
        this.setValue( this.setting.get(), false );

        // Init the sortable container
        this.sortableContainer.sortable({
            axis: 'y',
            items: '> li',
            update: function(event, ui) {
                control.sort();
            }
        }).disableSelection();
        $(document).on('click', '.apollothemes-sortable-item .dashicons-visibility', function(event) {
            var s_item = $(this).parent().toggleClass('invisible');
            control.sort();            
        });
    },

    /**
     * Updates the sorting list
     */
    sort: function() {

        'use strict';

        var newValue = [];
        this.sortableContainer.find( 'li' ).each( function() {
            var $this = jQuery( this );
            if ( ! $this.is( '.invisible' ) ) {
                newValue.push( $this.data( 'value' ) );
            }
        });

        this.setValue( newValue, true );

    },

    /**
     * Get the current value of the setting
     *
     * @return Object
     */
    getValue: function() {

        'use strict';

        // The setting is saved in PHP serialized format
        return JSON.parse( this.setting.get() );

    },

    /**
     * Set a new value for the setting
     *
     * @param newValue Object
     * @param refresh If we want to refresh the previewer or not
     */
    setValue: function( newValue, refresh ) {

        'use strict';

        var newValueSerialized = JSON.stringify( newValue );

        this.setting.set( newValueSerialized );

        // Update the hidden field
        this.settingField.val( newValueSerialized );

        if ( refresh ) {

            // Trigger the change event on the hidden field so
            // previewer refresh the website on Customizer
            this.settingField.trigger( 'change' );

        }

    }

});
/*jQuery(document).ready(function($) {
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

});*/