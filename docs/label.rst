.. _top:
.. title:: Label

`Back to index <index.rst>`_

=====
Label
=====

.. contents::
    :local:


Create label from array
```````````````````````

.. code-block:: php
    
    // shipping date (eg. 3 days from now)
    $shippingDate = (new DateTime())->modify('+3 days');
    
    $result = $client->createLabelFromArray([
        'unit_number' => '197526151',
        'weight' => '250,0',
        'shipping_date' => $shippingDate,
        'reference' => 'test shipment',
        'freight' => true,
        'package_type' => 'BP',
        'sequence' => '001',
        'quantity' => '001',
        'consignor_name1' => 'Name',
        'consignor_name2' => '',
        'consignor_name3' => '',
        'consignor_street' => 'Street 1',
        'consignor_city' => 'City',
        'consignor_zipcode' => '1111AA',
        'consignor_country' => 'NL',
        'consignee_name1' => 'Name',
        'consignee_name2' => '',
        'consignee_name3' => '',
        'consignee_street' => 'Street 1',
        'consignee_city' => 'City',
        'consignee_zipcode' => '1111AA',
    ]);
    
    // contains base64 encoded pdf
    $result['pdf_base64'];


Create label with LabelRequest object
`````````````````````````````````````

.. code-block:: php
    
    use Onetoweb\GlsFreight\Message\LabelRequest;
    
    // shipping date (eg. 3 days from now)
    $shippingDate = (new DateTime())->modify('+3 days');
    
    $labelRequest = (new LabelRequest())
        ->setUnitNumber('197526151')
        ->setWeight('250,0')
        ->setShippingDate($shippingDate)
        ->setReference('test shipment')
        ->setFreight(true)
        ->setPackageType('BP')
        ->setSequence('001')
        ->setQuantity('001')
        ->setConsignorName1('Name')
        ->setConsignorName2('')
        ->setConsignorStreet('Street 1')
        ->setConsignorCity('City')
        ->setConsignorZipcode('1111AA')
        ->setConsignorCountry('NL')
        ->setConsigneeName1('Name')
        ->setConsigneeName2('')
        ->setConsigneeStreet('Street 1')
        ->setConsigneeCity('City')
        ->setConsigneeZipcode('1111AA')
        ->setConsigneeCountry('NL')
    ;
    
    // label 
    $labelResponse = $client->createLabel($labelRequest);
    
    // use label response to write pdf label
    $labelWriter = new LabelWriter($labelResponse);
    
    // output label to browser
    $labelWriter->outputPdf();
    
    // get label base64 encoded
    $labelWriter->getBase64()
    
    // write label to file
    $filename 'path/to/file.pdf';
    $labelWriter->savePdf('/home/gls-freight/label_new.pdf');


Cancel unit
```````````

.. code-block:: php
    
    $glsUnitNumber = '1234567891';
    $result = $client->cancelUnit($glsUnitNumber);


Global closing
``````````````

.. code-block:: php
    
    $result = $client->closeAll();


Close unit
``````````

.. code-block:: php
    
    $glsUnitNumber = '1234567891';
    $result = $client->closeUnit($glsUnitNumber);


Close unit final
````````````````

.. code-block:: php
    
    $glsUnitNumber = '1234567891';
    $result = $client->closeUnitFinal($glsUnitNumber);


`Back to top <#top>`_