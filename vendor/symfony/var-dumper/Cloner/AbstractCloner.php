<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\Symfony\Component\VarDumper\Cloner;

use Spatie\WordPressRay\Symfony\Component\VarDumper\Caster\Caster;
use Spatie\WordPressRay\Symfony\Component\VarDumper\Exception\ThrowingCasterException;
/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = ['__PHP_Incomplete_Class' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\Caster', 'castPhpIncompleteClass'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\CutStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castCutArray'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ConstStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\EnumStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castEnum'], 'Closure' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClosure'], 'Generator' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castGenerator'], 'ReflectionType' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castType'], 'ReflectionGenerator' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReflectionGenerator'], 'ReflectionClass' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClass'], 'ReflectionFunctionAbstract' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castFunctionAbstract'], 'ReflectionMethod' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castMethod'], 'ReflectionParameter' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castParameter'], 'ReflectionProperty' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castProperty'], 'ReflectionReference' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReference'], 'ReflectionExtension' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castExtension'], 'ReflectionZendExtension' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castZendExtension'], 'Spatie\\WordPressRay\\Doctrine\\Common\\Persistence\\ObjectManager' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\Doctrine\\Common\\Proxy\\Proxy' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castCommonProxy'], 'Spatie\\WordPressRay\\Doctrine\\ORM\\Proxy\\Proxy' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castOrmProxy'], 'Spatie\\WordPressRay\\Doctrine\\ORM\\PersistentCollection' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castPersistentCollection'], 'Spatie\\WordPressRay\\Doctrine\\Persistence\\ObjectManager' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'DOMException' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castException'], 'DOMStringList' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNameList' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMImplementation' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castImplementation'], 'DOMImplementationList' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNode' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNode'], 'DOMNameSpaceNode' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNameSpaceNode'], 'DOMDocument' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocument'], 'DOMNodeList' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNamedNodeMap' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMCharacterData' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castCharacterData'], 'DOMAttr' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castAttr'], 'DOMElement' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castElement'], 'DOMText' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castText'], 'DOMTypeinfo' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castTypeinfo'], 'DOMDomError' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDomError'], 'DOMLocator' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLocator'], 'DOMDocumentType' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocumentType'], 'DOMNotation' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNotation'], 'DOMEntity' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castEntity'], 'DOMProcessingInstruction' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castProcessingInstruction'], 'DOMXPath' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castXPath'], 'XMLReader' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster', 'castXmlReader'], 'ErrorException' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castErrorException'], 'Exception' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castException'], 'Error' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castError'], 'Spatie\\WordPressRay\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\Symfony\\Component\\EventDispatcher\\EventDispatcherInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\Symfony\\Component\\HttpClient\\CurlHttpClient' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Spatie\\WordPressRay\\Symfony\\Component\\HttpClient\\NativeHttpClient' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Spatie\\WordPressRay\\Symfony\\Component\\HttpClient\\Response\\CurlResponse' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Spatie\\WordPressRay\\Symfony\\Component\\HttpClient\\Response\\NativeResponse' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Spatie\\WordPressRay\\Symfony\\Component\\HttpFoundation\\Request' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castRequest'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castThrowingCasterException'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\TraceStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castTraceStub'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\FrameStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFrameStub'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\Symfony\\Component\\ErrorHandler\\Exception\\SilencedErrorContext' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castSilencedErrorContext'], 'Spatie\\WordPressRay\\Imagine\\Image\\ImageInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ImagineCaster', 'castImage'], 'Spatie\\WordPressRay\\Ramsey\\Uuid\\UuidInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\UuidCaster', 'castRamseyUuid'], 'Spatie\\WordPressRay\\ProxyManager\\Proxy\\ProxyInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster', 'castProxy'], 'PHPUnit_Framework_MockObject_MockObject' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\PHPUnit\\Framework\\MockObject\\MockObject' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\PHPUnit\\Framework\\MockObject\\Stub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\Prophecy\\Prophecy\\ProphecySubjectInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Spatie\\WordPressRay\\Mockery\\MockInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'PDO' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdo'], 'PDOStatement' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdoStatement'], 'AMQPConnection' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castConnection'], 'AMQPChannel' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castChannel'], 'AMQPQueue' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castQueue'], 'AMQPExchange' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castExchange'], 'AMQPEnvelope' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castEnvelope'], 'ArrayObject' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayObject'], 'ArrayIterator' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayIterator'], 'SplDoublyLinkedList' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castDoublyLinkedList'], 'SplFileInfo' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileInfo'], 'SplFileObject' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileObject'], 'SplHeap' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'SplObjectStorage' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castObjectStorage'], 'SplPriorityQueue' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'OuterIterator' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castOuterIterator'], 'WeakReference' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakReference'], 'Redis' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'RedisArray' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisArray'], 'RedisCluster' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisCluster'], 'DateTimeInterface' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castDateTime'], 'DateInterval' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castInterval'], 'DateTimeZone' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castTimeZone'], 'DatePeriod' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castPeriod'], 'GMP' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\GmpCaster', 'castGmp'], 'MessageFormatter' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castMessageFormatter'], 'NumberFormatter' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castNumberFormatter'], 'IntlTimeZone' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlTimeZone'], 'IntlCalendar' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlCalendar'], 'IntlDateFormatter' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlDateFormatter'], 'Memcached' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster', 'castMemcached'], 'Spatie\\WordPressRay\\Ds\\Collection' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castCollection'], 'Spatie\\WordPressRay\\Ds\\Map' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castMap'], 'Spatie\\WordPressRay\\Ds\\Pair' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPair'], 'Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPairStub'], ':curl' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':dba' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':dba persistent' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':gd' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':mysql link' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castMysqlLink'], ':pgsql large object' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLargeObject'], ':pgsql link' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql link persistent' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql result' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castResult'], ':process' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castProcess'], ':stream' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':OpenSSL X.509' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':persistent stream' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':stream-context' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStreamContext'], ':xml' => ['Spatie\\WordPressRay\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml']];
    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;
    private $casters = [];
    private $prevErrorHandler;
    private $classInfo = [];
    private $filter = 0;
    /**
     * @param callable[]|null $casters A map of casters
     *
     * @see addCasters
     */
    public function __construct(array $casters = null)
    {
        if (null === $casters) {
            $casters = static::$defaultCasters;
        }
        $this->addCasters($casters);
    }
    /**
     * Adds casters for resources and objects.
     *
     * Maps resources or objects types to a callback.
     * Types are in the key, with a callable caster for value.
     * Resource types are to be prefixed with a `:`,
     * see e.g. static::$defaultCasters.
     *
     * @param callable[] $casters A map of casters
     */
    public function addCasters(array $casters)
    {
        foreach ($casters as $type => $callback) {
            $this->casters[$type][] = $callback;
        }
    }
    /**
     * Sets the maximum number of items to clone past the minimum depth in nested structures.
     *
     * @param int $maxItems
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = (int) $maxItems;
    }
    /**
     * Sets the maximum cloned length for strings.
     *
     * @param int $maxString
     */
    public function setMaxString($maxString)
    {
        $this->maxString = (int) $maxString;
    }
    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     *
     * @param int $minDepth
     */
    public function setMinDepth($minDepth)
    {
        $this->minDepth = (int) $minDepth;
    }
    /**
     * Clones a PHP variable.
     *
     * @param mixed $var    Any PHP variable
     * @param int   $filter A bit field of Caster::EXCLUDE_* constants
     *
     * @return Data The cloned variable represented by a Data object
     */
    public function cloneVar($var, $filter = 0)
    {
        $this->prevErrorHandler = \set_error_handler(function ($type, $msg, $file, $line, $context = []) {
            if (\E_RECOVERABLE_ERROR === $type || \E_USER_ERROR === $type) {
                // Cloner never dies
                throw new \ErrorException($msg, 0, $type, $file, $line);
            }
            if ($this->prevErrorHandler) {
                return ($this->prevErrorHandler)($type, $msg, $file, $line, $context);
            }
            return \false;
        });
        $this->filter = $filter;
        if ($gc = \gc_enabled()) {
            \gc_disable();
        }
        try {
            return new Data($this->doClone($var));
        } finally {
            if ($gc) {
                \gc_enable();
            }
            \restore_error_handler();
            $this->prevErrorHandler = null;
        }
    }
    /**
     * Effectively clones the PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
     * @return array The cloned variable represented in an array
     */
    protected abstract function doClone($var);
    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The object casted as array
     */
    protected function castObject(Stub $stub, $isNested)
    {
        $obj = $stub->value;
        $class = $stub->class;
        if (\PHP_VERSION_ID < 80000 ? "\x00" === ($class[15] ?? null) : \false !== \strpos($class, "@anonymous\x00")) {
            $stub->class = \get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            list($i, $parents, $hasDebugInfo, $fileInfo) = $this->classInfo[$class];
        } else {
            $i = 2;
            $parents = [$class];
            $hasDebugInfo = \method_exists($class, '__debugInfo');
            foreach (\class_parents($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            foreach (\class_implements($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            $parents[] = '*';
            $r = new \ReflectionClass($class);
            $fileInfo = $r->isInternal() || $r->isSubclassOf(Stub::class) ? [] : ['file' => $r->getFileName(), 'line' => $r->getStartLine()];
            $this->classInfo[$class] = [$i, $parents, $hasDebugInfo, $fileInfo];
        }
        $stub->attr += $fileInfo;
        $a = Caster::castObject($obj, $class, $hasDebugInfo, $stub->class);
        try {
            while ($i--) {
                if (!empty($this->casters[$p = $parents[$i]])) {
                    foreach ($this->casters[$p] as $callback) {
                        $a = $callback($obj, $a, $stub, $isNested, $this->filter);
                    }
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '') . '⚠' => new ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
    /**
     * Casts a resource to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The resource casted as array
     */
    protected function castResource(Stub $stub, $isNested)
    {
        $a = [];
        $res = $stub->value;
        $type = $stub->class;
        try {
            if (!empty($this->casters[':' . $type])) {
                foreach ($this->casters[':' . $type] as $callback) {
                    $a = $callback($res, $a, $stub, $isNested, $this->filter);
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '') . '⚠' => new ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
}
