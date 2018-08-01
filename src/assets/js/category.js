// import Quill from 'quill';
// import { ImageResize } from 'quill-image-resize-module-ts';
// Quill.register('modules/imageResize', ImageResize);


require('./helper');
require('./routes');
require('./controls/photo');
require('./jquery-setup');

var category = {
    namespace:"category",
    config:{},
    dom:{
        categoryId:$('#categoryID'),
        categoryName:$('input[name=category_name]'),
        parentCategory:$('#categoryCategory'),
        categoryDescription:$('#categoryDescription'),
        categoryPhoto:$('#uploadZone'),
        body:$('#categoryBody'),
        saveCategory:$('#saveCategory'),
        deleteCategory:$('.delete_category'),
        updateCategory:$('#updateCategory'),
        mediaModal:$('#mediaModal'),
        class:{
            mediaImage:'.image-container img'
        }
    },
    data:{

    },
    controller:{
        saveCategory:function(){
            var p = category.model.getCategory();
            if(category.helper.validateCategoryData()){
                category.model.submitCategory(p)
                    .then(function(result){
                        if(result.error.status == 'OK'){
                            route.redirect(route.updateCategoryPage,{'id':result.data.id})
                        }
                    });
            }
        },
        deleteCategory:function(){
            var category_id = $(this).data('id');
            category.model.deleteCategory(category_id)
                .then(function(result){
                    if(result.error.status == 'OK'){
                        helper.reloadPage();
                    }
                })
        },
        updateCategory:function(){
            var p = category.model.getCategory();
            category.model.updateCategory(p)
                .then(function(result){
                    if(result.error.status == 'OK'){
                        bootbox.dialog({message:result.error.message,
                            closeButton:true,
                            buttons: {
                            confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            }
                        },});
                    }
                });
        },
        addMediaToEditor:function(){
            var media = $(this).data('photo');
            category.view.addMediaToEditor(media);
        }
    },
    view:{
        renderBodyEditor:function(){
            if($('#categoryBody').length == 0) return;

            category.data.body = new Quill('#categoryBody', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar-container',
                    imageResize: {
                        displaySize: true
                    }
                },
                placeholder: 'Compose an epic...',
            });
            // OK, will handle this later
            var toolbar = category.data.body.getModule('toolbar');
            toolbar.addHandler('image', function(value){
                // load popup
                category.dom.mediaModal.modal();
                category.model.loadMedia()
                    .then(function(result){
                        if(result.error.status == 'OK') {
                            // build image and add to body
                            var images = category.view.buildImages(result.data);
                            console.log(images);
                            category.dom.mediaModal.find('.modal-body').first().html(images);
                        }
                    });
                console.log(value);
                // const range = category.data.body.getSelection();
                // category.data.body.insertEmbed(range.index, 'image', 'http://www.haveacocktail.com/images/da/2455.jpg');
            });

        },
        buildImages:function(photos) {
            var images = '<div class="media-container row">';
            if(photos.length > 0) {
                photos.forEach(function(photo){
                    photo.value = JSON.parse(photo.values);
                    images+=category.view.buildImage(photo);

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
            const range = category.data.body.getSelection();
            category.data.body.insertEmbed(range.index, 'image', '/'+media.medium.uri);
        }

    },
    model:{
        getCategory:function(){
            var p = {
                id:category.dom.categoryId.val(),
                name:category.dom.categoryName.val(),
                description:category.dom.categoryDescription.val(),
                parent_id:category.dom.parentCategory.find(":selected").val(),
                photos: JSON.stringify(category.dom.categoryPhoto.data('photos'))
            };
            return p;
        },
        submitCategory:function(p){
            return $.ajax({
                type: "POST",
                url: route.addCategory,
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
        updateCategory:function(p){
            return $.ajax({
                type: "POST",
                url: route.updateCategory,
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
        deleteCategory:function(category_id){
            return $.ajax({
                type: "POST",
                url: route.generate(route.deleteCategory,{id:category_id}),
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
        validateCategoryData:function(category){
            return true;
        }
    },
    init:function () {
        // category.view.renderBodyEditor();
        category.dom.saveCategory.on('click',category.controller.saveCategory);
        category.dom.deleteCategory.on('click',category.controller.deleteCategory);
        category.dom.updateCategory.on('click',category.controller.updateCategory);
        $(document).on('click',category.dom.class.mediaImage,category.controller.addMediaToEditor);
    }
};
category.init();