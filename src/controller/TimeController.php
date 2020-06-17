<?php
namespace Src\Controller;

use Src\Services\Clock;

class TimeController {

    private $requestMethod;
    private $earthTime;

    /**
     * @var Clock
     */
    private $clock;

    public function __construct($requestMethod, $earthTime)
    {
        $this->requestMethod = $requestMethod;
        $this->earthTime = $earthTime;
        $this->clock = new Clock(new \DateTimeImmutable($earthTime));
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getMarsTime($this->earthTime);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getMarsTime()
    {
        $result = [
            'Mars Sol Date' => $this->clock->marsSolDate(),
            'Martian Coordinated Time' => $this->clock->martianCoordinatedTime()
        ];
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
