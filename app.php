<?php
	/**********************************************************
	* Lidiun PHP Framework 7.0 - (http://www.lidiun.com)
	*
	* @Created in 01/10/2019
	* @Author  Dyon Enedi <dyonenedi@hotmail.com>
	* @By Dyon Enedi <dyonenedi@hotmail.com>
	* @Contributor Gabriela A. Ayres Garcia <gabriela.ayres.garcia@gmail.com>
	* @License: free
	*
	**********************************************************/
	
	namespace Lidiun_Framework_v7;
	
	class App
	{
		// CONF
		public static $title;
		public static $preset;
		public static $environment;
		public static $database;

		// LANGUAGE
		public static $language;

		// CSS & JS
		public static $common_css;
		public static $additional_css;
		public static $common_js;
		public static $additional_js;

		// LINK
		public static $link;
		public static $path;

		// REQUEST
		public static $parameter;
		public static $post;
		public static $get;
		public static $files;
		public static $controller;
		public static $action;
		public static $view;

		public static function load(){
			self::$preset      = Conf::$_conf['preset'];
			self::$environment = Conf::$_conf['environment'];
			self::$database    = Conf::$_conf['database'];

			self::$language    = Language::getLanguage();

			self::$common_css     = Conf::$_conf['common_css'];
			self::$additional_css = Conf::$_conf['additional_css'];
			self::$common_js      = Conf::$_conf['common_js'];
			self::$additional_js  = Conf::$_conf['additional_js'];

			self::$link        = link::getLink();
			self::$path        = Path::getPath();

			self::$parameter   = Request::getParameter();
			self::$post        = Request::getPost();
			self::$get         = Request::getGet();
			self::$files       = Request::getFiles();
			self::$controller  = Request::getController();
			self::$action      = Request::getAction();
		}

		#############################################
		################### SETs ####################
		#############################################

		public static function setTitle($title) {
			self::$title = $title;
		}

		public static function getTitle() {
			if (!empty(self::$title)) {
				return self::$title;
			} else {
				return self::$controller;
			}
		}

		public static function setDescription($description) {
			self::$preset['description'] = $description;
		}

		public static function setKeyword($keyword) {
			self::$preset['keyword'] = $keyword;
		}

		public static function setView($view) {
			self::$view = $view;
		}

		#############################################
		################### GETs ####################
		#############################################

		public static function getView() {
			$view = self::$view;
			self::$view = null;

			return $view;
		}
	}