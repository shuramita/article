var helper = {
    showLoading: function (message){
        message = message?message:'';
        let backdrop = '<div class="backdrop"><div class="spinner"></div>'+'<span class="message">'+message+'</span>'+'</div>'
        $('body').append(backdrop);
    },
    hideLoading: function (){
        $('.backdrop').remove();
    },
    refreshLoading: function (message){
        helper.hideLoading();
        helper.showLoading(message);
    },
    reloadPage:function(){
        location.reload();
    }
}
window.helper = helper;