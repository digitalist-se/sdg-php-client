<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SdgScoped\Symfony\Component\VarDumper\Cloner;

use SdgScoped\Symfony\Component\VarDumper\Caster\Caster;
use SdgScoped\Symfony\Component\VarDumper\Exception\ThrowingCasterException;
/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = ['__PHP_Incomplete_Class' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\Caster', 'castPhpIncompleteClass'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\CutStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castCutArray'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ConstStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\EnumStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castEnum'], 'Fiber' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\FiberCaster', 'castFiber'], 'Closure' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClosure'], 'Generator' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castGenerator'], 'ReflectionType' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castType'], 'ReflectionAttribute' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castAttribute'], 'ReflectionGenerator' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReflectionGenerator'], 'ReflectionClass' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClass'], 'ReflectionClassConstant' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClassConstant'], 'ReflectionFunctionAbstract' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castFunctionAbstract'], 'ReflectionMethod' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castMethod'], 'ReflectionParameter' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castParameter'], 'ReflectionProperty' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castProperty'], 'ReflectionReference' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReference'], 'ReflectionExtension' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castExtension'], 'ReflectionZendExtension' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castZendExtension'], 'SdgScoped\\Doctrine\\Common\\Persistence\\ObjectManager' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Doctrine\\Common\\Proxy\\Proxy' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castCommonProxy'], 'SdgScoped\\Doctrine\\ORM\\Proxy\\Proxy' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castOrmProxy'], 'SdgScoped\\Doctrine\\ORM\\PersistentCollection' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castPersistentCollection'], 'SdgScoped\\Doctrine\\Persistence\\ObjectManager' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'DOMException' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castException'], 'DOMStringList' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNameList' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMImplementation' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castImplementation'], 'DOMImplementationList' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNode' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNode'], 'DOMNameSpaceNode' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNameSpaceNode'], 'DOMDocument' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocument'], 'DOMNodeList' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNamedNodeMap' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMCharacterData' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castCharacterData'], 'DOMAttr' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castAttr'], 'DOMElement' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castElement'], 'DOMText' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castText'], 'DOMTypeinfo' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castTypeinfo'], 'DOMDomError' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDomError'], 'DOMLocator' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLocator'], 'DOMDocumentType' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocumentType'], 'DOMNotation' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNotation'], 'DOMEntity' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castEntity'], 'DOMProcessingInstruction' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castProcessingInstruction'], 'DOMXPath' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castXPath'], 'XMLReader' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster', 'castXmlReader'], 'ErrorException' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castErrorException'], 'Exception' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castException'], 'Error' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castError'], 'SdgScoped\\Symfony\\Bridge\\Monolog\\Logger' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Symfony\\Component\\EventDispatcher\\EventDispatcherInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Symfony\\Component\\HttpClient\\AmpHttpClient' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'SdgScoped\\Symfony\\Component\\HttpClient\\CurlHttpClient' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'SdgScoped\\Symfony\\Component\\HttpClient\\NativeHttpClient' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'SdgScoped\\Symfony\\Component\\HttpClient\\Response\\AmpResponse' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'SdgScoped\\Symfony\\Component\\HttpClient\\Response\\CurlResponse' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'SdgScoped\\Symfony\\Component\\HttpClient\\Response\\NativeResponse' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'SdgScoped\\Symfony\\Component\\HttpFoundation\\Request' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castRequest'], 'SdgScoped\\Symfony\\Component\\Uid\\Ulid' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castUlid'], 'SdgScoped\\Symfony\\Component\\Uid\\Uuid' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castUuid'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castThrowingCasterException'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\TraceStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castTraceStub'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\FrameStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFrameStub'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Symfony\\Component\\ErrorHandler\\Exception\\SilencedErrorContext' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castSilencedErrorContext'], 'SdgScoped\\Imagine\\Image\\ImageInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ImagineCaster', 'castImage'], 'SdgScoped\\Ramsey\\Uuid\\UuidInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\UuidCaster', 'castRamseyUuid'], 'SdgScoped\\ProxyManager\\Proxy\\ProxyInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster', 'castProxy'], 'PHPUnit_Framework_MockObject_MockObject' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\PHPUnit\\Framework\\MockObject\\MockObject' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\PHPUnit\\Framework\\MockObject\\Stub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Prophecy\\Prophecy\\ProphecySubjectInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'SdgScoped\\Mockery\\MockInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'PDO' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdo'], 'PDOStatement' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdoStatement'], 'AMQPConnection' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castConnection'], 'AMQPChannel' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castChannel'], 'AMQPQueue' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castQueue'], 'AMQPExchange' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castExchange'], 'AMQPEnvelope' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castEnvelope'], 'ArrayObject' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayObject'], 'ArrayIterator' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayIterator'], 'SplDoublyLinkedList' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castDoublyLinkedList'], 'SplFileInfo' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileInfo'], 'SplFileObject' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileObject'], 'SplHeap' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'SplObjectStorage' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castObjectStorage'], 'SplPriorityQueue' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'OuterIterator' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castOuterIterator'], 'WeakReference' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakReference'], 'Redis' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'RedisArray' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisArray'], 'RedisCluster' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisCluster'], 'DateTimeInterface' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castDateTime'], 'DateInterval' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castInterval'], 'DateTimeZone' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castTimeZone'], 'DatePeriod' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castPeriod'], 'GMP' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\GmpCaster', 'castGmp'], 'MessageFormatter' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castMessageFormatter'], 'NumberFormatter' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castNumberFormatter'], 'IntlTimeZone' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlTimeZone'], 'IntlCalendar' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlCalendar'], 'IntlDateFormatter' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlDateFormatter'], 'Memcached' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster', 'castMemcached'], 'SdgScoped\\Ds\\Collection' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castCollection'], 'SdgScoped\\Ds\\Map' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castMap'], 'SdgScoped\\Ds\\Pair' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPair'], 'SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPairStub'], 'mysqli_driver' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\MysqliCaster', 'castMysqliDriver'], 'CurlHandle' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':curl' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':dba' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':dba persistent' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], 'GdImage' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':gd' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':mysql link' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castMysqlLink'], ':pgsql large object' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLargeObject'], ':pgsql link' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql link persistent' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql result' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castResult'], ':process' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castProcess'], ':stream' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], 'OpenSSLCertificate' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':OpenSSL X.509' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':persistent stream' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':stream-context' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStreamContext'], 'XmlParser' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], ':xml' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], 'RdKafka' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castRdKafka'], 'SdgScoped\\RdKafka\\Conf' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castConf'], 'SdgScoped\\RdKafka\\KafkaConsumer' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castKafkaConsumer'], 'SdgScoped\\RdKafka\\Metadata\\Broker' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castBrokerMetadata'], 'SdgScoped\\RdKafka\\Metadata\\Collection' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castCollectionMetadata'], 'SdgScoped\\RdKafka\\Metadata\\Partition' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castPartitionMetadata'], 'SdgScoped\\RdKafka\\Metadata\\Topic' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicMetadata'], 'SdgScoped\\RdKafka\\Message' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castMessage'], 'SdgScoped\\RdKafka\\Topic' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopic'], 'SdgScoped\\RdKafka\\TopicPartition' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicPartition'], 'SdgScoped\\RdKafka\\TopicConf' => ['SdgScoped\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicConf']];
    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;
    /**
     * @var array<string, list<callable>>
     */
    private $casters = [];
    /**
     * @var callable|null
     */
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
     */
    public function setMaxItems(int $maxItems)
    {
        $this->maxItems = $maxItems;
    }
    /**
     * Sets the maximum cloned length for strings.
     */
    public function setMaxString(int $maxString)
    {
        $this->maxString = $maxString;
    }
    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     */
    public function setMinDepth(int $minDepth)
    {
        $this->minDepth = $minDepth;
    }
    /**
     * Clones a PHP variable.
     *
     * @param mixed $var    Any PHP variable
     * @param int   $filter A bit field of Caster::EXCLUDE_* constants
     *
     * @return Data
     */
    public function cloneVar($var, int $filter = 0)
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
     * @return array
     */
    protected abstract function doClone($var);
    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array
     */
    protected function castObject(Stub $stub, bool $isNested)
    {
        $obj = $stub->value;
        $class = $stub->class;
        if (\PHP_VERSION_ID < 80000 ? "\x00" === ($class[15] ?? null) : \str_contains($class, "@anonymous\x00")) {
            $stub->class = \get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            [$i, $parents, $hasDebugInfo, $fileInfo] = $this->classInfo[$class];
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
     * @return array
     */
    protected function castResource(Stub $stub, bool $isNested)
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
