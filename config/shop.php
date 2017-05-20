<?php

return array(

	'routes' => array(
        'login' => array(),
        'admin' => array('middleware' => array('auth')),
        'account' => array('middleware' => array('auth')),
        'default' => array(),
        'confirm' => array(),
        'update' => array(),
    ), 

	'page' => array(
		 'account-index' => array( 'account/profile','account/history','account/favorite','account/watch','basket/mini','catalog/session' ),
		 'basket-index' => array( 'basket/standard','basket/related' ),
		 'catalog-count' => array( 'catalog/count' ),
		 'catalog-detail' => array( 'basket/mini','catalog/stage','catalog/detail','catalog/session' ),
		 'catalog-list' => array( 'basket/mini','catalog/filter','catalog/stage','catalog/lists' ),
		 'catalog-stock' => array( 'catalog/stock' ),
		 'catalog-suggest' => array( 'catalog/suggest' ),
		 'checkout-confirm' => array( 'checkout/confirm' ),
		 'checkout-index' => array( 'checkout/standard' ),
		 'checkout-update' => array( 'checkout/update'),
	),

	'resource' => array(
		'db' => array(
			'adapter' => 'mysql',
			'host' => '160.153.16.28',
			'port' => '3306',		
			'database' => 'wds_shop',
			'username' => 'michaeltaylor',
			'password' => 'Michaelb1!'
		),
	),


	'admin' => array(),

	'client' => array(
		'html' => array(
			'common' => array(
				'content' => array(
					 'baseurl' => '/',
				),
				'template' => array(
					 'baseurl' => 'packages/aimeos/shop/themes/elegance',
				),
			),
		),
	),

	'controller' => array(
	),

	'i18n' => array(
	),

	'madmin' => array(
	),

	'mshop' => array(
	),


	'frontend' => array(
		'admin' => array(),
		'client' => array(),
		'controller' => array(),
		'i18n' => array(),
		'madmin' => array(),
		'mshop' => array(),
	),

	'backend' => array(
		'admin' => array(),
		'client' => array(),
		'controller' => array(),
		'i18n' => array(),
		'madmin' => array(),
		'mshop' => array(),
	),
);
