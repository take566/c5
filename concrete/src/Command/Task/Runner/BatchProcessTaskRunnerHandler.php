<?php
namespace Concrete\Core\Command\Task\Runner;

use Concrete\Core\Command\Batch\Stamp\BatchStamp;
use Concrete\Core\Command\Task\Output\OutputInterface;
use Concrete\Core\Command\Task\Runner\Context\ContextInterface;
use Concrete\Core\Command\Task\Stamp\OutputStamp;

defined('C5_EXECUTE') or die("Access Denied.");

class BatchProcessTaskRunnerHandler extends ProcessTaskRunnerHandler
{

    /**
     * @param BatchProcessTaskRunner $runner
     */
    public function run(TaskRunnerInterface $runner, ContextInterface $context)
    {
        $batch = $runner->getBatch();
        $process = $runner->getProcess();
        $batchEntity = $this->processFactory->createBatchEntity($batch);
        $process->setBatch($batchEntity);

        $messages = $batch->getWrappedMessages($batchEntity);
        $total = count($messages);
        $this->processFactory->setBatchTotal($batchEntity, $process, $total);

        foreach ($messages as $message) {
            $context->dispatchCommand($message, [new BatchStamp($batchEntity->getId())]);
        }
    }

}
