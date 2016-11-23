<?php
/**
 * ListOnceAPI plugin for Craft CMS
 *
 * ListOnceAPI_ListOnce Service
 *
 *
 * @author    Geoff Pennington
 * @copyright Copyright (c) 2016 Geoff Pennington
 * @link      http://bananaworks.co
 * @package   ListOnceAPI
 * @since     1
 */

namespace Craft;

class ListOnceAPI_ListOnceService extends BaseApplicationComponent
{
    /*
---
craft()->listOnceAPI_listOnce->getListing($id);

     */

    public function getListing($id) {

        if($this->getAPILocal()){
            $url = '' . $this->getAPIEndPoint() . 'api/get-listing?api_key=' . $this->getAPIKey() . '&listing_id=' . $id;
        }else{
            $url = '' . $this->getAPIEndPoint() . 'actions/listOnceAPI/listOnce/getListing?listing_id=' . $id;
        }       

        return $this->qryApi($url);

    }

    /*
---
craft()->listOnceAPI_listOnce->searchListings($options);

     */

    public function searchListings($options) {

        if($this->getAPILocal()){
            $url = '' . $this->getAPIEndPoint() . 'api/search-listings?api_key=' . $this->getAPIKey() . '&' . $options;
        }else{
            $url = '' . $this->getAPIEndPoint() . 'actions/listOnceAPI/listOnce/searchListings?' . $options;
        }

        return $this->qryApi($url);

    }

    /*
---
craft()->listOnceAPI_listOnce->getSuburbs();

     */

    public function getSuburbs($options) {

        if($this->getAPILocal()){
            $url = '' . $this->getAPIEndPoint() . 'api/get-suburbs?api_key=' . $this->getAPIKey() . '&' . $options;
        }else{
            $url = '' . $this->getAPIEndPoint() . 'actions/listOnceAPI/listOnce/getSuburbs?' . $options;
        }

        return $this->qryApi($url);

    }

    /*
---
craft()->listOnceAPI_listOnce->searchInspectionTimes();

     */

    public function searchInspectionTimes($options) {

        if($this->getAPILocal()){
            $url = '' . $this->getAPIEndPoint() . 'api/search-inspection-times?api_key=' . $this->getAPIKey() . '&' . $options;
        }else{
            $url = '' . $this->getAPIEndPoint() . 'actions/listOnceAPI/listOnce/searchInspectionTimes?' . $options;
        }

        return $this->qryApi($url);

    }

    public function qryApi($url) {

        $expire = 5;     

        // Check to see if the response is cached
        $cachedResponse = craft()->fileCache->get($url);

        if ($cachedResponse) {
            return $cachedResponse;
        }

        try {
            $client = new \Guzzle\Http\Client();
            $request = $client->get($url);
            $response = $request->send();

            if (!$response->isSuccessful()) {
                return;
            }

            $listings = $response->json();

            // Cache the response
            craft()->fileCache->set($url, $listings, $expire);

            return $listings;

        } catch(\Exception $e) {

            return $e;

        }

    }

    /**
     * Returns the List Once API Key
     *
     * @return string|null
     */
    public function getAPIKey()
    {

        return craft()->config->get("listonceAPIkey", "listonceapi");
    }

    /**
     * Returns the List Once API End Point
     *
     * @return string|null
     */
    public function getAPIEndPoint()
    {

        return craft()->config->get("apiEndPoint", "listonceapi");
    }
    /**
     * Returns true if List Once API is local
     *
     * @return string|null
     */
    public function getAPILocal()
    {

        return craft()->config->get("apiLocal", "listonceapi");
    }


}
