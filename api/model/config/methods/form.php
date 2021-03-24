<?php
include ROOT . "model/config/patterns.php";
$methods = [
	'submitAmbassador' => [
		'params' => [
			[
				'name' => 'firstname',
				'source' => 'p',
				'required' => true,
				'pattern' => '',
				'default' => ''
			],
			[
				'name' => 'secondname',
				'source' => 'p',
				'required' => false,
				'pattern' => '',
				'default' => ''
			],
			[
				'name' => 'position',
				'source' => 'p',
				'required' => false,
				'pattern' => '',
				'default' => '45'
			],
			[
				'name' => 'phone',
				'source' => 'p',
				'required' => false,
				'pattern' => 'phone',
				'default' => ''
			],
			[
				'name' => 'email',
				'source' => 'p',
				'required' => false,
				'pattern' => 'email',
				'default' => ''
			],
		]
	]
];