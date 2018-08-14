(function($, Drupal)
{
    Drupal.behaviors.searchResults = {
        attach:function()
        {
            $('.block-title').once().click(function(){
                $(this).next().next().children().toggleClass("open");
                $(this).toggleClass("active");
                console.log("JQUERY IS READY!");
            });

            $(".buttom-mens").once().click(function() {
                console.log("JQUERY IS READY!");
                $(this).prev().children().children().toggleClass("text-hidden");
                $(this).children().toggleClass("hidden-hide");
            });
            /*$(".buttom-mens").one().click(function() {
                e.preventDefault();
                $(this).children().toggleClass("hidden-hide");
            });*/
/*
            $(document).one().ready(function(){
                $(".buttom-mens").on("click", function () {
                    console.log("JQUERY IS READY!");
                    $(this).children().toggleClass("hidden-hide");
                });
            });*/

        }
    }

}(jQuery, Drupal));