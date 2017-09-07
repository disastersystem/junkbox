// set no caching to false, globally
$.ajaxSetup({ cache: false });


function ajaxRequest(requestType, requestURL, sendData, messageContainer, formDataObject) {
    // set formDataObject to true by default
    formDataObject = typeof formDataObject !== 'undefined' ? formDataObject : true;

    // determine what kind of data was sent and whether to let jQuery proccess it
    if (formDataObject === true) {
        var processOrNot =
            { type: requestType, url: requestURL, data: sendData, dataType: 'json', encode: true, contentType: false, processData: false };
    } else {
        var processOrNot =
            { type: requestType, url: requestURL, data: sendData, dataType: 'json', encode: true };
    }

    $.ajax(processOrNot).done(function(response) {
        // empty previous messages
        $(messageContainer).empty();

        if ("error" in response) {
            $(messageContainer).append([
                '<div class="ajax-success-message" style="background: #EF6969;">',
                    response.error,
                '</div>'
            ].join(''));
        }
        if ("success" in response) {
            $(messageContainer).append([
                '<div class="ajax-success-message" style="background: #39B544;">',
                    response.success,
                '</div>'
            ].join(''));
        }

    }).fail(function(response) {

        // empty previous messages
        $(messageContainer).empty();

        /* The append method doesn't allow new lines in the html,
         * which can result in really long strings.
         * So we create an array which we merge to a string. */
        $(messageContainer).append([
            '<div class="ajax-error-message">',
                response.responseText,
            '</div>'
        ].join(''));
    });
}
