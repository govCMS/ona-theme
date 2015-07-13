(function ($) {
    $(document).ready(function () {
        if(jQuery("ul.rslides_tabs").length) {
            jQuery("ul.rslides_tabs").append("<li><a href='#' id='stopStartSlide' title='Select to Pause' class='started'>&#9614;&#9614;</a></li>");
            //Slideshow exists... lets change them every 7 seconds
            var interval = setInterval(function() {
                if(jQuery("li.rslides_here").is(':nth-last-child(2)')) {
                    jQuery("a.rslides1_s1").click();
                } else {
                    jQuery("li.rslides_here").next().find("a").click();
                }

            }, 7000);

            jQuery("ul.rslides_tabs > li").each(function() {
                jQuery(this).find("a").each(function() {
                    jQuery(this).click(function(e) {
                        if(e.hasOwnProperty('originalEvent')) {
                            clearInterval(interval);
                        }
                    });
                });
            });

            jQuery("#stopStartSlide").click(function() {
                if(jQuery(this).hasClass("started")) {
                    clearInterval(interval);
                    jQuery(this).removeClass("started");
                    jQuery(this).addClass("stopped");
                    jQuery(this).html("&#9658;");
                    jQuery(this).attr("title", "Select to Play");
                } else {
                    interval = setInterval(function() {
                        if(jQuery("li.rslides_here").is(':nth-last-child(2)')) {
                            jQuery("a.rslides1_s1").click();
                        } else {
                            jQuery("li.rslides_here").next().find("a").click();
                        }

                    }, 7000);
                    jQuery(this).addClass("started");
                    jQuery(this).removeClass("stopped");
                    jQuery(this).html("&#9614;&#9614;");
                    jQuery(this).attr("title", "Select to Pause");
                }
            });
        }
    });
})(jQuery);


var equalheight = function(container){

    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = [],
        el,
        currentDiv = 0;
    jQuery(container).each(function() {

        el = jQuery(this);
        jQuery(el).height('auto');
        var topPostion = el.position().top;

        if (currentRowStart !== topPostion) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = el.height();
            rowDivs.push(el);
        } else {
            rowDivs.push(el);
            currentTallest = (currentTallest < el.height()) ? (el.height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
};

jQuery(window).load(function() {
    if(jQuery(window).width() >= 650){
        equalheight('body.front div.panel-col-middle div.panel-pane');
        equalheight('body.front div.panel-col-bottom div.panel-pane');

    }
});


jQuery(window).resize(function(){
    if(jQuery(window).width() >= 650){
        equalheight('body.front div.panel-col-middle div.panel-pane');
        equalheight('body.front div.panel-col-bottom div.panel-pane');
    }
});
