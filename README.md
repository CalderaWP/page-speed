# Turn URL into Google PageSpeed Results


<strong>Requires PHP7</strong>
## Install
`composer require calderawp/speed`

## Usage
Get API key and such https://developers.google.com/speed/docs/insights/v1/getting_started

```
 	use calderawp\speed\Client;
 	
 	$key = 'YOUR KEY';
 	$url = 'https://calderawp.com';
 	$client = new Client( $url, $key );
 	try {
 		//If succesful you will have results as stdClass
 		$response = $client->query();
 	}catch( \Exception $e ){
 		return $e->getMessage();
 	}
 	
 	//Get object of calderawp\speed\Result from results
 	//Try/catch above was to prevent this running without valid data, which would make fatal error, which is bad.
 	$result = $client->get_result();

```


### Copyright 2016 CalderaWP LLC & Josh Pollock. Licensed under the terms of the GNU GPL version 2 or later. Please share with your neighbor.
