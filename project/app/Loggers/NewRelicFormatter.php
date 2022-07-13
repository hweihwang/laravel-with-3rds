<?php

namespace App\Loggers;

use NewRelic\Monolog\Enricher\Formatter;

class NewRelicFormatter extends Formatter
{
    public function __construct(
        $batchMode = self::BATCH_MODE_NEWLINES,
        $appendNewline = true,
        $ignoreEmptyContextAndExtra = true,
        $includeStacktraces = true
    ) {
        parent::__construct($batchMode, $appendNewline);
        $this->ignoreEmptyContextAndExtra = $ignoreEmptyContextAndExtra;
        $this->includeStacktraces = $includeStacktraces;
    }
}
