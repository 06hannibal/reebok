(function($, Drupal)
{
    Drupal.behaviors.searchResults = {
        attach:function()
        {
            var $button = $('.block-title'),
                $text   = $('.item-list__links'),
                visible = true;

            $('.block-title').click(function(){
                $(this).next().next().children().toggleClass("open");
            });

            $(".block-title").on("click", function () {
                $(this).toggleClass("active");
            });

        }
    }

}(jQuery, Drupal));