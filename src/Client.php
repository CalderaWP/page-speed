<?php


namespace calderawp\speed;
use calderawp\location\Location;


/**
 * Class Client
 *
 * Client for Google Page Speed API
 * @package calderawp\speed;
*/
class Client {

	/**
	 * @var string
	 */
	protected $root = 'https://www.googleapis.com/pagespeedonline/v2/runPagespeed';

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * URL for API request
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * URL being tested
	 *
	 * @var string
	 */
	protected $testUrl;

	/**
	 * Result of query as stdClass
	 *
	 * @var \stdClass
	 */
	protected $response;

	/**
	 * Client constructor.
	 *
	 * @param string $url URL to test
	 * @param string $key API key
	 */
	public function __construct( string $url, string $key )
	{
		$this->testUrl = $url;
		$this->key = $key;
		$this->set_url( $url );


	}

	/**
	 * Get result as Result object
	 *
	 * IMPORTANT: Make sure to run this only after a succesful query
	 *
	 * @return Result
	 */
	public function get_result() : Result
	{

		$result = new Result( $this->response );
		$result->set_url( $this->testUrl );
		return $result;

	}

	/**
	 * Set URL property with proper query vars
	 *
	 * @param string $url
	 */
	protected function set_url( string $url )
	{
		$args = [
			'key' => $this->key,
			'url' => $url
		];
		$this->url = $this->root . '?' . http_build_query( $args );
	}

	/**
	 * Do a query
	 *
	 * @param string|null $url Optional. If null, the default current value of url property is used. Pass a url to change url property
	 *
	 * @throws \Exception
	 *
	 * @return \stdClass
	 */
	public function query( string $url = null ){
		if( $url ){
			$this->set_url( $url );
		}
		$headers = array('Accept' => 'application/json');
		$request = \Requests::get( $this->url, $headers );
		$response = json_decode(  $request->body );
		if( 200 != $response->status_code ||! is_object( $response ) || isset( $response->error ) ){
			throw new \Exception( 'API failed' );
		}else{
			$this->response = $response;
			return $response;
		}

	}
}
