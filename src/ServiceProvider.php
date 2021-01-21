<?php
namespace CMS;

use CMS\Livewire\Editor;
use CMS\Blocks\ImageBlock\ImageBlock;
use CMS\Blocks\TextBlock\TextBlock;
use CMS\Blocks\YoutubeBlock\YoutubeBlock;
use CMS\Models\Category;
use CMS\Models\Post;
use CMS\Models\PostBlock;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use Livewire\Livewire;
use Livewire\LivewireBladeDirectives;

class ServiceProvider extends SupportServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cms.php', 'cms');

        $this->registerPostBlocks();
        $this->registerMigrations();

        $this->registerRouteModelBinding();
        $this->registerRoutes();

        $this->registerBladeHelpers();
        $this->registerViews();
        $this->registerLivewireComponents();
    }

    public function registerPostBlocks()
    {
        $registeredBlocks = collect(PostBlock::getRegisteredBlocks());

        $registeredBlocks->each(function($class, $type) {
            Livewire::component("cms::blocks.{$type}", $class::$component);
            $this->loadViewsFrom((new $class)->componentViews(), "cms-blocks-{$type}");
            Relation::morphMap([
                $type => $class
            ]);
        });
    }

    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');
    }

    public function registerRouteModelBinding()
    {
        Route::model('post', Post::class);
        Route::model('category', Category::class);
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }

    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'cms');
    }

    public function registerLivewireComponents()
    {
        Livewire::component('cms::editor', Editor::class);
    }

    public function registerBladeHelpers()
    {
        Blade::directive('cmsStyles', function($expression){
            return '
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            '. PHP_EOL . LivewireBladeDirectives::livewireStyles($expression);
        });

        Blade::directive('cmsScripts', function($expression){
            return '
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
            '. PHP_EOL . LivewireBladeDirectives::livewireScripts($expression);
        });
    }
}