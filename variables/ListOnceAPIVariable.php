<?php
/**
 * ListOnceAPI plugin for Craft CMS
 *
 * ListOnceAPI Variable
 *
 *
 * @author    Geoff Pennington
 * @copyright Copyright (c) 2016 Geoff Pennington
 * @link      http://bananaworks.co
 * @package   ListOnceAPI
 * @since     1
 */

namespace Craft;

class ListOnceAPIVariable
{
    /**
     *
     *
     *     {{ craft.listOnceAPI.getListing(id) }}
     */
    public function getListing($id)
    {
        return craft()->listOnceAPI_listOnce->getListing($id);
    }

    /**
     *
     *
     *     {{ craft.listOnceAPI.searchListings(options) }}
     */
    public function searchListings($options)
    {
        return craft()->listOnceAPI_listOnce->searchListings($options);
    }

    /**
     *
     *
     *     {{ craft.listOnceAPI.getSuburbs() }}
     */
    public function getSuburbs($options)
    {
        return craft()->listOnceAPI_listOnce->getSuburbs($options);
    }
}
