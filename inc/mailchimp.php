<?php
/**
 * Super-simple, minimum abstraction MailChimp API v2 wrapper
 *
 * Uses curl if available, falls back to file_get_contents and HTTP stream.
 * This probably has more comments than code.
 *
 * Contributors:
 * Michael Minor <me@pixelbacon.com>
 * Lorna Jane Mitchell, github.com/lornajane
 *
 * @author Drew McLellan <drew.mclellan@gmail.com>
 * @version 1.1.1
 */
class Luminous_MailChimp_API
{
    private $api_key;
    private $api_endpoint = 'https://<dc>.api.mailchimp.com/2.0';
    private $verify_ssl   = false;
    /**
     * Create a new instance
     * @param string $api_key Your MailChimp API key
     */
    public function __construct($api_key)
    {
        $this->api_key = $api_key;
        list(, $datacentre) = explode('-', $this->api_key);
        $this->api_endpoint = str_replace('<dc>', $datacentre, $this->api_endpoint);
    }
    
    /**
     * Validates MailChimp API Key
     */
    public function validateApiKey()
    {
        $request = $this->call('helper/ping');
        return !empty($request);
    }
    /**
     * Call an API method. Every request needs the API key, so that is added automatically -- you don't need to pass it in.
     * @param  string $method The API method to call, e.g. 'lists/list'
     * @param  array  $args   An array of arguments to pass to the method. Will be json-encoded for you.
     * @return array          Associative array of json decoded API response.
     */
    public function call($method, $args = array(), $timeout = 10)
    {
        return $this->makeRequest($method, $args, $timeout);
    }
    /**
     * Performs the underlying HTTP request. Not very exciting
     * @param  string $method The API method to be called
     * @param  array  $args   Assoc array of parameters to be passed
     * @return array          Assoc array of decoded result
     */
    private function makeRequest($method, $args=array(), $timeout = 10)
    {      
        $args['apikey'] = $this->api_key;

        $url = $this->api_endpoint.'/'.$method.'.json?apikey='. $this->api_key;
        $json_data = json_encode($args);
        
        $args = array(
            'timeout'     => $timeout,
            'headers'     => array('content-type' => 'application/json'),
            'user-agent'  => 'PHP-MCAPI/2.0',
            'sslverify'   => false,
            'method'      => 'POST',
            'httpversion' => '1.1',
            'body'        => $json_data
        );

        $result = wp_remote_post( $url, $args );
        $result = !is_wp_error( $result ) ? $result['body'] : false;

        return $result ? json_decode( $result, true ) : false;
    }

    public function get_lists() {

        $lists = $this->call( 'lists/list' );

        if ( false === $lists || array_key_exists( 'error', $lists ) ) {
            return __( 'Incorrect API key.', 'luminous' );
        } else {
            if ( $lists['total'] == 0 ) {   
                /* Translators: The %s are placeholders for HTML, just translate create list, don't touch %s. */    
                return sprintf( __( 'Please %screate list%s in order to continue.', 'luminous' ), '<a target="_blank" href="http://kb.mailchimp.com/lists/growth/create-a-new-list">', '</a>' );
            } else {
                foreach( $lists['data'] as $list ) {
                    $list_array[esc_attr( $list['id'] )] = esc_attr( $list['name'] );
                }   
                return $list_array; 
            }
        }

    }    
}