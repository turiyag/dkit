
$(function(){
    $("*").pretty();
});

$.fn.pretty = function() {
    $texts = this.filter(":text, :password, input[type=number], input[type=search], input[type=tel], input[type=url], input[type=email], textarea");
    $texts.addClass("ui-text");
    $.each($texts, function(idx, obj) {
        if (!$(obj).parent().hasClass("textwrap")) {
            $(obj).wrap('<div class="textwrap" />');
            $(obj).parent().click(function(evt) {
                if (evt.target == evt.currentTarget) {
                    $(this).children().focus();
                }
            });
        }
    });
    $btns = this.filter(":button");
    $btns.addClass("ui-button");
    $.each($btns, function(idx, obj) {
        if (!$(obj).parent().hasClass("buttonwrap")) {
            $(obj).wrap('<div class="buttonwrap" />');
            $(obj).parent().click(function(evt) {
                if (evt.target == evt.currentTarget) {
                    $(this).children().click();
                }
            });
        }
    });
    $links = this.filter("a[data-role=button]");
    $links.addClass("ui-button");
    $.each($links, function(idx, obj) {
        if (!$(obj).parent().hasClass("buttonwrap")) {
            $(obj).wrap('<div class="buttonwrap" />');
            $(obj).parent().click(function(evt) {
                if (evt.target == evt.currentTarget) {
                    window.location = $(this).children("a").attr("href");
                }
            });
        }
    });
    $sels = this.filter("select");
    $sels.addClass("ui-select");
    $.each($sels, function(idx, obj) {
        if (!$(obj).parent().hasClass("selwrap")) {
            $(obj).wrap('<div class="selwrap" />');
            $(obj).parent().click(function(evt) {
                if (evt.target == evt.currentTarget) {
                    $(this).children().click();
                }
            });
        }
    });
    $icons = this.filter("[data-icon]");
    $icons.addClass("ui-icon");
    $.each($icons, function(idx, obj) {
        $(obj).addClass("ui-icon-" + $(obj).attr("data-icon"));
    });
}

$.fn.disable = function() {
    this.attr('disabled','disabled');
    this.parent().addClass("ui-disabled");
}

$.fn.enable = function() {
    this.removeAttr('disabled');
    this.parent().removeClass("ui-disabled");
}