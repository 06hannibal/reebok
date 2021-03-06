(function($, Drupal)
{
    Drupal.behaviors.searchResults = {
        attach:function()
        {
            $('.block-title').once().click(function(){
                $(this).next().next().children().toggleClass("open");
                $(this).toggleClass("active");
                /*console.log("JQUERY IS READY!");*/
            });

            $(".buttom-mens").once().click(function() {
                $(this).prev().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
                $(".views").toggleClass("hidden-hide-mens");
            });

            $(".buttom-children").once().click(function() {
                $(this).prev().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
                $(".views").toggleClass("hidden-hide-children");
            });

            $(".buttom-novaya-kollekciya").once().click(function() {
                $(this).prev().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
                $(".views").toggleClass("hidden-novaya-kollekciya");
            });

            $(".buttom-obuv").once().click(function() {
                $(this).prev().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
                $(".views").toggleClass("hidden-obuv");
            });

            $(".buttom-apparel").once().click(function() {
                $(this).prev().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
                $(".views").toggleClass("hidden-apparel");
            });

            $(".buttom-accessories").once().click(function() {
                $(this).prev().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
                $(".views").toggleClass("hidden-accessories");
            });

            $(window).scroll(function(){
                var sticky = $('.menu--scroll-menu'),
                    scroll = $(window).scrollTop();

                if (scroll >= 200) sticky.addClass('fixed');
                else sticky.removeClass('fixed');
            });
            $(window).scroll(function(){

                var sticky = $('#views-exposed-form-search-page-1'),
                    scroll = $(window).scrollTop();

                if (scroll >= 180) sticky.addClass('fixed-search');
                else sticky.removeClass('fixed-search');
            });

        }
    }

}(jQuery, Drupal));