<?php

namespace Onetoweb\GlsFreight\Message;

use Onetoweb\GlsFreight\Annotation\Tag;
use DateTime;

/**
 * Label.
 */
class LabelRequest
{
    /**
     * @Tag(name="T000", key="unit_number", type="string")
     * 
     * @var string
     */
    private $unitNumber;
    
    /**
     * @Tag(name="T050", key="shipping_software", type="string")
     * 
     * @var string
     */
    private $shippingSoftware;
    
    /**
     * @Tag(name="T051", key="version", type="string")
     * 
     * @var string
     */
    private $version;
    
    /**
     * @Tag(name="T200", key="product_type", type="string")
     * 
     * @var string
     */
    private $productType;
    
    /**
     * @Tag(name="T210", key="freight_Terms", type="string")
     * 
     * @var string
     */
    private $freightTerms;
    
    /**
     * @Tag(name="T8904", key="sequence", type="string")
     * 
     * @var string
     */
    private $sequence;
    
    /**
     * @Tag(name="T8905", key="quantity", type="string")
     * 
     * @var string
     */
    private $quantity;
    
    /**
     * @Tag(name="T400", key="gls_unit_number", type="string")
     * 
     * @var string
     */
    private $glsUnitNumber;
    
    /**
     * @Tag(name="T530", key="weight", type="string")
     * 
     * @var string
     */
    private $weight;
    
    /**
     * @Tag(name="T854", key="reference", type="string")
     * 
     * @var string
     */
    private $reference;
    
    /**
     * @Tag(name="T8914", key="contact_id", type="string")
     * 
     * @var string
     */
    private $contactId;
    
    /**
     * @Tag(name="T805", key="customer_number", type="string")
     * 
     * @var string
     */
    private $customerNumber;
    
    /**
     * @Tag(name="T8915", key="customer_id", type="string")
     * 
     * @var string
     */
    private $customerId;
    
    /**
     * @Tag(name="T759", key="contact", type="string")
     * 
     * @var string
     */
    private $contact;
    
    /**
     * @Tag(name="T758", key="phone", type="string")
     * 
     * @var string
     */
    private $phone;
    
    /**
     * @Tag(name="T920", key="note1", type="string")
     * 
     * @var string
     */
    private $note1;
    
    /**
     * @Tag(name="T921", key="note2", type="string")
     * 
     * @var string
     */
    private $note2;
    
    /**
     * @Tag(name="T909", key="text_for_returns", type="string")
     * 
     * @var string
     */
    private $textForReturns;
    
    /**
     * @Tag(name="TPT", key="package_type", type="string")
     * 
     * @var string
     */
    private $packageType;
    
    /**
     * @Tag(name="T881", key="phone_if_pick_up", type="string")
     * 
     * @var string
     */
    private $phoneIfPickUp;
    
    /**
     * @Tag(name="TCCI", key="code_special_contract", type="string")
     * 
     * @var string
     */
    private $codeSpecialContract;
    
    /**
     * @Tag(name="TEUP", key="euro_pallets_exchange", type="string")
     * 
     * @var string
     */
    private $euroPalletsExchange;
    
    /**
     * @Tag(name="TLG", key="unit_length", type="string")
     * 
     * @var string
     */
    private $unitLength;
    
    /**
     * @Tag(name="TPOD", key="request_proof_of_delivery", type="string")
     * 
     * @var string
     */
    private $requestProofOfDelivery;
    
    /**
     * @Tag(name="T1267", key="freight", type="bool", options={"bool_values": {"Y": true}})
     * 
     * @var bool
     */
    private $freight = false;
    
    /**
     * @Tag(name="T644", key="requested_delivery_date", type="datetime", format="d.m.Y")
     * 
     * @var DateTime
     */
    private $requestedDeliveryDate;
    
    /**
     * @Tag(name="T545", key="shipping_date", type="datetime", format="d.m.Y")
     *
     * @var DateTime
     */
    private $shippingDate;
    
    /**
     * @Tag(name="T908", key="pick_up_date", type="datetime", format="d.m.Y")
     * 
     * @var DateTime
     */
    private $pickUpDate;
    
    /**
     * @Tag(name="T810", key="consignor_name1", type="string")
     * 
     * @var string
     */
    private $consignorName1;
    
    /**
     * @Tag(name="T811", key="consignor_name2", type="string")
     * 
     * @var string
     */
    private $consignorName2;
    
    /**
     * @Tag(name="T812", key="consignor_name3", type="string")
     * 
     * @var string
     */
    private $consignorName3;
    
    /**
     * @Tag(name="T820", key="consignor_street", type="string")
     * 
     * @var string
     */
    private $consignorStreet;
    
    /**
     * @Tag(name="T822", key="consignor_zipcode", type="string")
     * 
     * @var string
     */
    private $consignorZipcode;
    
    /**
     * @Tag(name="T823", key="consignor_city", type="string")
     * 
     * @var string
     */
    private $consignorCity;
    
    /**
     * @Tag(name="T821", key="consignor_country", type="string")
     * 
     * @var string
     */
    private $consignorCountry;
    
    /**
     * @Tag(name="T1231", key="consignor_email", type="string")
     * 
     * @var string
     */
    private $consignorEmail;
    
    /**
     * @Tag(name="T860", key="consignee_name1", type="string")
     * 
     * @var string
     */
    private $consigneeName1;
    
    /**
     * @Tag(name="T861", key="consignee_name2", type="string")
     * 
     * @var string
     */
    private $consigneeName2;
    
    /**
     * @Tag(name="T862", key="consignee_name3", type="string")
     * 
     * @var string
     */
    private $consigneeName3;
    
    /**
     * @Tag(name="T863", key="consignee_street", type="string")
     * 
     * @var string
     */
    private $consigneeStreet;
    
    /**
     * @Tag(name="T330", key="consignee_zipcode", type="string")
     * 
     * @var string
     */
    private $consigneeZipcode;
    
    /**
     * @Tag(name="T864", key="consignee_city", type="string")
     * 
     * @var string
     */
    private $consigneeCity;
    
    /**
     * @Tag(name="T100", key="consignee_country", type="string")
     * 
     * @var string
     */
    private $consigneeCountry;
    
    /**
     * @Tag(name="T1229", key="consignee_email", type="string")
     * 
     * @var string
     */
    private $consigneeEmail;
    
    /**
     * @Tag(name="T900", key="pick_up_name1", type="string")
     * 
     * @var string
     */
    private $pickUpName1;
    
    /**
     * @Tag(name="T901", key="pick_up_name2", type="string")
     * 
     * @var string
     */
    private $pickUpName2;
    
    /**
     * @Tag(name="T902", key="pick_up_name3", type="string")
     * 
     * @var string
     */
    private $pickUpName3;
    
    /**
     * @Tag(name="T903", key="pick_up_street", type="string")
     * 
     * @var string
     */
    private $pickUpStreet;
    
    /**
     * @Tag(name="T905", key="pick_up_zipcode", type="string")
     * 
     * @var string
     */
    private $pickUpZipcode;
    
    /**
     * @Tag(name="T906", key="pick_up_city", type="string")
     * 
     * @var string
     */
    private $pickUpCity;
    
    /**
     * @Tag(name="T904", key="pick_up_country", type="string")
     * 
     * @var string
     */
    private $pickUpCountry;
    
    /**
     * @Tag(name="T907", key="pick_up_phone", type="string")
     * 
     * @var string
     */
    private $pickUpPhone;
    
    /**
     * @return string
     */
    public function getUnitNumber(): ?string
    {
        return $this->unitNumber;
    }
    
    /**
     * @param string $unitNumber = null
     * 
     * @return self
     */
    public function setUnitNumber(string $unitNumber = null): self
    {
        $this->unitNumber = $unitNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getShippingSoftware(): ?string
    {
        return $this->shippingSoftware;
    }
    
    /**
     * @param string $shippingSoftware = null
     * 
     * @return self
     */
    public function setShippingSoftware(string $shippingSoftware = null): self
    {
        $this->shippingSoftware = $shippingSoftware;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }
    
    /**
     * @param string $version = null
     * 
     * @return self
     */
    public function setVersion(string $version = null): self
    {
        $this->version = $version;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getProductType(): ?string
    {
        return $this->productType;
    }
    
    /**
     * @param string $productType = null
     * 
     * @return self
     */
    public function setProductType(string $productType = null): self
    {
        $this->productType = $productType;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getFreightTerms(): ?string
    {
        return $this->freightTerms;
    }
    
    /**
     * @param string $freightTerms = null
     * 
     * @return self
     */
    public function setFreightTerms(string $freightTerms = null): self
    {
        $this->freightTerms = $freightTerms;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSequence(): ?string
    {
        return $this->sequence;
    }
    
    /**
     * @param string $sequence = null
     * 
     * @return self
     */
    public function setSequence(string $sequence = null): self
    {
        $this->sequence = $sequence;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getQuantity(): ?string
    {
        return $this->quantity;
    }
    
    /**
     * @param string $quantity = null
     * 
     * @return self
     */
    public function setQuantity(string $quantity = null): self
    {
        $this->quantity = $quantity;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getGlsUnitNumber(): ?string
    {
        return $this->glsUnitNumber;
    }
    
    /**
     * @param string $glsUnitNumber = null
     * 
     * @return self
     */
    public function setGlsUnitNumber(string $glsUnitNumber = null): self
    {
        $this->glsUnitNumber = $glsUnitNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }
    
    /**
     * @param string $weight = null
     * 
     * @return self
     */
    public function setWeight(string $weight = null): self
    {
        $this->weight = $weight;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }
    
    /**
     * @param string $reference = null
     * 
     * @return self
     */
    public function setReference(string $reference = null): self
    {
        $this->reference = $reference;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getContactId(): ?string
    {
        return $this->contactId;
    }
    
    /**
     * @param string $contactId = null
     * 
     * @return self
     */
    public function setContactId(string $contactId = null): self
    {
        $this->contactId = $contactId;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }
    
    /**
     * @param string $customerNumber = null
     * 
     * @return self
     */
    public function setCustomerNumber(string $customerNumber = null): self
    {
        $this->customerNumber = $customerNumber;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }
    
    /**
     * @param string $customerId = null
     * 
     * @return self
     */
    public function setCustomerId(string $customerId = null): self
    {
        $this->customerId = $customerId;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }
    
    /**
     * @param string $contact = null
     * 
     * @return self
     */
    public function setContact(string $contact = null): self
    {
        $this->contact = $contact;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    
    /**
     * @param string $phone = null
     * 
     * @return self
     */
    public function setPhone(string $phone = null): self
    {
        $this->phone = $phone;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getNote1(): ?string
    {
        return $this->note1;
    }
    
    /**
     * @param string $note1 = null
     * 
     * @return self
     */
    public function setNote1(string $note1 = null): self
    {
        $this->note1 = $note1;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getNote2(): ?string
    {
        return $this->note2;
    }
    
    /**
     * @param string $note2 = null
     * 
     * @return self
     */
    public function setNote2(string $note2 = null): self
    {
        $this->note2 = $note2;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTextForReturns(): ?string
    {
        return $this->textForReturns;
    }
    
    /**
     * @param string $textForReturns = null
     * 
     * @return self
     */
    public function setTextForReturns(string $textForReturns = null): self
    {
        $this->textForReturns = $textForReturns;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPackageType(): ?string
    {
        return $this->packageType;
    }
    
    /**
     * @param string $packageType = null
     * 
     * @return self
     */
    public function setPackageType(string $packageType = null): self
    {
        $this->packageType = $packageType;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPhoneIfPickUp(): ?string
    {
        return $this->phoneIfPickUp;
    }
    
    /**
     * @param string $phoneIfPickUp = null
     * 
     * @return self
     */
    public function setPhoneIfPickUp(string $phoneIfPickUp = null): self
    {
        $this->phoneIfPickUp = $phoneIfPickUp;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCodeSpecialContract(): ?string
    {
        return $this->codeSpecialContract;
    }
    
    /**
     * @param string $codeSpecialContract = null
     * 
     * @return self
     */
    public function setCodeSpecialContract(string $codeSpecialContract = null): self
    {
        $this->codeSpecialContract = $codeSpecialContract;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEuroPalletsExchange(): ?string
    {
        return $this->euroPalletsExchange;
    }
    
    /**
     * @param string $euroPalletsExchange = null
     * 
     * @return self
     */
    public function setEuroPalletsExchange(string $euroPalletsExchange = null): self
    {
        $this->euroPalletsExchange = $euroPalletsExchange;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getUnitLength(): ?string
    {
        return $this->unitLength;
    }
    
    /**
     * @param string $unitLength = null
     * 
     * @return self
     */
    public function setUnitLength(string $unitLength = null): self
    {
        $this->unitLength = $unitLength;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getRequestProofOfDelivery(): ?string
    {
        return $this->requestProofOfDelivery;
    }
    
    /**
     * @param string $requestProofOfDelivery = null
     * 
     * @return self
     */
    public function setRequestProofOfDelivery(string $requestProofOfDelivery = null): self
    {
        $this->requestProofOfDelivery = $requestProofOfDelivery;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isFreight(): ?bool
    {
        return $this->freight;
    }
    
    /**
     * @param bool $freight = null
     * 
     * @return self
     */
    public function setFreight(bool $freight = null): self
    {
        $this->freight = $freight;
        
        return $this;
    }
    
    /**
     * @return DateTime
     */
    public function getRequestedDeliveryDate(): ?DateTime
    {
        return $this->requestedDeliveryDate;
    }
    
    /**
     * @param DateTime $requestedDeliveryDate = null
     * 
     * @return self
     */
    public function setRequestedDeliveryDate(DateTime $requestedDeliveryDate = null): self
    {
        $this->requestedDeliveryDate = $requestedDeliveryDate;
        
        return $this;
    }
    
    
    /**
     * @return DateTime
     */
    public function getShippingDate(): ?DateTime
    {
        return $this->shippingDate;
    }
    
    /**
     * @param DateTime $shippingDate = null
     * 
     * @return self
     */
    public function setShippingDate(DateTime $shippingDate = null): self
    {
        $this->shippingDate = $shippingDate;
        
        return $this;
    }
    
    /**
     * @return DateTime
     */
    public function getPickUpDate(): ?DateTime
    {
        return $this->pickUpDate;
    }
    
    /**
     * @param DateTime $pickUpDate = null
     *
     * @return self
     */
    public function setPickUpDate(DateTime $pickUpDate = null): self
    {
        $this->pickUpDate = $pickUpDate;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorName1(): ?string
    {
        return $this->consignorName1;
    }
    
    /**
     * @param string $consignorName1 = null
     *
     * @return self
     */
    public function setConsignorName1(string $consignorName1 = null): self
    {
        $this->consignorName1 = $consignorName1;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorName2(): ?string
    {
        return $this->consignorName2;
    }
    
    /**
     * @param string $consignorName2 = null
     *
     * @return self
     */
    public function setConsignorName2(string $consignorName2 = null): self
    {
        $this->consignorName2 = $consignorName2;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorName3(): ?string
    {
        return $this->consignorName3;
    }
    
    /**
     * @param string $consignorName3 = null
     *
     * @return self
     */
    public function setConsignorName3(string $consignorName3 = null): self
    {
        $this->consignorName3 = $consignorName3;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorStreet(): ?string
    {
        return $this->consignorStreet;
    }
    
    /**
     * @param string $consignorStreet = null
     *
     * @return self
     */
    public function setConsignorStreet(string $consignorStreet = null): self
    {
        $this->consignorStreet = $consignorStreet;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorZipcode(): ?string
    {
        return $this->consignorZipcode;
    }
    
    /**
     * @param string $consignorZipcode = null
     *
     * @return self
     */
    public function setConsignorZipcode(string $consignorZipcode = null): self
    {
        $this->consignorZipcode = $consignorZipcode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorCity(): ?string
    {
        return $this->consignorCity;
    }
    
    /**
     * @param string $consignorCity = null
     *
     * @return self
     */
    public function setConsignorCity(string $consignorCity = null): self
    {
        $this->consignorCity = $consignorCity;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorCountry(): ?string
    {
        return $this->consignorCountry;
    }
    
    /**
     * @param string $consignorCountry = null
     *
     * @return self
     */
    public function setConsignorCountry(string $consignorCountry = null): self
    {
        $this->consignorCountry = $consignorCountry;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsignorEmail(): ?string
    {
        return $this->consignorEmail;
    }
    
    /**
     * @param string $consignorEmail = null
     *
     * @return self
     */
    public function setConsignorEmail(string $consignorEmail = null): self
    {
        $this->consignorEmail = $consignorEmail;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeName1(): ?string
    {
        return $this->consigneeName1;
    }
    
    /**
     * @param string $consigneeName1 = null
     *
     * @return self
     */
    public function setConsigneeName1(string $consigneeName1 = null): self
    {
        $this->consigneeName1 = $consigneeName1;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeName2(): ?string
    {
        return $this->consigneeName2;
    }
    
    /**
     * @param string $consigneeName2 = null
     *
     * @return self
     */
    public function setConsigneeName2(string $consigneeName2 = null): self
    {
        $this->consigneeName2 = $consigneeName2;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeName3(): ?string
    {
        return $this->consigneeName3;
    }
    
    /**
     * @param string $consigneeName3 = null
     *
     * @return self
     */
    public function setConsigneeName3(string $consigneeName3 = null): self
    {
        $this->consigneeName3 = $consigneeName3;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeStreet(): ?string
    {
        return $this->consigneeStreet;
    }
    
    /**
     * @param string $consigneeStreet = null
     *
     * @return self
     */
    public function setConsigneeStreet(string $consigneeStreet = null): self
    {
        $this->consigneeStreet = $consigneeStreet;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeZipcode(): ?string
    {
        return $this->consigneeZipcode;
    }
    
    /**
     * @param string $consigneeZipcode = null
     *
     * @return self
     */
    public function setConsigneeZipcode(string $consigneeZipcode = null): self
    {
        $this->consigneeZipcode = $consigneeZipcode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeCity(): ?string
    {
        return $this->consigneeCity;
    }
    
    /**
     * @param string $consigneeCity = null
     *
     * @return self
     */
    public function setConsigneeCity(string $consigneeCity = null): self
    {
        $this->consigneeCity = $consigneeCity;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeCountry(): ?string
    {
        return $this->consigneeCountry;
    }
    
    /**
     * @param string $consigneeCountry = null
     *
     * @return self
     */
    public function setConsigneeCountry(string $consigneeCountry = null): self
    {
        $this->consigneeCountry = $consigneeCountry;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConsigneeEmail(): ?string
    {
        return $this->consigneeEmail;
    }
    
    /**
     * @param string $consigneeEmail = null
     *
     * @return self
     */
    public function setConsigneeEmail(string $consigneeEmail = null): self
    {
        $this->consigneeEmail = $consigneeEmail;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpName1(): ?string
    {
        return $this->pickUpName1;
    }
    
    /**
     * @param string $pickUpName1 = null
     *
     * @return self
     */
    public function setPickUpName1(string $pickUpName1 = null): self
    {
        $this->pickUpName1 = $pickUpName1;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpName2(): ?string
    {
        return $this->pickUpName2;
    }
    
    /**
     * @param string $pickUpName2 = null
     *
     * @return self
     */
    public function setPickUpName2(string $pickUpName2 = null): self
    {
        $this->pickUpName2 = $pickUpName2;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpName3(): ?string
    {
        return $this->pickUpName3;
    }
    
    /**
     * @param string $pickUpName3 = null
     *
     * @return self
     */
    public function setPickUpName3(string $pickUpName3 = null): self
    {
        $this->pickUpName3 = $pickUpName3;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpStreet(): ?string
    {
        return $this->pickUpStreet;
    }
    
    /**
     * @param string $pickUpStreet = null
     *
     * @return self
     */
    public function setPickUpStreet(string $pickUpStreet = null): self
    {
        $this->pickUpStreet = $pickUpStreet;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpZipcode(): ?string
    {
        return $this->pickUpZipcode;
    }
    
    /**
     * @param string $pickUpZipcode = null
     *
     * @return self
     */
    public function setPickUpZipcode(string $pickUpZipcode = null): self
    {
        $this->pickUpZipcode = $pickUpZipcode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpCity(): ?string
    {
        return $this->pickUpCity;
    }
    
    /**
     * @param string $pickUpCity = null
     *
     * @return self
     */
    public function setPickUpCity(string $pickUpCity = null): self
    {
        $this->pickUpCity = $pickUpCity;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpCountry(): ?string
    {
        return $this->pickUpCountry;
    }
    
    /**
     * @param string $pickUpCountry = null
     *
     * @return self
     */
    public function setPickUpCountry(string $pickUpCountry = null): self
    {
        $this->pickUpCountry = $pickUpCountry;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPickUpPhone(): ?string
    {
        return $this->pickUpPhone;
    }
    
    /**
     * @param string $pickUpPhone = null
     *
     * @return self
     */
    public function setPickUpPhone(string $pickUpPhone = null): self
    {
        $this->pickUpPhone = $pickUpPhone;
        
        return $this;
    }
}
