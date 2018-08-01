

$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
    console.log(jqxhr);
    if(jqxhr.status === 422 ){
        let message = jqxhr.responseJSON.message;
        for(let k in jqxhr.responseJSON.errors) {
            message += '<br />' + jqxhr.responseJSON.errors[k][0];
        }
        bootbox.alert({
            title: thrownError,
            message: message,
            size: 'small'
        });
    }
    if(jqxhr.status === 500 ){
        bootbox.alert({
            title: jqxhr.statusText,
            message: jqxhr.responseJSON.message,
            size: 'small'
        });
    }
});
$( document ).ajaxSuccess(function( event, xhr, settings ) {
    if(xhr.responseJSON.error.status === 'ERROR') {
        bootbox.alert({
            title: 'Message!',
            message: xhr.responseJSON.error.message,
            size: 'small'
        });
    }

});
$( document ).ajaxSend(function( event, xhr, settings ) {
    helper.refreshLoading();
});
$( document ).ajaxComplete(function( event, xhr, settings ) {
    helper.hideLoading();
});