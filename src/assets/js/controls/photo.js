import Dropzone from 'dropzone';
window.photo = {
    status:{
        files_is_uploading:false
    },
    dom:{
        uploadZone:$('#uploadZone'),
        removePhoto:$('.dz-remove')
    },
    data:{
        uploadPhotos:[]
    },
    controller:{
        removePhoto:function(){
            var p = $(this).data('photo');
            photo.model.removePhoto(p);
            $(this).parent().remove();
        }
    },
    view:{
        setupUploadPhotos:function(){
            if(photo.dom.uploadZone.length < 1) return;
            photo.uploadZone = new Dropzone("span#"+photo.dom.uploadZone.attr('id'),
                {
                    url: route.uploadPhoto,
                    clickable:true,
                    addRemoveLinks:true,
                    acceptedFiles:'.jpg,.png, .JPG, .JPEG',
                    maxFilesize: 10, // MB
                    dictRemoveFile:'X',
                    dictCancelUpload:'X',
                    previewsContainer: ".preview-photos",
                    headers:{
                        'Authorization':'Bearer '+$('meta[name=api-token]').attr('content')
                    },
                    sending:function(file, xhr, formData){
                        formData.append('_token', $('input[name=_token]').val());
                        formData.append('action', 'uploadPhotos');
                        photo.status.files_is_uploading = true;
                        formData.append('orientation', file.orientation);
                    },
                    init:function(){
                        photo.data.uploadPhotos = photo.dom.uploadZone.data('photos')?photo.dom.uploadZone.data('photos'):[];
                    }
                }
            );
            // photo.uploadZone.on('init',function(){
            //     var files = photo.dom.uploadZone.data('photos');
            //     if(files && files.length > 0) {
            //         files.forEach(function(file,index){
            //             var mockFile = { name: file.name, size: file.origin.size };
            //             photo.uploadZone.emit("addedfile", mockFile);
            //             photo.uploadZone.options.thumbnail.call(photo.uploadZone, mockFile, '/'+file.origin.uri);
            //             // Make sure that there is no progress bar, etc...
            //             photo.uploadZone.emit("complete", mockFile);
            //         })
            //     }
            // });
            photo.uploadZone.on('complete',function(file){
                photo.status.files_is_uploading = false;
                console.log('upload completed');
            });
            photo.uploadZone.on('canceled',function(file){
                photo.status.files_is_uploading = false;
            });
            photo.uploadZone.on('success',function(file, response ){
                if(file.reload == undefined || file.reload ==  "undefined" || !file.reload){
                    // attach response into remove link for later use
                    $(file._removeLink).data('photo',response);
                    // add response to list
                    photo.model.addNewPhoto(response);
                    // update photo list
                    photo.model.updateUploadPhotos();
                }

            });
            photo.uploadZone.on('removedfile',function(file){
                console.log(file);
                var p = $(file._removeLink).data('photo');
                photo.model.removePhoto(p);

            });
            photo.uploadZone.on('processing',function(file){
                // sound like user was logged in then the uploading was success
                // let download other photos

            });
            photo.uploadZone.on('queuecomplete',function(e){
                // sound like all files uploaded,

            });
        }
    },
    model:{
        addNewPhoto:function(p){
            photo.data.uploadPhotos.push(p);
        },
        removePhoto:function(p){
            // remove the photo that have unit id by timestamp
            photo.data.uploadPhotos.forEach(function(ph,index){
                if(ph.id.toFixed(3) == p.id.toFixed(3)){
                    photo.data.uploadPhotos.splice(index,1);
                }
            });
            photo.model.updateUploadPhotos();
        },
        updateUploadPhotos:function () {
            photo.dom.uploadZone.data('photos',photo.data.uploadPhotos);
        }
    },
    init:function () {
        photo.view.setupUploadPhotos();
        photo.dom.removePhoto.on('click',photo.controller.removePhoto);
    }
}
// window.photo = photo;
window.photo.init();