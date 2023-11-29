<?php
declare(strict_types=1);

namespace Linku\SymfonyStyleFeedback\Tests;

use Linku\SymfonyStyleFeedback\SymfonyStyleFeedback;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\Console\Style\SymfonyStyle;

final class SymfonyStyleFeedbackTest extends TestCase
{
    /**
     * @var SymfonyStyle|MockObject
     */
    private $symfonyStyle;

    /**
     * @var SymfonyStyleFeedback
     */
    private $testSubject;

    protected function setUp(): void
    {
        $this->symfonyStyle = $this->createMock(SymfonyStyle::class);

        $this->testSubject = new SymfonyStyleFeedback($this->symfonyStyle);
    }

    public function testException(): void
    {
        $exceptionMessage = 'Something went wrong!';
        $exception = new RuntimeException($exceptionMessage);
        $expectedText = '<fg=red>'.$exceptionMessage.'</>';

        $this->symfonyStyle->expects(self::once())
            ->method('text')
            ->with($expectedText);

        $this->testSubject->exception($exception);
    }

    public function testWarning(): void
    {
        $message = 'Something went wrong!';
        $expectedText = '<fg=yellow>'.$message.'</>';

        $this->symfonyStyle->expects(self::once())
            ->method('text')
            ->with($expectedText);

        $this->testSubject->warning($message);
    }

    public function testError(): void
    {
        $message = 'Something went wrong!';
        $expectedText = '<fg=red>'.$message.'</>';

        $this->symfonyStyle->expects(self::once())
            ->method('text')
            ->with($expectedText);

        $this->testSubject->error($message);
    }

    public function testInfo(): void
    {
        $message = 'Something happened.';

        $this->symfonyStyle->expects(self::once())
            ->method('text')
            ->with($message);

        $this->testSubject->info($message);
    }

    public function testSuccess(): void
    {
        $message = 'Something went right!';

        $this->symfonyStyle->expects(self::once())
            ->method('success')
            ->with($message);

        $this->testSubject->success($message);
    }

    public function testStartProcess(): void
    {
        $defaultTotal = 0;

        $this->symfonyStyle->expects(self::once())
            ->method('writeln')
            ->with('');

        $this->symfonyStyle->expects(self::once())
            ->method('progressStart')
            ->with($defaultTotal);

        $this->testSubject->startProcess();
    }

    public function testStartProcessWithTotal(): void
    {
        $total = 25;

        $this->symfonyStyle->expects(self::once())
            ->method('writeln')
            ->with('');

        $this->symfonyStyle->expects(self::once())
            ->method('progressStart')
            ->with($total);

        $this->testSubject->startProcess($total);
    }

    public function testFinishProcess(): void
    {
        $this->symfonyStyle->expects(self::once())
            ->method('progressFinish');

        $this->testSubject->finishProcess();
    }

    public function testAdvanceProcess(): void
    {
        $defaultSteps = 1;

        $this->symfonyStyle->expects(self::once())
            ->method('progressAdvance')
            ->with($defaultSteps);

        $this->testSubject->advanceProcess();
    }

    public function testAdvanceProcessWithSteps(): void
    {
        $steps = 5;

        $this->symfonyStyle->expects(self::once())
            ->method('progressAdvance')
            ->with($steps);

        $this->testSubject->advanceProcess($steps);
    }
}
