<?php


namespace CarlosFranco\DetectSql\Providers;


use CarlosFranco\DetectSql\Library\SqlDetect;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->registerDBListen();
    }


    protected function coverBuilderToSql()
    {
        $this->app->registerConfiguredProviders();
    }


    public function registerDBListen()
    {
        $this->app['events']->listen(QueryExecuted::class, function (QueryExecuted $query) {
            try {
                SqlDetect::instance()->resolveSql();
            } catch (\Exception $e) {
                //
            }
        });
    }




}