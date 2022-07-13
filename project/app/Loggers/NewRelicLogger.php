<?php

namespace App\Loggers;

use Monolog\Logger;
use Illuminate\Http\Request;
use Monolog\Handler\BufferHandler;
use NewRelic\Monolog\Enricher\{Handler, Processor};

class NewRelicLogger
{
    protected $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    public function __invoke(array $config)
    {
        // add the new relic logger
        $log = new Logger('newrelic');
        $log->pushProcessor(new Processor);
        $handler = new Handler;

        $handler->setFormatter(new NewRelicFormatter);

        // Optional - if you don't have the new relic php agent installed.
        //$handler->setLicenseKey('0123456789abcdef0123456789abcdef01234567');

        // using the BufferHandler improves the performance by batching the log
        // messages to the end of the request
        $log->pushHandler(new BufferHandler($handler));

        foreach ($log->getHandlers() as $handler) {
            $handler->pushProcessor([$this, 'includeMetaData']);
        }

        return $log;
    }

    // lets add some extra metadata to every request
    public function includeMetaData(array $record): array
    {
        // set the service or app name to the record
        $record['service'] = env('APP_NAME');

        // set the hostname to record so we know host this was created on
        $record['hostname'] = gethostname();

        // check to see if we have a request
        if($this->request){

            $record['extra'] += [
                'ip' => $this->request->getClientIp(),
            ];

            // get the authenticated user
            $user = auth()->user();

            // add the user information
            if($user){
                $record['user'] = [
                    'id' => $user->id ?? null,
                    'email' => $user->email ?? 'guest',
                ];
            }
        }
        return $record;
    }
}
