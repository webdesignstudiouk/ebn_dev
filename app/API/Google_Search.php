<?php

namespace App\API;

class Google_Search {
	const API_ENDPOINT = 'ttps://www.googleapis.com';
	private $api_key = "AIzaSyDRsq_-tr8gzyaDeQGrrCYCaopDm-sDk_k";

	public function search($query){
		$result = self::send('https://www.googleapis.com/customsearch/v1?q=blind+companies+near+durham+UK&cx=013466558691798891939:glchnlgxabi&key=AIzaSyDRsq_-tr8gzyaDeQGrrCYCaopDm-sDk_k');
		dd($result);
		if(isset($result['items'][0])){
			return $result['items'][0];
		}else{
			return;
		}
	}
	
	
//GET https://www.googleapis.com/customsearch/v1?q=blind+companies+near+durham+UK&cx=013466558691798891939%3Aglchnlgxabi&key={YOUR_API_KEY}
	
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
		return $endpoint ;
	}
	
	
}
