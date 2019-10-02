<?php
	/**********************************************************
	* Lidiun PHP Framework 7.0 - (http://www.lidiun.com)
	*
	* @Created in 26/08/2013
	* @Updated in 01/10/2019
	* @Author  Dyon Enedi <dyonenedi@hotmail.com>
	* @By Dyon Enedi <dyonenedi@hotmail.com>
	* @Contributor Gabriela A. Ayres Garcia <gabriela.ayres.garcia@gmail.com>
	* @License: free
	*
	**********************************************************/

	use Lidiun_Framework_v7\Autoload;
	use Lidiun_Framework_v7\Framework;

	#######################################################################################
	################################## INCLUDING AUTOLOAD #################################
	#######################################################################################

	$lidiunPath = PUBLIC_DIRECTORY . SEPARATOR . '..' . SEPARATOR . '..' . SEPARATOR . 'lidiun_framework_v7' . SEPARATOR;
	include_once($lidiunPath . 'autoload.php');
	Autoload::init();

	#######################################################################################
	############################### INCLUDING CONFIGURATION ###############################
	#######################################################################################

	$advancedConfigPath = PUBLIC_DIRECTORY . SEPARATOR . '..' . SEPARATOR . 'config' . SEPARATOR . 'advanced_config.php';
	include_once($advancedConfigPath);

	$basicConfigPath = PUBLIC_DIRECTORY . SEPARATOR . '..' . SEPARATOR . 'config' . SEPARATOR . 'basic_config.php';
	include_once($basicConfigPath);

	#######################################################################################
	################################ INCLUDING FRAMEWORK #################################
	#######################################################################################

	$Framework = new Framework($config);
	$Framework = null;