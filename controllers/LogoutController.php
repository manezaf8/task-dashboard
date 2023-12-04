<?php

namespace Controller;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogoutController
{
    /**
     * @var Logger 
     */
    private $logger;

    public function __construct(Logger $logger = null)
    {
        $this->logger = $logger;
    }

    public function logout()
    {
        $logger = new Logger('logout-controller');
        $logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

        $this->flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        $logger->info("User logged out");
        return redirect('/');
    }

    public function flush()
    {
        $_SESSION = [];
    }
}
