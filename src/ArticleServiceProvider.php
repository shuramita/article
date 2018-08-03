<?php

namespace Shuramita\Article;

use Averspace\Admin\ViewComposers\Item;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ArticleServiceProvider extends ServiceProvider
{
    public $namespace = 'Article';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', $this->namespace);

        $this->registerAdminNavigator();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/article.php', 'article');
    }
    public function registerAdminNavigator(){
        app('AdminNavigator')->registerNavigator(
            'article', new Item('Shura CMS','cms','admin','fa-newspaper')
        );
        app('AdminNavigator')->registerSubNavigator(
            'article', new Item('Article','admin_list_articles','admin','fa-newspaper')
        );
//        app('AdminNavigator')->registerSubNavigator(
//            'article', new Item('Fuck','admin_list_fucks','admin','fa-newspaper')
//        );
        app('AdminNavigator')->registerSubNavigator(
            'article', new Item('Category','admin_list_articles_categories','admin','fa-th-list')
        );

    }
}