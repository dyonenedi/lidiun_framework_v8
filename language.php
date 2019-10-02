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
	
	class Language
	{
		private static $_language;
		// private static $_dictionary;

		public static function load() {
			$language = Conf::$_conf['preset']['language_default'];
			if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
				$exp = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
				if (!empty($exp[1])) {
					$exp = explode(';', $exp[1]);
					if (!empty($exp[0])) {
						$lang = strtolower(trim($exp[0]));
						$language = $lang;
						// if (file_exists(Path::$_path['translation'].$lang.'.php')) {
						// 	$language = $lang;
						// }
					}
				}
			}
			
			self::setLanguage($language);
		}

		#########################################################################
		####################### GLOBALS LANGUAGE METHODS ########################
		#########################################################################

		public static function setLanguage($language) {
			self::$_language = $language;
			// if (file_exists(Path::$_path['translation'].$language.'.php')) {
			// 	self::$_dictionary = require(Path::$_path['translation'].self::$_language.'.php');
			// } else {
			// 	throw new \Exception('Language to your application do not exists in translation file: ' . Path::$_path['translation'].$language.'.php');
			// }
		}

		public static function getLanguage(){
			return self::$_language;
		}

		public static function translation($content=null) {
			// if (isset($content)) {
			// 	if (!is_array(self::$_dictionary)) {
			// 		throw new \Exception('$_dictionary must be an array. In: ' . Path::$_path['translation'].self::$_language.'.php');
			// 	}

			// 	if (!empty(self::$_dictionary[$content])) {
			// 		return self::$_dictionary[$content];
			// 	} else {
			// 		return $content;
			// 	}
			// } else {
			// 	throw new \Exception('$content is required in Language::translation($content);');
			// }
		}
	}