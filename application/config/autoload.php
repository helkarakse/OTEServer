<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	$autoload ['packages'] = array();
	$autoload ['libraries'] = array(
		'database', 'encrypt', 'form_validation', 'session'
	);
	$autoload ['helper'] = array(
		'file', 'common', 'form', 'url'
	);
	$autoload ['config'] = array();
	$autoload ['language'] = array();
	$autoload ['model'] = array('tps_model', 'auth_model', 'issue_model', 'ticket_model', 'log_model');