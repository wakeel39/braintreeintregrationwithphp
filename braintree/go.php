<?php
	require_once 'lib/Braintree.php';
	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('rrsttfbw88wy3mjh');
	Braintree_Configuration::publicKey('qxhp9qgqwt7jjxhk');
	Braintree_Configuration::privateKey('77cdd598b1a39c24eca2bec8fec4b80b');

	header("content-type:application/json");	
	//	Deleting Customer
	$customer = array();
	try{
		// Finding a Customer
		$customer = Braintree_Customer::find('zaheerappliconiccom923439047625sa');
		print_r($customer); exit;
	}
	catch(Exception $e){
		print_r($customer); exit;
	}
	
	/* $customer = Braintree_Customer::delete('zaheerappliconiccom923439047625');
	print_r($customer); exit; */

	
	//  Create Customer
	$customer = Braintree_Customer::create(
		array(
			'id' => 'zaheerappliconiccom923439047625',
			'firstName' => 'Zaheer',
			'lastName' => 'Abbass',
			'company' => 'Appliconic',
			'email' => 'zaheer@appliconic.com',
			'phone' => '+923439047625',
			'website' => 'http://www.appliconic.com',
			// 'paymentMethodNonce' => 'nonce-from-the-client'
			// 'customFields' => array(
				// 'custom_field_one' => 'custom value',
				// 'custom_field_two' => 'another custom value'
			// )
			
		)
	);
	print_r($customer); exit;
	
	// Update Customer Information
	/* $customer = Braintree_Customer::update(
		'zaheerappliconiccom923439047625',
		array(
			'firstName' => 'Zaheer 11',
			'lastName' => 'Abbass 22',
			'company' => 'Appliconic',
			'email' => 'zaheer@appliconic.com',
			'phone' => '+923439047625',
			'website' => 'http://www.appliconic.com'
		)
	);
	print_r($customer); */
	
	// Generating Cutomer Token as Client
	/* $clientToken = Braintree_ClientToken::generate(array(
		'customerId' => $customer->customer->id
	));
	print_r($clientToken);*/
	
	/* $result = Braintree_Transaction::sale(
		array(
			'paymentMethodToken' => 'the_payment_method_token',
			'amount' => '100.00'
		)
	);	
	print_r($result); */
	
	// Cearting Transection with ID
	/* $result = Braintree_Transaction::sale(
		array(
			'customerId' => 'zaheerappliconiccom923439047625',
			'amount' => '0.01'
		)
	);
	print_r($result); */
	
	// Creating Sale with Nounce
	/* $result = Braintree_Transaction::sale(
		array(
			'amount' => '100.00',
			'paymentMethodNonce' => 'nonce-from-the-client'
		)
	);	
	print_r($result); */

	// Creating Credit Cards
	/* $result = Braintree_CreditCard::create(array(
		'customerId' => '12345',
		'number' => '4111111111111111',
		'expirationDate' => '05/2011',
		'token' => 'the_token'
	));
	print_r($result); */
	
	// Creating Credit Cards
	/* $result = Braintree_CreditCard::create(array(
		'customerId' => '12345',
		'number' => '4111111111111111',
		'expirationDate' => '05/20'
		'cardholderName' => 'The Cardholder',
		'options' => array(
		  'makeDefault' => true
		)
	));
	print_r($result); */
	
?>