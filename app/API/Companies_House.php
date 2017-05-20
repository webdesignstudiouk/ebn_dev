<?php

namespace App\API;

class Companies_House {
	const API_ENDPOINT = 'https://api.companieshouse.gov.uk';
	private $api_key = "VIefpTkVx8i295aVPLFJHfIGR75FeNYU-WhuPA1Q";

	public function search_by_name($company_name){
		$result = self::send('/search/companies', ['q' => $company_name]);
		if(isset($result['items'][0])){
			dd($result);
		}else{
			return;
		}
	}

	public function search_by_companyNumber($company_number){
		$result = self::send('/company/'.$company_number);
		dd($result);
	}



	/**
	 * @param string $endpoint
	 * @param array  $payload
	 *
	 * @return mixed
	 */
	public function send($endpoint, array $payload = []) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getRequestUrl($endpoint, $payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, $this->api_key . ':');
		$result = curl_exec($ch);
		curl_close($ch);
		if ($json = json_decode($result, true)) {
			$result = $json;
		}
		return $result;
	}
	/**
	 * @param string $endpoint
	 * @param array  $payload
	 *
	 * @return string
	 */
	private function getRequestUrl($endpoint, array $payload) {
		$payload = array_merge($payload, ['ts' => time()]);
		$qs = '?' . http_build_query($payload);
		return self::API_ENDPOINT . $endpoint . $qs;
	}
}
