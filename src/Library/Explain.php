<?php


namespace CarlosFranco\DetectSql\Library;


class Explain
{

    protected $selectType;
    protected $table;
    protected $partitions;
    protected $type;
    protected $possibleKeys;
    protected $key;
    protected $keyLen;
    protected $ref;
    protected $rows;
    protected $filtered;
    protected $extra;

    public function __construct(array $result, int $count)
    {
        $this->selectType = $result['select_type'];
        $this->table = $result['table'];
        $this->partitions = $result['partitions'];
        $this->type = $result['type'];
        $this->possibleKeys = $result['possible_keys'];
        $this->key = $result['key'];
        $this->keyLen = $result['key_len'];
        $this->ref = $result['ref'];
        $this->rows = $result['rows'];
        $this->filtered = $result['filtered'];
        $this->extra = $result['Extra'];
    }

    public function resolveResult()
    {

    }


}