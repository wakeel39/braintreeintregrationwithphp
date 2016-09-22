<?php 
require_once 'braintree/lib/Braintree.php';
/*
created by : wikianwer
Decription : 
*/
class BraintreePayment
{
	
	private $environment="sandbox"; //sandbox | production
	private $merchanId="kgjrhbcb755vdztt"; //master merchan_id of braintree
	private $publicKey="j6d4nrkhjn6wjc2z"; //public key of braintree
	private $privateKey="2faf381b2591a03c00c355d2181a3681"; //private key of braintree
	
	
	//constructor 
	function BraintreePayment()
	{
		Braintree_Configuration::environment($this->environment);
		Braintree_Configuration::merchantId($this->merchanId);
		Braintree_Configuration::publicKey($this->publicKey);
		Braintree_Configuration::privateKey($this->privateKey);
	}
	
	/************************************/
	/*	Customer Section 
	/***********************************/
	
	/*
	create customer id firstName company email and phone and website are required
	@params id 
	@params firstName 
	@params company
	@params email
	@params phone
	@params website
	@response array 
	*/
	
	public function CreateCustomer($userInfo=array())
	{
		try {
			$customer = Braintree_Customer::create(array(
						'id' => $userInfo['id'],
						'firstName' => $userInfo['firstName'],
						'company' => $userInfo['company'],
						'email' => $userInfo['email'],
						'phone' => $userInfo['phone'],
						'website' => $userInfo['website'],
			));
			return $this->getResponse(1,$customer);
	
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
	}
	
	/*
	update customer id firstName company email and phone and website are required
	
	@params id  //element of array
	@params firstName 
	@params company
	@params email
	@params phone
	@params website
	@response array 
	*/
	
	public function UpdateCustomer($userInfo=array())
	{
		try {
			$customer = Braintree_Customer::update(array(
						'id' => $userInfo['id'],
						'firstName' => $userInfo['firstName'],
						'company' => $userInfo['company'],
						'email' => $userInfo['email'],
						'phone' => $userInfo['phone'],
						'website' => $userInfo['website'],
			));
			return $this->getResponse(1,$customer);
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
			
		}
	}
	
	/*
	find customer userid are required
	@params userId 
	@response array 
	*/
	
	public function FindCustomer($userId)
	{
		try {
			$customer = Braintree_Customer::find($userId);
			
			return $this->getResponse(1,$customer);
		}
		catch(Exception $e) {
			return $this->getResponse(0,$e);
			
		}
		catch(Braintree_Exception_NotFound $e) {
			return $this->getResponse(0,$e);
		}
		
		catch(Braintree_Exception_Authentication $e) {
			return $this->getResponse(0,$e);
		}
		
		catch(Braintree_Exception_Authorization $e) {
			return $this->getResponse(0,$e);
		}
		catch(Braintree_Exception_Configuration $e) {
			return $this->getResponse(0,$e);
		}
		
		catch(Braintree_Exception_DownForMaintenance $e) {
			return $this->getResponse(0,$e);
		}
		catch(Braintree_Exception_ForgedQueryString $e) {
			return $this->getResponse(0,$e);
		}
		
		catch(Braintree_Exception_InvalidChallenge $e) {
			return $this->getResponse(0,$e);
		}
		
		catch(Braintree_Exception_InvalidSignature $e) {
			return $this->getResponse(0,$e);
		}
		
		catch(Braintree_Exception_ServerError $e) {
			return $this->getResponse(0,$e);
		}
		catch(Braintree_Exception_SSLCertificate $e) {
			return $this->getResponse(0,$e);
		}
		catch(Braintree_Exception_TooManyRequests $e) {
			return $this->getResponse(0,$e);
		}
		catch(Braintree_Exception_UpgradeRequired $e) {
			return $this->getResponse(0,$e);
		}
	}
	
	
	/*
	delete customer userid are required
	@params userId 
	@response array 
	*/
	
	public function DeleteCustomer($userId)
	{
		try {
			$customer = Braintree_Customer::delete($userId);
			return $this->getResponse(1,$customer);
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
			
		}
	}
	
	/*
	get Customer Token
	@params token //customer card token no 
	@response array 
	*/
	
	public function CustomerToken($cid) {
		try {
			$clientToken = Braintree_ClientToken::generate(array(
						'customerId' =>$cid,
			));
			return $this->getResponse(1,$clientToken);
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
	}
	
	/************************************/
	/*	Customer card Section 
	/***********************************/
	
	/*
	create card by nounce cid are required 
	@params cid customer id 
	@response array 
	note : nounce is a encrepated information of card which is created from client side mobile end 
	*/
	
	public function CreateCard($cid,$nounce) {
		
		try {
			$card = Braintree_PaymentMethod::create(array(
				'customerId' =>$cid,
				'paymentMethodNonce' => $nounce,
				'options' => array(
								'makeDefault' => true
							  ),

			));
			return $this->getResponse(1,$card);
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
		
	}
	
	/*
	UPDATE card by nounce token are required 
	@params token //card token  
	@response array 
	note : nounce is a encrepated information of card which is created from client side mobile end 
	*/
	
	public function UpdateCard($token,$nounce) {
		
		try {
			$card = Braintree_PaymentMethod::create(array(
				'token' =>$token,
				'paymentMethodNonce' => $nounce,
			));
			return $this->getResponse(1,$card);
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
		
	}
	/*
	make card to default tokenare required 
	@params token  
	*/
	
	public function MakeDefault($token)
	{
		try
		{
			$card = Braintree_PaymentMethod::update(
			  $token,
			  array(
				'options' => array(
				  'makeDefault' => true
				)
			  
			  )
			);
			return $this->getResponse(1,$card);
		}catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
	}
	/*
	delete card token are required 
	@params token  
	*/
	public function DeleteCard($token)
	{
		try
		{
			$card = Braintree_PaymentMethod::delete($token);
			return $this->getResponse(1,$card);
		}catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
	
	}
	/*
	generate Nounce
	@params token of card // customer card token no 
	@response array 
	*/
	
	private function GenerateNounce($token) 
	{
		
		try {
			$result = Braintree_PaymentMethodNonce::create($token);
			//$nonce = $result->paymentMethodNonce->nonce;
			return $this->getResponse(1,$result);
		} catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
	}
	
	/************************************/
	/*	Customer card Section  end
	/***********************************/
	
	/************************************/
	/*	Payment section start
	/***********************************/
	
	
	
	
	/*
	payment with credit card
	@params token of card // customer card token no 
	@params amount you wanna pay 
	@response array 
	@url : https://developers.braintreepayments.com/guides/marketplace/create/php
	*/
	public function PaymentWithCreditCard($amount,$token) 
	{
	
		$n = $this->GenerateNounce($token);
		if($n['success']==1) 
		{ 
			$nonce = $n['data']->paymentMethodNonce->nonce;
			  try {
				$paymentResult = Braintree_Transaction::sale(array(
						'amount' => $amount,
						//'merchantAccountId' => $params["MerchantAccountId"],
						'paymentMethodNonce' => $nonce,
						'options' => array(
						  'submitForSettlement' => true,
						),
						//'serviceFeeAmount' => $params["percentageamount"]
				));
				return $this->getResponse(1,$paymentResult);
			} catch (Exception $e) {
				return $this->getResponse(0,$e);
			}
		}
		else {
			return $this->getResponse(1,$n['data']);
		}
	}
	
	/************************************/
	/*	merchent section start
	/***********************************/
	
	
	/*
	find merchent 
	@params mid merchenet id   
	*/
	public function FindSubMerchant($mid)
	{
		try
		{
			$merchant = Braintree_MerchantAccount::find($mid);
			return $this->getResponse(1,$merchant);
		}catch (Exception $e) {
			return $this->getResponse(0,$e);
		}
	
	}
	/*
	create new merchent 
	@params firstName first name  required
	@params lastName lastName  required
	@params email email required
	@params streetAddress  streetAddress  required
	@params postalCode  postalCode  required
	@params locality  locality  required
	@params region  region  required
	@params dateOfBirth date of birth   required
	@params dbaName dba name  required
	@params taxId tax id   required
	@params routingNumber routing number  required
	@params accountNumber account no   required
	@params masterMerchantAccountId id of master Merchant account    required
	@params descriptor description   required
	
	
	@url : https://developers.braintreepayments.com/reference/request/merchant-account/create/php	
	*/
	public function CreateSubMerchant($params) {
		
		try {
		$merchantdata = array( 'individual' =>array( 'firstName' => $params['firstName'], 
								 'lastName' => $params['lastName'],
								 'email' => $params['email'],
								
								 'address' => array( 'streetAddress' =>$params['streetAddress'],
													 'postalCode' => $params['postalCode'],
													 'locality' => $params['locality'],
													 'region' => $params['region'], 
													),
											 'dateOfBirth' =>$params['dateOfBirth'],
											
											 ),
								 'business' => array( 'dbaName' => $params['dbaName'], 
													 'legalName' => $params['legalName'],
													 'taxId' => $params['taxId'], 
													 ),
								 'funding' => array( 'routingNumber' => $params['routingNumber'],
													'accountNumber' => $params['accountNumber'],
													'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK, 
													'descriptor' => $params['descriptor'], 
												),
					'tosAccepted' => true,
					'masterMerchantAccountId' => $params['masterMerchantAccountId']
					);
					
			$merchant = Braintree_MerchantAccount::create($merchantdata);
			return $this->getResponse(1,$merchant);
		
		} catch (Exception $e) {
				  
			return $this->getResponse(0,$e);
		
		}
		
	}
		/*
		update merchent 
		@params mid merchant id  required
		@params firstName first name  required
		@params lastName lastName  required
		@params email email required
		@params streetAddress  streetAddress  required
		@params postalCode  postalCode  required
		@params locality  locality  required
		@params region  region  required
		@params dateOfBirth date of birth   required
		@params dbaName dba name  required
		@params taxId tax id   required
		@params routingNumber routing number  required
		@params accountNumber account no   required
		@params masterMerchantAccountId id of master Merchant account    required
		@params descriptor description   required
		
		
		@url : https://developers.braintreepayments.com/reference/request/merchant-account/update/php	
		*/
		public function UpdateSubMerchant($mid,$params) 
		{
		
		try {
		$merchantdata = array( 'individual' =>array( 'firstName' => $params['firstName'], 
								 'lastName' => $params['lastName'],
								 'email' => $params['email'],
								
								 'address' => array( 'streetAddress' =>$params['streetAddress'],
													 'postalCode' => $params['postalCode'],
													 'locality' => $params['locality'],
													 'region' => $params['region'], 
													),
											 'dateOfBirth' =>$params['dateOfBirth'],
											
											 ),
								 'business' => array( 'dbaName' => $params['dbaName'], 
													 'legalName' => $params['legalName'],
													 'taxId' => $params['taxId'], 
													 ),
								 'funding' => array( 'routingNumber' => $params['routingNumber'],
													'accountNumber' => $params['accountNumber'],
													'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK, 
													'descriptor' => $params['descriptor'], 
												),
					'tosAccepted' => true,
					'masterMerchantAccountId' => $params['masterMerchantAccountId']
					);
					
			$merchant = Braintree_MerchantAccount::update($mid,$merchantdata);
			return $this->getResponse(1,$merchant);
		
		} catch (Exception $e) {
				  
			return $this->getResponse(0,$e);
		
		}

	}
	
	
	
	
	
	/************************************/
	/*	other functions section start
	/***********************************/
	
	/*
	get response
	@params success 1 or 0 only 
	@response array 
	*/
	
	private function getResponse($success,$data) 
	{
		//echo $success; exit;
		if($success==1) {
            $Errors="";
            foreach($data->errors->deepAll() AS $error) {
                $Errors .= $error->message;
            }
            return array("success"=>0,"data"=>$Errors);
        }

        else {
            return array("success"=>$success,"data"=>$data->getMessage());
        }
		
	}
	

	
//end class
}


/*$bt = new BraintreePayment();
$userInfo=array();
$userInfo['id']=21;
$userInfo['firstName']="wikianwer";
$userInfo['company']="testcompamy";
$userInfo['email']="wakeel_3@test.com";
$userInfo['phone']=212222;
$userInfo['website']="http://wiki.com"; */

//$c = $bt->CreateCustomer($userInfo);
//$clientToken = $bt->Customertoken(21);
//print_r($clientToken); exit;
//$nounce = $bt->GenerateNounce('jrv8fw');
//$nounce = "0376f001-223e-4f0a-9e38-8fdb64d457c2";
//$data = $bt->CreateCard(21,$nounce);
//$amount = 100;
//$token="jrv8fw";
//$nounce = $bt->PaymentWithCreditCard($amount,$token);

//print_r($nounce);



?>
