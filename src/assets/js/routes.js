window.route = {
    uploadPhoto:'/api/upload/photo',
    media:'/api/media/list/{type}',
    updateArticle:'/api/article/update',
    updateArticlePage:'/admin/article/edit/{id}',
    addArticle:'/api/article/create',
    deleteArticle:'/api/article/delete/{id}',
    articleDetail:'/content/{slug}',

    addCategory:'/api/category/create',
    deleteCategory:'/api/category/delete/{id}',
    categoryDetail:'/category/{slug}',
    updateCategory:'/api/category/update',
    updateCategoryPage:'/admin/category/edit/{id}',

    root: window.location.origin || document.origin,
    generate:function(routeName,pars){
        if(routeName !== undefined) {
            let url = routeName;
            if (typeof pars === 'array' || typeof pars === 'object') {
                for(let k in pars) {
                    if(pars.hasOwnProperty(k)){
                        let parameter = '{'+k+'}';
                        url = url.replace(parameter,pars[k]);
                    }
                }
                if(url.search('{') > -1) {
                    console.error('missing parameter ' + routeName);
                    return false;
                }
                return url;
            }else{
                if(url.search('{') > -1) {
                    console.error('missing parameter');
                    return false;
                }
                return routeName;
            }
        }else{
            console.error('route' + routeName + 'not found!');
            return false;
        }
    },
    redirect:function(routeName,pars){
        if(pars === undefined) pars = {};

        var url = route.generate(routeName,pars);
        if(url !== false) {
            window.location = route.root + url;
        }

    },
    init:function(){

    }
};
window.route.init();
