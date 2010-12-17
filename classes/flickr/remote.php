<?php
    /**
      * Helper to access remote data and caching to Flickr module
      * @author Jean < http://github.com/jeanmask >
      */
    class Flickr_Remote {
			static public function get($uri) {
				$is_cached = class_exists('cache') && Kohana::config('flickr.cache') > 0;
				
				if($is_cached) {
					$hash = hash('md5',$uri);
					if($data = Cache::instance()->get('flickr.'.$hash))
						return $data;
				}
				
				$data = remote::get($uri);
				if($is_cached) {
					Cache::instance()->set('flickr.'.$hash,$data,Kohana::config('flickr.cache'),array('flickr_cache'));
				}
				
				return $data;
			}
		}