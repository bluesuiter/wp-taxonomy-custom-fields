jQuery(function($)
{
    /* Image Uploading Code */
    var i = 0;
    var file_frame, id, img;
    
    $('body').on('click', 'button[name="upfIlE"], button.edtRow', function (slider)
    {
        $this = $(this);
        slider.preventDefault();
        
        /*/ If the media frame already exists, reopen it.*/
        if (file_frame) {
            file_frame.open();
            return;
        }

        /*/ Create the media frame.*/
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('uploader_title'),
            button: {
                text: jQuery(this).data('uploader_button_text'),
            },
            multiple: true /*/ Set to true to allow multiple files to be selected*/
        });


        /*/ When a file is selected, run a callback.*/
        file_frame.on('select', function ()
        {
            attachment = file_frame.state().get('selection').toJSON();
            var rowId = $this.attr('data-rowid');

            $('#' + rowId).val(attachment[0]['id']);
            $('.prevwImage.' + rowId).attr('src', attachment[0]['url']);
        });

        /*/ Finally, open the modal*/
        file_frame.open();
        jQuery('button.upimage').die("click");
    });   
    /* Image Uploading Code */
});