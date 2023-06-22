<?php

namespace Onetoweb\GlsFreight;

use Onetoweb\GlsFreight\Exception\{SocketException, ResponseException};
use Onetoweb\GlsFreight\Annotations\Readers\Reader\{TagReader, ArrayReader};
use Onetoweb\GlsFreight\Annotations\Mappers\Mapper\{TagMapper, ArrayMapper};
use Onetoweb\GlsFreight\Message\{LabelRequest, LabelResponse};
use Onetoweb\GlsFreight\LabelWriter;
use DateTime;

/**
 * Gls Freight Client.
 */
class Client
{
    /**
     * @var string
     */
    private $host;
    
    /**
     * @var int
     */
    private $port;
    
    /**
     * @param string
     */
    private $contactId;
    
    /**
     * @param string
     */
    private $customerId;
    
    /**
     * @param string
     */
    private $customerNumber;
    
    /**
     * @param string
     */
    private $shippingSoftware;
    
    /**
     * @param string
     */
    private $version;
    
    /**
     * Message constants.
     */
    public const GLS_PREFIX = '\\\\\\\\\\GLS\\\\\\\\\\';
    public const GLS_POSTFIX = '/////GLS/////';
    public const GLS_CG = "\r\n";
    
    /**
     * @param string $host
     * @param int $port
     * @param string $contactId,
     * @param string $customerId,
     * @param string $customerNumber,
     * @param string $shippingSoftware,
     * @param string $version
     */
    public function __construct(
        string $host,
        int $port,
        string $contactId,
        string $customerId,
        string $customerNumber,
        string $shippingSoftware,
        string $version
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->contactId = $contactId;
        $this->customerId = $customerId;
        $this->customerNumber = $customerNumber;
        $this->shippingSoftware = $shippingSoftware;
        $this->version = $version;
    }
    
    /**
     * @param $socket
     * 
     * @return SocketException
     */
    private function createSocketException($socket): SocketException
    {
        $code = socket_last_error($socket);
        $message = socket_strerror($code);
        
        return new SocketException($message, $code);
    }
    
    /**
     * @param array $request
     * 
     * @return string
     */
    private function buildMessage(array $request): string
    {
        $message = '';
        
        foreach ($request as $key => $value) {
            
            $message .= implode(':', [$key, $value]) . '|';
        }
        
        // add prefix, postfix and cg
        return self::GLS_PREFIX.$message.self::GLS_POSTFIX.self::GLS_CG;
    }
    
    /**
     * @param string $response
     * 
     * @throws ResponseException if the response contains a error
     * 
     * @return array
     */
    private function processResponse(string $response): array
    {
        $message = str_replace([self::GLS_PREFIX, self::GLS_POSTFIX, self::GLS_CG], '', $response);
        
        $data = [];
        foreach (explode('|', $message) as $keyValue) {
            
            if (str_contains($keyValue, ':')) {
                
                list(
                    $key,
                    $value
                ) = explode(':', $keyValue, 2);
                
                $data[$key] = $value;
            }
        }
        
        if (!isset($data['E000'])) {
            
            $code = 0;
            $exceptionMessage = 'unknown response';
            foreach ($data as $key => $value) {
                
                if (str_starts_with($key, 'E')) {
                    
                    $code = (int) ltrim($key, 'E');
                    $exceptionMessage = $value;
                }
            }
            
            $responseException = (new ResponseException($exceptionMessage, $code))
                ->setData($data)
                ->setResponseMessage($message)
            ;
            
            throw $responseException;
        }
        
        return $data;
    }
    
    /**
     * @param string $message
     * 
     * @return string
     * 
     * @throws SocketException if socket connection can not be made
     * @throws SocketException if the socket connection can not be written to
     * @throws SocketException if the socket connection can not be read from
     */
    public function request(string $message): string
    {
        // create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        
        // connect socket
        if (socket_connect($socket, $this->host, $this->port) === false) {
            throw $this->createSocketException($socket);
        }
        
        $length = mb_strlen($message);
        
        if (socket_write($socket, $message, $length) === false) {
            throw $this->createSocketException($socket);
        }
        
        $data = null;
        do {
            
            if (($buffer = socket_read($socket, 1024, PHP_BINARY_READ)) === false) {
                throw $this->createSocketException($socket);
            }
            
            $data .= $buffer;
            
        } while ($buffer !== self::GLS_CG);
        
        // close socket
        socket_close($socket);
        
        return $data;
    }
    
    /**
     * @param string $country = 'NL'
     * 
     * @throws ResponseException if the response cannot be read
     * 
     * @return DateTime
     */
    public function getSystemDateTime(string $country = 'NL'): DateTime
    {
        $message = $this->buildMessage([
            'F0002' => null,
            'T100' => $country,
        ]);
        
        $response = $this->request($message);
        
        $data = $this->processResponse($response);
        
        if (!isset($data['T9950'])) {
            
            throw new ResponseException('unknown response');
        }
        
        return DateTime::createFromFormat('dmYHis', $data['T9950']);
    }
    
    /**
     * Create label
     * 
     * @param LabelRequest $labelRequest
     * 
     * @return LabelResponse
     */
    public function createLabel(LabelRequest $labelRequest): LabelResponse
    {
        // add client data
        $labelRequest
            ->setShippingSoftware($this->shippingSoftware)
            ->setVersion($this->version)
            ->setCustomerNumber($this->customerNumber)
            ->setContactId($this->contactId)
            ->setCustomerId($this->customerId)
        ;
        
        // map label request
        $data = (new TagMapper())->map($labelRequest);
        
        // build message
        $message = $this->buildMessage($data);
        
        // make request
        $response = $this->request($message);
        
        // process repsonse
        $processedResponse = $this->processResponse($response);
        
        // read tags
        $labelResponse = (new TagReader())->read($processedResponse, LabelResponse::class);
        
        return $labelResponse;
    }
    
    /**
     * Create label from array
     * 
     * @param array $data
     * @param bool $generatePdf = true
     * 
     * @return array
     */
    public function createLabelFromArray(array $data, bool $generatePdf = true): array
    {
        // create label request from array
        $labelRequest = (new ArrayReader())->read($data, LabelRequest::class);
        
        // use label request to create label
        $labelResponse = $this->createLabel($labelRequest);
        
        // make array from label response
        $labelArray = (new ArrayMapper())->map($labelResponse);
        
        if ($generatePdf) {
            
            // create pdf from label label response
            $pdfBase64 = (new LabelWriter($labelResponse))->getBase64();
            
            // add pdf to label array
            $labelArray['pdf_base64'] = $pdfBase64;
        }
        
        return $labelArray;
    }
    
    /**
     * Cancel unit
     * 
     * @return bool
     */
    public function cancelUnit(string $unitNumber): bool
    {
        $message = $this->buildMessage([
            'T000' => $unitNumber,
            'T805' => $this->customerNumber,
            'T050' => $this->shippingSoftware,
            'T051' => $this->version,
        ]);
        
        $response = $this->request($message);
        
        $data = $this->processResponse($response);
        
        return isset($data['E000']);
    }
    
    /**
     * Close all
     * 
     * @return bool
     */
    public function closeAll(): bool
    {
        $message = $this->buildMessage([
            'T090' => 'DAYEND-END',
            'T805' => $this->customerNumber,
        ]);
        
        $response = $this->request($message);
        
        $data = $this->processResponse($response);
        
        return isset($data['E000']);
    }
    
    /**
     * Close Unit
     * 
     * @return bool
     */
    public function closeUnit(string $unitNumber): bool
    {
        $message = $this->buildMessage([
            'T090' => 'DAYEND',
            'T805' => $this->customerNumber,
            'T400' => $unitNumber
        ]);
        
        $response = $this->request($message);
        
        $data = $this->processResponse($response);
        
        return isset($data['E000']);
    }
    
    /**
     * Close Unit Final
     * 
     * @return bool
     */
    public function closeUnitFinal(string $unitNumber): bool
    {
        $message = $this->buildMessage([
            'T090' => 'DAYEND-END',
            'T805' => $this->customerNumber,
            'T400' => $unitNumber
        ]);
        
        $response = $this->request($message);
        
        $data = $this->processResponse($response);
        
        return isset($data['E000']);
    }
}