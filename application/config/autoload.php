<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	$autoload ['packages'] = array();
	$autoload ['libraries'] = array(
		'database'
	);
	$autoload ['helper'] = array(
		'file'
	);
	$autoload ['config'] = array();
	$autoload ['language'] = array();
	$autoload ['model'] = array();