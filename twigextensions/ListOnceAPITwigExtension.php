<?php
/**
 * ListOnceAPI plugin for Craft CMS
 *
 * ListOnceAPI Twig Extension
 *
 * --snip--
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators, global variables, and
 * functions. You can even extend the parser itself with node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 * --snip--
 *
 * @author    Geoff Pennington
 * @copyright Copyright (c) 2016 Geoff Pennington
 * @link      http://bananaworks.co
 * @package   ListOnceAPI
 * @since     1
 */

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class ListOnceAPITwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ListOnceAPI';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    // public function getFilters()
    // {
    //     return array(
    //         'someFilter' => new \Twig_Filter_Method($this, 'someInternalFunction'),
    //     );
    // }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = searchListings(options) %}
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'getListing' => new \Twig_Function_Method($this, 'getListing'),
            'searchListings' => new \Twig_Function_Method($this, 'searchListings'),
            'getSuburbs' => new \Twig_Function_Method($this, 'getSuburbs'),
            'searchInspectionTimes' => new \Twig_Function_Method($this, 'searchInspectionTimes'),
            'getAPIKey' => new \Twig_Function_Method($this, 'getAPIKey'),
            'getParams' => new \Twig_Function_Method($this, 'getParams'),
        );
    }

    /**
     *
      * @return string|null
     */
    public function getParams($options = null)
    {

        $urlParams = '';

        $page = isset($options['page']) ? 'page=' . $options['page'] : 'page=1';
        $per_page = isset($options['per_page']) ? 'per_page=' . $options['per_page'] : 'per_page=12';
        $listing_type = isset($options['listing_type']) ? 'listing_type=' . $options['listing_type'] : 'listing_type=sale';
        $property_status = isset($options['property_status']) ? 'property_status=' . $options['property_status'] : 'property_status=available';
        $archive = isset($options['archive']) ? 'archive=' . $options['archive'] : 'archive=1';

        $params = array(
          array("param" => strlen(craft()->request->getParam( 'page' )) ? 'page=' . craft()->request->getParam( 'page' ) : $page),
          array("param" => strlen(craft()->request->getParam( 'per_page' )) ? 'per_page=' . craft()->request->getParam( 'per_page' ) : $per_page),
          array("param" => strlen(craft()->request->getParam( 'listing_type' )) ? 'listing_type=' . craft()->request->getParam( 'listing_type' ) : $listing_type),
          array("param" => strlen(craft()->request->getParam( 'property_status' )) ? 'property_status=' . craft()->request->getParam( 'property_status' ) : $property_status),
          
          array("param" => strlen(craft()->request->getParam( 'order_by' )) ? 'order_by=' . craft()->request->getParam( 'order_by' ) :  'order_by=listing_id'),
          array("param" => strlen(craft()->request->getParam( 'order_asc' )) ? 'order_asc=' . craft()->request->getParam( 'order_asc' ) : 'order_asc=0'),
          array("param" => strlen(craft()->request->getParam( 'suburb' )) ? 'suburb=' . craft()->request->getParam( 'suburb' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'surrounding' )) ? 'surrounding=' . craft()->request->getParam( 'surrounding' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'postcode' )) ? 'postcode=' . craft()->request->getParam( 'postcode' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'state' )) ? 'state=' . craft()->request->getParam( 'state' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'property_type' )) ? 'property_type=' . craft()->request->getParam( 'property_type' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'agent_id' )) ? 'agent_id=' . craft()->request->getParam( 'agent_id' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'category' )) ? 'category=' . craft()->request->getParam( 'category' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'subcategory' )) ? 'subcategory=' . craft()->request->getParam( 'subcategory' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_bed' )) ? 'min_bed=' . craft()->request->getParam( 'min_bed' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_bed' )) ? 'max_bed=' . craft()->request->getParam( 'max_bed' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_bath' )) ? 'min_bath=' . craft()->request->getParam( 'min_bath' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_bath' )) ? 'max_bath=' . craft()->request->getParam( 'max_bath' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_price' )) ? 'min_price=' . craft()->request->getParam( 'min_price' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_price' )) ? 'max_price=' . craft()->request->getParam( 'max_price' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_rent' )) ? 'min_rent=' . craft()->request->getParam( 'min_rent' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_rent' )) ? 'max_rent=' . craft()->request->getParam( 'max_rent' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'rent_period' )) ? 'rent_period=' . craft()->request->getParam( 'rent_period' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'auction_only' )) ? 'auction_only=' . craft()->request->getParam( 'auction_only' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_parking_total' )) ? 'min_parking_total=' . craft()->request->getParam( 'min_parking_total' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_parking_total' )) ? 'max_parking_total=' . craft()->request->getParam( 'max_parking_total' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_land_area' )) ? 'min_land_area=' . craft()->request->getParam( 'min_land_area' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_land_area' )) ? 'max_land_area=' . craft()->request->getParam( 'max_land_area' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'min_building_area' )) ? 'min_building_area=' . craft()->request->getParam( 'min_building_area' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_building_area' )) ? 'max_building_area=' . craft()->request->getParam( 'max_building_area' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'max_total_listings' )) ? 'max_total_listings=' . craft()->request->getParam( 'max_total_listings' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'date_start' )) ? 'date_start=' . craft()->request->getParam( 'date_start' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'date_end' )) ? 'date_end=' . craft()->request->getParam( 'date_end' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'boundaries' )) ? 'boundaries=' . craft()->request->getParam( 'boundaries' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'street_name' )) ? 'street_name=' . craft()->request->getParam( 'street_name' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'modified_from' )) ? 'modified_from=' . craft()->request->getParam( 'modified_from' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'modified_to' )) ? 'modified_to=' . craft()->request->getParam( 'modified_to' ) : ''),
          array("param" => strlen(craft()->request->getParam( 'unique_listings' )) ? 'unique_listings=' . craft()->request->getParam( 'unique_listings' ) : ''),
        );

        foreach ($params as $param) {

          if(strlen($param['param'])) {

            $urlParams .= $param['param'] . "&";

          }

        }

         return $urlParams;
    }

    /**
     *
      * @return array|null
     */
    public function getListing($id = null)
    {
         return craft()->listOnceAPI_listOnce->getListing($id);
    }

    /**
     *
      * @return array|null
     */
    public function searchListings($options = null)
    {
         return craft()->listOnceAPI_listOnce->searchListings($options);
    }

    /**
     *
      * @return array|null
     */
    public function getSuburbs($options = null)
    {
         return craft()->listOnceAPI_listOnce->getSuburbs($options);
    }

    /**
     *
      * @return array|null
     */
    public function searchInspectionTimes($options = null)
    {
         return craft()->listOnceAPI_listOnce->searchInspectionTimes($options);
    }

    /**
     *
      * @return string|null
     */
    public function getAPIKey()
    {
         return craft()->listOnceAPI_listOnce->getAPIKey();
    }

    /**
     *
      * @return string|null
     */
    public function getAPIEndPoint()
    {
         return craft()->listOnceAPI_listOnce->getAPIEndPoint();
    }
}
