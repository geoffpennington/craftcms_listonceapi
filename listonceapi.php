<?php

// update values for multi dev env and move to craft/config/ dir


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