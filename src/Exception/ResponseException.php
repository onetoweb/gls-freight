<?php

namespace Onetoweb\GlsFreight\Exception;

use Exception;

/**
 * Response Exception.
 */
class ResponseException extends Exception
{
    /**
     * @var array|null
     */
    private $data;
    
    /**
     * @var string|null
     */
    private $responseMessage;
    
    /**
     * @param array $data
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        
        return $this;
    }
    
    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }
    
    /**
     * @param string $responseMessage
     */
    public function setResponseMessage(string $responseMessage): self
    {
        $this->responseMessage = $responseMessage;
        
        return $this;
    }
    
    /**
     * @param string $responseMessage
     */
    public function getResponseMessage(): ?string
    {
        return $this->responseMessage;
    }
}