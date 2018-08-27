(function($, Drupal)
{
    Drupal.behaviors.purchasereturn = {
        attach:function()
        {

            $(document).ready(function () {
                var userLang = navigator.language || navigator.userLanguage;

                var options = $.extend({},
                    $.datepicker.regional["ja"], {
                        dateFormat: "dd/mm/yy",
                        changeMonth: true,
                        changeYear: true,
                        highlightWeek: true,
                        showOn: "both",
                        buttonText: "<i class='fa fa-calendar'></i>",
                    }
                );

                $("#datepicker").datepicker(options);
            });
        }
    }

}(jQuery, Drupal));