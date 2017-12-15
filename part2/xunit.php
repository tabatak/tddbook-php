<?php
declare(strict_types=1);

class TestCase
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    
    public function setUp(): void
    {
        //pass
    }

    public function tearDown(): void
    {
        //pass
    }

    public function run(TestResult $result): void
    {
        $result->testStarted();
        $this->setUp();
        try{
            call_user_func([$this, $this->name]);
        }catch(Exception $e){
            $result->testFailed();
        }
        $this->tearDown();
    }
}

class WasRun extends TestCase
{
    private $log;

    public function setUp(): void
    {
        $this->wasRun = false;
        $this->log = 'setUp ';
    }

    public function testMethod(): void
    {
        $this->log .= 'testMethod ';
    }

    public function testBrokenMethod(): void
    {
        throw new Exception();
    }

    public function tearDown(): void
    {
        $this->log .= 'tearDown ';
    }

    public function log(): string
    {
        return $this->log;
    }
}

class TestResult
{
    private $runCount = 0;
    private $errorCount = 0;

    public function testStarted(): void
    {
        $this->runCount += 1;
    }

    public function testFailed(): void
    {
        $this->errorCount += 1;
    }

    public function summary(): string
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
    }
}

class TestSuite
{
    private $tests = [];

    public function add(TestCase $test): void
    {
        $this->tests[] = $test;
    }

    public function run(TestResult $result): void
    {
        foreach($this->tests as $test){
            $test->run($result);
        }
    }
}

class TestCaseTest extends TestCase
{
    private $result;
    public function setUp(): void
    {
        $this->result = new TestResult();
    }

    public function testTemplateMethod(): void
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert('setUp testMethod tearDown ' == $test->log());
    }

    public function testResult(): void
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert('1 run, 0 failed' == $this->result->summary());
    }

    public function testFailedResult(): void
    {
        $test = new WasRun('testBrokenMethod');
        $test->run($this->result);
        assert('1 run, 1 failed' == $this->result->summary());
    }

    public function testFailedResultFormatting(): void
    {
        // TestResult単独のテスト
        $this->result->testStarted();
        $this->result->testFailed();
        assert('1 run, 1 failed' == $this->result->summary());
    }

    public function testSuite(): void
    {
        $suite = new TestSuite();
        $suite->add(new WasRun("testMethod"));
        $suite->add(new WasRun("testBrokenMethod"));
        $suite->run($this->result);
        assert('2 run, 1 failed' == $this->result->summary());
    }
}

$suite = new TestSuite();
$suite->add(new TestCaseTest("testTemplateMethod"));
$suite->add(new TestCaseTest("testResult"));
$suite->add(new TestCaseTest("testFailedResult"));
$suite->add(new TestCaseTest("testFailedResultFormatting"));
$suite->add(new TestCaseTest("testSuite"));
$result = new TestResult();
$suite->run($result);
print($result->summary());
