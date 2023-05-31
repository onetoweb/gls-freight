.. title:: Index

===========
Basic Usage
===========

Setup

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    use Onetoweb\GlsFreight\Client;
    
    // host / port params
    $host = 'appservices.gls-belgium.com'; // use host services.gls-belgium.com for production
    $port = 3128; // use port 3118 for production
    
    // customer data
    $contactId = 'contact_id';
    $customerId = 'customer_id';
    $customerNumber = 'customer_number';
    $shippingSoftware = 'shipping_software';
    $version = 'version';
    
    // setup client
    $client = new Client(
        $host,
        $port,
        $contactId,
        $customerId,
        $customerNumber,
        $shippingSoftware,
        $version
    );


========
Examples
========

* `System time <time.rst>`_
* `Label <label.rst>`_