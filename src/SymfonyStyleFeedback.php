<?php
declare(strict_types=1);

namespace Linku\SymfonyStyleFeedback;

use Linku\Feedback\Feedback;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

final class SymfonyStyleFeedback implements Feedback
{
    /**
     * @var SymfonyStyle
     */
    private $io;

    public function __construct(SymfonyStyle $io)
    {
        $this->io = $io;
    }

    public function exception(Throwable $exception): void
    {
        $this->error($exception->getMessage());
    }

    public function warning(string $message): void
    {
        $this->io->text('<fg=yellow>'.$message.'</>');
    }

    public function error(string $message): void
    {
        $this->io->text('<fg=red>'.$message.'</>');
    }

    public function info(string $message): void
    {
        $this->io->text($message);
    }

    public function success(string $message): void
    {
        $this->io->success($message);
    }

    public function startProcess(int $total = 0): void
    {
        $this->io->writeln('');
        $this->io->progressStart($total);
    }

    public function finishProcess(): void
    {
        $this->io->progressFinish();
    }

    public function advanceProcess(int $steps = 1): void
    {
        $this->io->progressAdvance($steps);
    }
}
