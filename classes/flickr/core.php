<?php
    /**
      * Class for access Flickr API using Kohana Framework 3.x
      * @author Jean < http://github.com/jeanmask >
      */
    class Flickr_Core {

        protected $request_uri = 'http://api.flickr.com/services/rest/';
        protected $param = array();
        static public $instance;
        
        /**
         * Request data in Flickr API
         * @param String $method name of method in API
         * @param Array $param parameters for the method
         * @access public
         * @return array|boolean
         */
        public function query($method, $params=NULL) {
            $this->param['method'] = utf8::trim($method);
            $params = arr::merge($this->param, $params ? $params : array() );
            $params = url::query($params);
            $serial = remote::get($this->request_uri.$params);

            if(!empty($serial))
              return unserialize($serial);

            return false;
        }
        
        // FIXME: Move this method to external drive per type of url ( image, album, etc... )
        public function image_url($farm_id, $server_id, $id, $secret) {
            $formats = array('s','t','m','z','b','o');
            $url = 'http://farm%s.static.flickr.com/%s/%s_%s_%s.jpg';

            $tmp = array();
            foreach($formats as $f) {
              $tmp[$f] = sprintf($url, $farm_id, $server_id, $id, $secret, $f);
            }

            return $tmp;
        }

        static public function instance() {
            if( self::$instance instanceof Flickr_Core )
                return self::$instance;

            return self::$instance = new Flickr();
        }

        public function __construct() {
            $this->param['api_key'] = Kohana::config('flickr.api_key');
            $this->param['format'] = 'php_serial';
        }
    }
