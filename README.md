<<<<<<< HEAD
# ListOnceAPI plugin for Craft CMS

List Once API Wrapper

![Screenshot](resources/screenshots/plugin_logo.png)

## Installation

To install ListOnceAPI, follow these steps:

1. Download & unzip the file and place the `listonceapi` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/geoffpennington/craftcms_listonceapi.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require geoffpennington/craftcms_listonceapi`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `listonceapi` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

ListOnceAPI works on Craft 2.4.x and Craft 2.5.x.

## ListOnceAPI Overview

List Once API Plugin for Craft CMS

## Configuring ListOnceAPI

update values for multi dev env in listonceapi/listonceapi.php and move to craft/config/ dir

eg:
return array(
	// Settings that apply to all cases
	'*' => array(
	 	'listonceAPIkey' => 'xXXxxXxxXXxxXxXXXxXXxxXxxXXxxXx',
	 	'apiEndPoint' => 'http://www.listonce.com.au/',
	 	'apiLocal' => true,
	),

	// Staging
	'mySite.staging' => array(
	 	'listonceAPIkey' => 'xXXxxXxxXXxxXxXXXxXXxxXxxXXxxXx',
	 	'apiEndPoint' => 'http://www.listonce.com.au/',
	 	'apiLocal' => true,
	),

	// Local development
	'mySite.dev' => array(
	 	'listonceAPIkey' => 'xXXxxXxxXXxxXxXXXxXXxxXxxXXxxXx',
	 	'apiEndPoint' => 'http://mySite.staging.somedomain.com/',
	 	'apiLocal' => false,
	),

);


## Using ListOnceAPI

getParams twig function checks query string for search params and creates string to pass onto api search functions


	{% set urlParams = getParams() %}

	{# e.g. "page=1&per_page=12&order_by=listing_id&order_asc=0&listing_type=sale&property_status=available&"  #} 

	{% block body %}

	{# get suburbs #} 
	{% set suburbs = getSuburbs(urlParams) %}

	{# search listings #} 
	{% set listonce_properties = searchListings(urlParams) %}

	{# then output as you would any other array #}

	{% if listonce_properties.listings is defined and listonce_properties.listings|length %}

		{% for entry in listonce_properties.listings%}

		      <div class="listing-content">
		          <div class="listing-copy">
		          <h4>{{ entry.address_street_number }} {{ entry.address_street_name }} {{ entry.address_street_type }} {{ entry.address_suburb }}</h4>
		          <h3 class="price">{{ entry.price_view }}</h3>
		  			<p>{{ entry.headline }}</p>
		          </div>
		          <dl class="listing-features">
		              <dt><i class="fa fa-bed" aria-hidden="true"></i></dt>
		              <dd>{{ entry.bedrooms }}</dd>
		              <dt><i class="fa fa-bath" aria-hidden="true"></i></dt>
		              <dd>{{ entry.bathrooms }}</dd>
		              <dt><i class="fa fa-car" aria-hidden="true"></i></dt>
		              <dd>{{ entry.parking_total }}</dd>
		          </dl>
			      <div class="listing-btn">  
			 		<a class="btn btn-default" href="{{ entry.listing_id }}" role="button">View Details</a>
			     </div>
			  </div>   

		{% endfor %}

	{% else %}
		
		<p>No results found</p>

	{% endif %}



## ListOnceAPI Roadmap

Some things to do, and ideas for potential features:

* Need to add Auction search.
* Need to add some caching


## ListOnceAPI Changelog

### 1 -- 2016.10.18
### 2 -- 2016.10.24
* Moved params array from into twigextensions function
### 3 -- 2016.10.24
* Added OFI search


