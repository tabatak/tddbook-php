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

    public function run(): void
    {
        $this->setUp();
        call_user_func([$this, $this->name]);
    }

}

class WasRun extends TestCase
{
    private $wasRun;
    private $wasSetUp;

    public function __construct(string $name)
    {
        //TODO __constructを削除する(chapter19)とwasRun()がコンストラクタと判断されてしまいエラーになる
        parent::__construct($name);
    }

    public function setUp(): void
    {
        $this->wasRun = false;
        $this->wasSetUp = true;
    }

    public function testMethod(): void
    {
        $this->wasRun = true;
    }

    public function wasRun(): bool
    {
        return $this->wasRun;
    }

    public function wasSetUp(): bool
    {
        return $this->wasSetUp;
    }
}

class TestCaseTest extends TestCase
{
    private $test;

    public function setUp(): void
    {
        $this->test = new WasRun('testMethod');
    }

    public function testRunning(): void
    {
        $this->test->run();
        assert($this->test->wasRun());
    }

    public function testSetUp(): void
    {
        $this->test->run();
        assert($this->test->wasSetUp());
    }
}

(new TestCaseTest('testRunning'))->run();
(new TestCaseTest('testSetUp'))->run();