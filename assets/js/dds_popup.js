jQuery(document).ready(function() {
    var currentPopup = "";

    jQuery(".pop_open").on("click", function(e) {
        e.preventDefault();

        var newPopup = "." + jQuery(this).attr("data-popup");

        // Close current popup if it's different from the new one
        if (currentPopup && currentPopup !== newPopup) {
            closePopup();
        }

        // Open the new popup
        currentPopup = newPopup;
        jQuery(currentPopup).show().animate({
            'opacity': '1',
            'bottom': 0
        }, 300);
    });

    jQuery(".dds_pop_close, .pop_close, .dds_dialog_pop_close").on('click', function(e) {
        e.preventDefault();
        closePopup();
    }).on('click', 'div', function(e) {
        e.stopPropagation();
    });

    // Function to close the current popup
    function closePopup() {
        if (currentPopup) {
            jQuery(currentPopup).animate({
                'opacity': '0',
                'bottom': '-100vh'
            }, 300, function() {
                jQuery(this).hide();
            });
            currentPopup = "";
        }
    }
});
