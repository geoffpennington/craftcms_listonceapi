<?php
/**
 * ListOnceAPI plugin for Craft CMS
 *
 * ListOnceAPI_ListOnce Controller
 *
 *
 * @author    Geoff Pennington
 * @copyright Copyright (c) 2016 Geoff Pennington
 * @link      http://bananaworks.co
 * @package   ListOnceAPI
 * @since     1
 */



namespace Craft;

class ListOnceAPI_ListOnceController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionGetListing', 'actionSearchListings', 'actionGetSuburbs' );
    //protected $allowAnonymous = true;


    public function actionGetListing()
    {
        $id = craft()->request->getParam('listing_id');

        $result = craft()->listOnceAPI_listOnce->getListing($id);

        $this->returnJson($result);

    }

    public function actionSearchListings()
    {
        $options = craft()->request->getQueryString();

        $result = craft()->listOnceAPI_listOnce->searchListings($options);

        $this->returnJson($result);
    }

    public function actionGetSuburbs()
    {
        $options = craft()->request->getQueryString();

        $result = craft()->listOnceAPI_listOnce->getSuburbs($options);

        $this->returnJson($result);
    }
}