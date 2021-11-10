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
	
	namespace Lidiun_Framework_v7;

	Class Url
	{	
		public static $_url = [];

		public static function load() {	
			$protocol = explode('/', $_SERVER['SERVER_PROTOCOL']);
			$protocol = strtolower($protocol[0]);
			$protocol = $protocol . '://';

			$port = (!empty($_SERVER['SERVER_PORT'])) ? ':' . $_SERVER['SERVER_PORT']: '';
			$domain = Conf::$_conf['preset']['domain'];
			$host = Conf::$_conf['host'];

			$uri = (!empty($_GET['uri'])) ? $_GET['uri'] : false;
			$uri = str_replace('/', ' ', $uri);
			$uri = trim($uri);
			$uri = str_replace(' ', '/', $uri);
			if ($uri) {
				$url = $protocol . $host . $port . '/' . $uri . '/';
				$uri = explode('/', $uri);
			} else {
				$url = $protocol . $host . '/';
				$uri = [];
			}

			self::$_url['protocol'] = $protocol;
			self::$_url['domain']   = $domain;
			self::$_url['host']     = $host;
			self::$_url['port']     = $port;
			self::$_url['base']     = $protocol . $host . ((Conf::$_conf['preset']['server'] == 'developer') ? $port : "") . '/';
			self::$_url['uri']      = $uri;
			self::$_url['full']     = $url;
		}
	}
