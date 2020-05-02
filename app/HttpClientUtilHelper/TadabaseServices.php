<?php
  namespace App\HttpClientUtilHelper;
  
  use GuzzleHttp\Client;
  
 class TadabaseServices
  {

      protected $client;

      public function __construct(Client $client)
      {
          $this->client = $client;
      }

      
      public function data_entities()
      {
        return $this->getEndPointRequest('/api/v1/data-tables'); 

      }

      public function entity_schema($table_id)
      {
        return $this->getEndPointRequest("/api/v1/data-tables/$table_id/fields"); 
      }

      // Get request endpoint
      public function getEndPointRequest($url)
      {
        try {
          $response = $this->client->request('GET', $url,[
            'headers' => [
                "X-Tadabase-App-id" =>  env('API_ID'),
                "X-Tadabase-App-Key" => env('API_KEY'),
                "X-Tadabase-App-Secret" => env('API_SECRET')
            ]
        ]);

        } catch (\Exception $e) {
                return $e;
        }
    
        return $this->response_handler($response->getBody()->getContents());
      }
    

      public function response_handler($response)
      {
        if ($response) {
          return json_decode($response);
        }
        
        return [];
      }
 }
 


?>