<?php


namespace CarlosFranco\DetectSql\Library;


use Illuminate\Database\Query\Builder;
use CarlosFranco\DetectSql\Exceptions\EnvException;

class SqlDetect
{

    /** @var self */
    protected static $instance;

    protected $nestedObj;


    private function __construct(){}

    public static function instance()
    {
        if (self::$instance !== null) {
            return self::$instance;
        }
        self::$instance = new static();
        return self::$instance;
    }

    /**
     * 1. N+1
     * 2. join 层次过高
     * 3. 没有走索引
     * 4. join了但是触发block nested loop
     */
    public function resolveSql()
    {
        //执行环境检测
        if ($this->isCli()) {
            //暂不支持cli模式
//            throw new EnvException("暂不支持cli模式");
        }

        $builder = $this->getCurrentBuilderByStrace();

//        $resolve = new DisassembleQuery($builder);
//
//        $resolve->explainSql();

        $this->nestedObj->addBuilder($builder);
    }

    public function setNestedSqlObject($nestedObj)
    {
        $this->nestedObj = $nestedObj;
        return $this;
    }


    /**
     * 不支持cli
     * @return bool
     */
    protected function isCli(): bool
    {
        return preg_match("/cli/i", php_sapi_name()) ? true : false;
    }


    /**
     * 获取当前语句执行的builder
     * @return Builder|null
     */
    protected function getCurrentBuilderByStrace(): ?Builder
    {
        $strace = debug_backtrace();
        foreach ($strace as $item) {
            if (!isset($item['class']) && !isset($item['object'])) continue;
            if ($this->isBuilder($item['class'])) {
                return $item['object'];
            }
        }
        return null;
    }

    /**
     * 是否为builder类
     * @param string $objName
     * @return bool
     */
    protected function isBuilder(string $objName)
    {
        if ($objName === 'Illuminate\Database\Query\Builder') {
            return true;
        }
        return false;
    }
}