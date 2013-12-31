<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	$active_group = 'default';
	$active_record = TRUE;

	//$db ['default'] ['hostname'] = 'sqlite:' . APPPATH . 'data/database.sqlite';
	$db ['default'] ['hostname'] = 'localhost';
	$db ['default'] ['username'] = 'otegamers';
	$db ['default'] ['password'] = 'ZNtnMjQpyYPEKLYq';
	$db ['default'] ['database'] = 'otegamers';
	$db ['default'] ['dbdriver'] = 'mysql';
	$db ['default'] ['dbprefix'] = '';
	$db ['default'] ['pconnect'] = TRUE;
	$db ['default'] ['db_debug'] = TRUE;
	$db ['default'] ['cache_on'] = FALSE;
	$db ['default'] ['cachedir'] = '';
	$db ['default'] ['char_set'] = 'utf8';
	$db ['default'] ['dbcollat'] = 'utf8_general_ci';
	$db ['default'] ['swap_pre'] = '';
	$db ['default'] ['autoinit'] = TRUE;
	$db ['default'] ['stricton'] = FALSE;