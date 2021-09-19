document.addEventListener('DOMContentLoaded', function () {
    //
});

(function($){
    $(document).ready(function() {
        function owlInit(className, items)
        {
            $(className).owlCarousel({
                nav: false,
                dots: false,
                autoplay: false,
                loop: false,
                items: 1,
                margin: 10,
                touchDrag: true,
                autoWidth: true,
                responsive: {
                    1025: {
                        items: items,
                        mouseDrag: true,
                        touchDrag: false,
                        margin: 20,
                    }
                }
            });
        }
    });
})(jQuery);