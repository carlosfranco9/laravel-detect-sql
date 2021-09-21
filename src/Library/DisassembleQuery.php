<?php


namespace CarlosFranco\DetectSql\Library;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class DisassembleQuery
{
    /**
     * 1. N+1
     * 2. join 层次过高
     * 3. 没有走索引
     * 4. join了但是触发block nested loop
     */
    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }


    public function handle()
    {

    }

    public function explainSql()
    {
        $explainSql = sprintf("explain %s", $this->builder->toSql());
        $explain_result = DB::select($explainSql, $this->builder->getBindings());

        foreach ($explain_result as $item) {
            $item = (array) $item;
            $explain = new Explain($item, 0);
            $explain->resolveResult();
        }
    }

}