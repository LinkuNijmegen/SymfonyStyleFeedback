<?php
declare(strict_types=1);

namespace Linku\SymfonyStyleFeedback\Tests;

use Linku\SymfonyStyleFeedback\SymfonyStyleFeedback;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use RuntimeException;
use Symfony\Component\Console\Style\SymfonyStyle;

final class SymfonyStyleFeedbackTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var SymfonyStyle|ObjectProphecy
     */
    private $symfonyStyle;

    /**
     * @var SymfonyStyleFeedback
     */
    private $testSubject;

    protected function setUp(): void
    {
        $this->symfonyStyle = $this->prophesize(SymfonyStyle::class);

        $this->testSubject = new SymfonyStyleFeedback(
            $this->symfonyStyle->reveal()
        );
    }

    public function testException(): void
    {
        $exceptionMessage = 'Something went wrong!';
        $exception = new RuntimeException($exceptionMessage);
        $expectedText = '<fg=red>'.$exceptionMessage.'</>';

        $this->symfonyStyle->text($expectedText)
            ->shouldBeCalledOnce();

        $this->testSubject->exception($exception);
    }

    public function testWarning(): void
    {
        $message = 'Something went wrong!';
        $expectedText = '<fg=yellow>'.$message.'</>';

        $this->symfonyStyle->text($expectedText)
            ->shouldBeCalledOnce();

        $this->testSubject->warning($message);
    }

    public function testError(): void
    {
        $message = 'Something went wrong!';
        $expectedText = '<fg=red>'.$message.'</>';

        $this->symfonyStyle->text($expectedText)
            ->shouldBeCalledOnce();

        $this->testSubject->error($message);
    }

    public function testInfo(): void
    {
        $message = 'Something happened.';

        $this->symfonyStyle->text($message)
            ->shouldBeCalledOnce();

        $this->testSubject->info($message);
    }

    public function testSuccess(): void
    {
        $message = 'Something went right!';

        $this->symfonyStyle->success($message)
            ->shouldBeCalledOnce();

        $this->testSubject->success($message);
    }

    public function testStartProcess(): void
    {
        $defaultTotal = 0;

        $this->symfonyStyle->writeln('')
            ->shouldBeCalledOnce();
        $this->symfonyStyle->progressStart($defaultTotal)
            ->shouldBeCalledOnce();

        $this->testSubject->startProcess();
    }

    public function testStartProcessWithTotal(): void
    {
        $total = 25;

        $this->symfonyStyle->writeln('')
            ->shouldBeCalledOnce();
        $this->symfonyStyle->progressStart($total)
            ->shouldBeCalledOnce();

        $this->testSubject->startProcess($total);
    }

    public function testFinishProcess(): void
    {
        $this->symfonyStyle->progressFinish()
            ->shouldBeCalledOnce();

        $this->testSubject->finishProcess();
    }

    public function testAdvanceProcess(): void
    {
        $defaultSteps = 1;

        $this->symfonyStyle->progressAdvance($defaultSteps)
            ->shouldBeCalledOnce();

        $this->testSubject->advanceProcess();
    }

    public function testAdvanceProcessWithSteps(): void
    {
        $steps = 5;

        $this->symfonyStyle->progressAdvance($steps)
            ->shouldBeCalledOnce();

        $this->testSubject->advanceProcess($steps);
    }
}
