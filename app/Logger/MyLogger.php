<?php


namespace App\Logger;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MyLogger
{
    protected $logger;

    public function __construct()
    {
        $this->logger = new Logger('my_logger');

        $logFile = storage_path('logs/my_logger.log');
        $this->logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
    }

    public function log($message, $level = Logger::INFO)
    {
        // Log the message with the specified level
        $this->logger->log($level, $message);
    }
}
