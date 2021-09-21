<?php


namespace CarlosFranco\DetectSql\Library;


use Illuminate\Database\Query\Builder;

class NestedSql
{
    protected static $instance;

    protected $builds;

    private function __construct()
    {
    }

    public static function instance(): NestedSql
    {
        if (self::$instance !== null) {
            return self::$instance;
        }
        self::$instance = new static();
        return self::$instance;
    }

    public function addBuilder(Builder $build): void
    {
        $this->builds[] = $build;
    }

    public function getBuilds()
    {
        return $this->builds;
    }


    public function resolve()
    {
        $tables = [];

        foreach ($this->getBuilds() as $build) {

            //判断是否为同一语句，不同where
            /**
             * 无论是否有子查询，只需要判断table，以及where字段是否多次重复即可
             */
            /** @var Builder $build */
            $table = $build->from;
            $wheres = $build->wheres;
            $tables[$table][] = $wheres;
        }

        $this->isNested($tables);
    }

    protected function isNested(array $tables)
    {
        foreach ($tables as $wheres) {
            if (count($wheres) === 1) {
                continue;
            }
            dump($wheres);
        }
    }


}