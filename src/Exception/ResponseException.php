<?php

namespace Onetoweb\GlsFreight\Exception;

use Exception;

/**
 * Response Exception.
 */
class ResponseException extends Exception
{
    /**
     * @var array
     */
    private $data;
    
    /**
     * @var string
     */
    private $responseMessage;
    
    /**
     * @param array $data
     * 
     * @return self
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getData(): ?array
    {
        return $this->data;
    }
    
    /**
     * @param string $responseMessage
     * 
     * @return self
     */
    public function setResponseMessage(string $responseMessage): self
    {
        $this->responseMessage = $responseMessage;
        
        return $this;
    }
    
    /**
     * @param string
     */
    public function getResponseMessage(): ?string
    {
        return $this->responseMessage;
    }
}