<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 22/12/17
 * Time: 11:49
 */

namespace Sistema\Logger;

use Monolog\Formatter\FormatterInterface;

class Formatter implements FormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format(array $record)
    {
        $out = "[";
        $out .= $record['datetime']->format('d/m/Y H:i:s');
        $out .= "]";

        $out .= " {$record['channel']}.{$record['level_name']}: {$record['message']}";

        $exception = isset($record['context']['exception']) ? $record['context']['exception'] : null;

        if ($exception instanceof \Exception) {
            $out .= "\nExceção[{$exception->getCode()}]: {$exception->getMessage()}\n";
            $out .= "Stack Trace:\n{$exception->getTraceAsString()}";
        }

        return $out . "\n\n";
    }

    /**
     * @inheritDoc
     */
    public function formatBatch(array $records)
    {
        // TODO: Implement formatBatch() method.
    }

}
