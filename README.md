# Linku/SymfonyStyleFeedback

SymfonyStyleFeedback is an add-on for [linku/feedback](https://github.com/linkunijmegen/feedback)
integrating SymfonyStyle I/O for Symfony Commands

## Installation

```
composer require linku/feedback-symfonystyle
```

## Use

See [linku/feedback](https://github.com/linkunijmegen/feedback) for general
use instructions.

In your Symfony Command, you can use it as follows:

```php
<?php

namespace App\Command;

use Linku\SymfonyStyleFeedback\SymfonyStyleFeedback;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MyCommand extends Command
{
    public static $defaultName = 'app:my-command';

    /**
     * @var MyService 
     */
    private $myService;

    public function __construct(MyService $myService)
    {
        parent::__construct();

        $this->myService = $myService;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->myService->setFeedback(
            new SymfonyStyleFeedback($io)
        );

        $this->myService->run();
    }
}

```
