<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiteServicesController extends Controller
{
    public function __construct()
    {

        $response = Http::asForm()->post('https://test.siteservices.murugocloud.com/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => env('SITE_SERVICE_CLIENT_ID'),
            'client_secret' => env('SITE_SERVICE_CLIENT_SECRET_KEY'),
            'scope' => '',
        ]);

        $this->accessToken = $response->json()['access_token'];
        return $this->accessToken;

    }
     
    /**
     * 
     */

    public function searchLocations()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' =>'Bearer ' .$this->accessToken,
        ])->asForm()->post('https://test.siteservices.murugocloud.com/api/v2/search-location', [
            'key' => 'name',
            'entry' => 'Nyamirambo Market'
        ]);
        
        return $response->json();
    }

    public function searchOrganizations()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .$this->accessToken,
        ])->asForm()->post('https://test.siteservices.murugocloud.com/api/v2/search-organizations', [
            'entry' => 'KLab'
        ]);

        return $response->json();
    }


    public function listApprovedLocations()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' =>'Bearer ' .$this->accessToken,
        ])->get('https://test.siteservices.murugocloud.com/api/v2/paginated-locations');
        
        return $response->json();
    }

    public function listApprovedOrganizations()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .$this->accessToken,
        ])->get('https://test.siteservices.murugocloud.com/api/v2/paginated-organizations');

        return $response->json();
    }


    public function submitOrganizations(){

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .$this->accessToken,
        ])->asForm()->post('https://test.siteservices.murugocloud.com/api/v2/submit-organization', [
            'murugo_location_id' => 1800,
            'name' => 'guiness'
        ]);

        return $response->json();
    }
}
