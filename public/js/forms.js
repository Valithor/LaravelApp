/*!
 * Title:   Laapp - HTML App Landing Page
 * Forms JS file
 * Author:  http://themeforest.net/user/5studiosnet
 * Copyright © 2019 5Studios.net
 * https://5studios.net
 */

'use strict';

$(function($) {
    $("form").each(function() {
        var $form = $(this);
        var options = {
            errorPlacement: function(error, element) {
                var $parent = element.parent();

                if ($parent.hasClass("input-group")) {
                    error.insertAfter($parent);
                } else if ($parent.hasClass("has-icon")) {
                    error.insertBefore($parent);
                } else if ($parent.hasClass("control")) {
                    error.insertAfter(element.next('.control-label'));
                } else {
                    error.insertAfter(element);
                }
            }
        };

        if ($form.data("validate-on") == "submit") {
            $.extend(options, {
                onfocusout: false,
                onkeyup: false
            });
        }

        // call to validate plugin
        $form.validate(options);
    });


    $("form").submit(function(evt) {
        evt.preventDefault();
        var $form = $(this);

        if (!$form.valid()) {
            return false;
        }

        var $submit = $("button[type=submit]", this);
        $submit.addClass('loading');

        var $ajaxButton = $submit.parent('.ajax-button');
        var hasAjaxButton = $ajaxButton.length;
        var $message = $form.next(".response-message");

        function doAjax(url, data, config) {
            var settings = $.extend(true, {}, config, {
                url: url,
                type: 'POST',
                data: data,
                dataType: 'json'
            });

            $.ajax(settings)
                .done(function(data) {
                    if (data.result) {
                        //setTimeout(function() {
                            $form.trigger("form.submitted", [data]);
                        //}, 1000);

                        $("input, textarea", $form).removeClass("error");
                        $(".response", $message).html(data.message);

                        // restore button defaults
                        if (hasAjaxButton) {
                            $(".success", $ajaxButton).addClass("done");
                        }

                        $form.addClass('submitted');
                        $form[0].reset();
                    } else {
                        if (hasAjaxButton) {
                            $(".failed", $ajaxButton).addClass("done");
                        }

                        if (data.errors) {
                            $.each(data.errors, function(i, v) {
                                var $input = $("[name$='[" + i + "]']", $form).addClass('error');
                                $input
                                    .tooltip({title: v, placement: 'bottom', trigger: 'manual'}).tooltip('show')
                                    .on('focus', function() { $(this).tooltip('destroy'); });
                            });
                        }
                    }
                }).fail(function() {
                    $(".response", $message).html($("<span class='block'>Something went wrong.</span>"));
                    if (hasAjaxButton) {
                        $(".failed", $ajaxButton).addClass("done");
                    }
                }).always(function() {
                    $submit.addClass('loading-end');

                    if (hasAjaxButton) {
                        setTimeout(function () {
                            console.log('clearing status');
                            $submit.removeClass('loading').removeClass('loading-end');
                            $(".success,.failed", $ajaxButton).removeClass("done");
                        }, 500);
                    }
                    //some other stuffs
                });
        }

        function submitAjax($form) {
            doAjax(
                $form.attr('action'),
                $form.serializeArray()
            );
        }

        submitAjax($form);

        return false;
    });
});
