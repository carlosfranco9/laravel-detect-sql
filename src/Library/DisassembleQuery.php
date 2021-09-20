<?php


namespace CarlosFranco\DetectSql\Library;


use Illuminate\Database\Query\Builder;

class DisassembleQuery
{
    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }


    public function handle()
    {

    }

    protected function hasJoin()
    {

    }

}