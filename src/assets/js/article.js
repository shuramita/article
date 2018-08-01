import Quill from 'quill';
import { ImageResize } from 'quill-image-resize-module-ts';
Quill.register('modules/imageResize', ImageResize);
// require('bootbox');

require('./helper')
require('./routes')
require('./controls/photo');
require('./jquery-setup');

var article = {
    namespace:"article",
    config:{},
    dom:{
        articleId:$('#articleID'),
        articleTitle:$('input[name=article_name]'),
        articleCategory:$('#articleCategory'),
        articleDescription:$('#articleDescription'),
        articlePhoto:$('#uploadZone'),
        body:$('#articleBody'),
        saveArticle:$('#saveArticle'),
        deleteArticle:$('.delete_article'),
        updateArticle:$('#updateArticle'),
        mediaModal:$('#mediaModal'),
        class:{
            mediaImage:'.image-container img'
        }

    },
    data:{

    },
    controller:{
        saveArticle:function(){
            var p = article.model.getArticle();
            if(article.helper.validateArticleData()){
                article.model.submitArticle(p)
                    .then(function(result){
                        if(result.error.status == 'OK'){
                            route.redirect(route.updateArticlePage,{'id':result.data.id})
                        }
                    });
            }
        },
        deleteArticle:function(){
            var article_id = $(this).data('id');
            article.model.deleteArticle(article_id)
                .then(function(result){
                    if(result.error.status == 'OK'){
                        helper.reloadPage();
                    }
                })
        },
        updateArticle:function(){
            var p = article.model.getArticle();
            article.model.updateArticle(p)
                .then(function(result){
                    if(result.error.status == 'OK'){
                        route.redirect(route.updateArticlePage,{'id':result.data.id})
                    }
                });
        },
        addMediaToEditor:function(){
            var media = $(this).data('photo');
            article.view.addMediaToEditor(media);
        }
    },
    view:{
        renderBodyEditor:function(){
            if($('#articleBody').length == 0) return;

            article.data.body = new Quill('#articleBody', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar-container',
                    imageResize: {
                        // displaySize: true
                        modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                    }
                },
                placeholder: 'Compose an epic...',
            });
            // OK, will handle this later
            var toolbar = article.data.body.getModule('toolbar');
            toolbar.addHandler('image', function(value){
                // load popup
                article.dom.mediaModal.modal();
                article.model.loadMedia()
                    .then(function(result){
                        if(result.error.status == 'OK') {
                            // build image and add to body
                            var images = article.view.buildImages(result.data);
                            console.log(images);
                            article.dom.mediaModal.find('.modal-body').first().html(images);
                        }
                    });
                console.log(value);
                // const range = article.data.body.getSelection();
                // article.data.body.insertEmbed(range.index, 'image', 'http://www.haveacocktail.com/images/da/2455.jpg');
            });

        },
        buildImages:function(photos) {
            var images = '<div class="media-container row">';
            if(photos.length > 0) {
                photos.forEach(function(photo){
                    photo.value = JSON.parse(photo.values);
                    images+=article.view.buildImage(photo);

                });
            }else{
                images+='<span>No photos</span>';
            }
            images+='</div>';
            return images;
        },
        buildImage:function(photo){
            var image = '<div class="image-container">';
            image+= '<img src=/'+photo.value.mini.uri+' data-photo='+photo.values+' />';
            image+= '</div>';
            return image;
        },
        addMediaToEditor:function(media){
            const range = article.data.body.getSelection();
            article.data.body.insertEmbed(range.index, 'image', '/'+media.medium.uri);
        }

    },
    model:{
        getArticle:function(){
            var p = {
                id:article.dom.articleId.val(),
                title:article.dom.articleTitle.val(),
                description:article.dom.articleDescription.val(),
                body:article.dom.body.find('.ql-editor').first().html(),
                category_id:article.dom.articleCategory.find(":selected").val(),
                photos: JSON.stringify(article.dom.articlePhoto.data('photos'))
            };
            return p;
        },
        submitArticle:function(p){
            return $.ajax({
                type: "POST",
                url: route.addArticle,
                cache: false,
                data: p,
                dataType: "json",
                beforeSend: function () {

                },
                success: function(data){
                    helper.hideLoading();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    helper.hideLoading();
                },
            })
        },
        updateArticle:function(p){
            return $.ajax({
                type: "POST",
                url: route.updateArticle,
                cache: false,
                data: p,
                dataType: "json",
                beforeSend: function () {

                },
                success: function(data){
                    helper.hideLoading();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    helper.hideLoading();
                },
            })
        },
        deleteArticle:function(article_id){
            return $.ajax({
                type: "POST",
                url: route.generate(route.deleteArticle,{id:article_id}),
                cache: false,
                data: {},
                dataType: "json",
                beforeSend: function () {

                },
                success: function(data){
                    helper.hideLoading();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    helper.hideLoading();
                },
            })
        },
        loadMedia:function(){
            return $.ajax({
                type: "POST",
                url: route.generate(route.media,{'type':'photo'}),
                cache: false,
                data: {},
                dataType: "json",
                beforeSend: function () {

                },
                success: function(data){

                },
                error: function (xhr, ajaxOptions, thrownError) {

                },
            })
        }
    },
    helper:{
        validateArticleData:function(article){
            return true;
        }
    },
    init:function () {
        article.view.renderBodyEditor();
        article.dom.saveArticle.on('click',article.controller.saveArticle);
        article.dom.deleteArticle.on('click',article.controller.deleteArticle);
        article.dom.updateArticle.on('click',article.controller.updateArticle);
        $(document).on('click',article.dom.class.mediaImage,article.controller.addMediaToEditor);
    }
};
article.init();