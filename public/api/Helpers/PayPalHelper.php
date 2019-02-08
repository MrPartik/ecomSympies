<?php

include_once('HttpHelper.php');

/**
	*	PayPal helper class for REST API requests.
	*	
*/

class PayPalHelper {
	
	private $_http = null;
	private $_apiUrl = null;
	private $_token = null;
	
	/**
		* 	Class constructor.
		*	
	*/
	public function __construct() {
		$this->_http = new HttpHelper;
		$this->_apiUrl = PAYPAL_ENDPOINTS[PAYPAL_ENVIRONMENT];
	}
	
	/**
		* 	Set PayPal default header for the curl instance.
		*
		* 	@return void
	*/
	private function _setDefaultHeaders() {
		$this->_http->addHeader("PayPal-Partner-Attribution-Id: " . SBN_CODE);
	}
	
	/**
		* 	Create the PayPal REST endpoint url.
		*
		*	Use the configurations and combine resources to create the endpoint.
		*
        *	@param string $resource Url to be called using curl
		* 	@return string REST API url depending on environment.
	*/
	private function _createApiUrl($resource) {
		return $this->_apiUrl . "/" . PAYPAL_REST_VERSION . "/" . $resource;
	}
	
	/**
		* 	Request for PayPal REST oath bearer token.
		*	
		* 	Reset curl helper. 
		*	Set default PayPal headers.
		*	Set curl url.
		*	Set curl credentials.
		*	Set curl body.
		*	Set class token attribute with bearer token.
		*
		* 	@return void
	*/
	private function _getToken() {
		$this->_http->resetHelper();
		$this->_setDefaultHeaders();
		$this->_http->setUrl($this->_createApiUrl("oauth2/token"));
		$this->_http->setAuthentication(PAYPAL_CREDENTIALS[PAYPAL_ENVIRONMENT]['client_id'] . ":" . PAYPAL_CREDENTIALS[PAYPAL_ENVIRONMENT]['client_secret']);
		$this->_http->setBody("grant_type=client_credentials");
		$returnData = $this->_http->sendRequest();
		$this->_token = $returnData['access_token'];	
	}
	
	/**
		* 	Actual call to curl helper to create a payment using PayPal REST APIs.
		*	
		* 	Reset curl helper.
		*	Set default PayPal headers.
		* 	Set API call specific headers.
		*	Set curl url.
		*	Set curl body.
		*
        *	@param array $postData Url to be called using curl
		* 	@return array PayPal REST create response
	*/
	private function _createPayment($postData) {
		$this->_http->resetHelper();
		$this->_setDefaultHeaders();
		$this->_http->addHeader("Content-Type: application/json");
		$this->_http->addHeader("Authorization: Bearer " . $this->_token);
		$this->_http->setUrl($this->_createApiUrl("payments/payment"));
		$this->_http->setBody($postData);
		return $this->_http->sendRequest(); 
	}

    /**
     * 	Actual call to curl helper to get a payment using PayPal REST APIs.
     *
     * 	Reset curl helper.
     *	Set default PayPal headers.
     * 	Set API call specific headers.
     *	Set curl url.
     *
     * 	@param array $postData Url to be called using curl
     * 	@return array PayPal REST execute response
     */
    private function _getPayment($postData) {
        $this->_http->resetHelper();
        $this->_setDefaultHeaders();
        $this->_http->addHeader("Content-Type: application/json");
        $this->_http->addHeader("Authorization: Bearer " . $this->_token);
        $this->_http->setUrl($this->_createApiUrl("payments/payment/" . $postData['pay_id'] ));
        return $this->_http->sendRequest();
    }
	
	/**
		* 	Actual call to curl helper to execute a payment using PayPal REST APIs.
		*	
		* 	Reset curl helper.
		*	Set default PayPal headers.
		* 	Set API call specific headers.
		*	Set curl url.
		*	Set curl body.
		*
        *	@param array $postData Url to be called using curl
		* 	@return array PayPal REST execute response
	*/
	private function _executePayment($postData) {
		$this->_http->resetHelper();
		$this->_setDefaultHeaders();
		$this->_http->addHeader("Content-Type: application/json");
		$this->_http->addHeader("Authorization: Bearer " . $this->_token);
		$this->_http->setUrl($this->_createApiUrl("payments/payment/" . $postData['pay_id'] . "/execute"));
		unset($postData['pay_id']);
		$this->_http->setBody($postData);
		return $this->_http->sendRequest(); 
	}
	
	/**
		* 	Call private payment create class function to forward curl request to helper.
		*	
		* 	Check for bearer token.
		*	Call internal REST create payment function.
		*
        *	@param array $postData Url to be called using curl
		* 	@return array Formatted API response
	*/
	public function paymentCreate($postData) {
		if($this->_token === null) {
			$this->_getToken();
		}
		$returnData = $this->_createPayment($postData);
		return array(
			"ack" => true,
			"data" => array(
				"id" => $returnData['id']
			)
		);
	}

    /**
     * 	Call private payment get class function to forward curl request to helper.
     *
     * 	Check for bearer token.
     *	Call internal REST get payment function.
     *
     *  @param array $postData Url to be called using curl
     * 	@return array Formatted API response
     */
    public function paymentGet($postData) {
        if($this->_token === null) {
            $this->_getToken();
        }
        $returnData = $this->_getPayment($postData);
        return array(
            "ack" => true,
            "data" => $returnData
        );
    }
	
	/**
		* 	Call private payment execute class function to forward curl request to helper.
		*	
		* 	Check for bearer token.
		*	Call internal REST execute payment function.
		*
        *   @param array $postData Url to be called using curl
		* 	@return array Formatted API response
	*/
	public function paymentExecute($postData) {
		if($this->_token === null) {
			$this->_getToken();
		}
		$returnData = $this->_executePayment($postData);
		return array(
			"ack" => true,
			"data" => $returnData
		);
	}
	
}