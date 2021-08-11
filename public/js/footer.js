$(window).bind("load", function() {

    $footer = $(".site-footer");

    positionFooter();

    function positionFooter() {
        height = $(document).height()

        if (( height) <= screen.height ) {
            $footer.css({
                position: "absolute",
                bottom:0,
                width: "100%"
            })
        } else {
            $footer.css({
                position: "static"
            })
        }

    }

    $(window)
        .scroll(positionFooter)
        .resize(positionFooter)

});
