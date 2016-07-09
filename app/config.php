<?php

	/*\
	 | ------------------------------------------------------
	 | @file : config.php
	 | @author : fab@c++
	 | @description : User configuration of the application
	 | @version : 3.0 Bêta
	 | ------------------------------------------------------
	\*/

	return [
		'framework' => [
			'folder' => '',
			'http'   => [
				'error' => [
					'template' => '.app/error/http',
					'403'      => '.app/error/http',
					'404'      => '.app/error/http',
					'500'      => '.app/error/http'
				]
			]
		],

		'database' => [
			'enabled'   => true,
			'hostname'  => 'localhost',
			'username'  => 'root',
			'password'  => '',
			'database'  => 'kryptonite',
			'driver'    => 'pdo',
			'type'      => 'mysql',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci'
		],

		'debug' => [
			'environment' => 'development',
			'maintenance' => false,
			'profiler'    => true,
			'log'         => true,
			'error'       => [
				'error'     => true,
				'fatal'     => true,
				'exception' => true
			]
		],

		'security' => [
			'firewall' =>  true,
			'spam' => [
				'enabled' => true,
				'config' => [
					'query' => [
						'duration' => 8,
						'number' => 16
					],
					'error' => [
						'template' => '.app/error/spam',
						'variable' => [
							'title' => [
								'type' => 'lang',
								'value' => '.app.system.spam.title'
							],
							'message' => [
								'type' => 'lang',
								'value' => '.app.system.spam.message'
							]
						]
					],
					'exception' => [
						'.gcs.index.default',
						'.gcs.lang.default',
						'.gcs.profiler.default',
						'.gcs.assetManager.default',
						'.gcs.scaffolding.default',
						'.gcs.scaffolding.entity',
						'.gcs.scaffolding.update',
						'.gcs.scaffolding.delete',
					]
				]
			]
		],

		'cron' => [
			'config' => [
				'exception' => [
					'.gcs.index.default',
					'.gcs.lang.default',
					'.gcs.profiler.default',
					'.gcs.assetManager.default',
					'.gcs.scaffolding.default',
					'.gcs.scaffolding.entity',
					'.gcs.scaffolding.update',
					'.gcs.scaffolding.delete',
				]
			],
			'task' => [

			]
		],

		'secure' => [
			'get'  => true,
			'post' => true
		],

		'output' => [
			'https'       => false,
			'lang'        => 'fr',
			'contentType' => 'text/html',
			'charset'     => 'UTF-8',
			'minify'      => true,
			'timezone'    => 'Europe/Paris',
			'cache'       => [
				'enabled' => true,
				'config'  => false,
				'sha1'    => false
			],
			'asset'       => [
				'enabled' => true,
				'cache'   => 0
			]
		],

		'mail' => [
			'enabled' => false,
			'smtp'    => [
				'host'     => 'smtp.example.com',
				'port'     => 25,
				'username' => 'username',
				'password' => 'password',
				'from'     => 'contact@example.com'
			]
		],

		'library' => [

		],

		'template' => [

		],

		'custom' => [

		]
	];