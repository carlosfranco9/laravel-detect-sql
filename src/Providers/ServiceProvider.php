<?php


namespace CarlosFranco\DetectSql\Providers;


use CarlosFranco\DetectSql\Library\NestedSql;
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
        $nestedObj = NestedSql::instance();
        $this->app['events']->listen(QueryExecuted::class, function (QueryExecuted $query) use (&$nestedObj) {
            if (strpos($query->sql, 'explain') !== false) {
                return;
            }
            try {
                SqlDetect::instance()->setNestedSqlObject($nestedObj)->resolveSql();
            } catch (\Exception $e) {
                dump($e);
            }
        });
        //注册生命周期结束的钩子
        $func = function () use (&$nestedObj) {
            $nestedObj->resolve();

        };
        $this->app->terminating($func);
    }


}