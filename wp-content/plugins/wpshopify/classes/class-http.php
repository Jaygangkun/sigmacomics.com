<?php

namespace WP_Shopify;

use WP_Shopify\Utils;
use WP_Shopify\Utils\HTTP as Utils_HTTP;
use WP_Shopify\Messages;

if (!defined('ABSPATH')) {
    exit();
}

class HTTP
{
    private $DB_Settings_Connection;

    public function __construct($DB_Settings_Connection)
    {
        $this->DB_Settings_Connection = $DB_Settings_Connection;
    }

    /*

	Used exclusively for throttling API requests

	*/
    public function throttle_request()
    {
        sleep(8);
    }

    /*

	Grab the total call amount from the header response

	*/
    public function get_shopify_api_call_amount($response)
    {
        $call_limit = wp_remote_retrieve_header(
            $response,
            WP_SHOPIFY_SHOPIFY_HEADER_API_CALL_LIMIT
        );

        if ($call_limit === '') {
            return false;
        }

        return $call_limit;
    }

    public function endpoint_contains_protocol($endpoint)
    {
        if (Utils::str_contains_start($endpoint, 'http')) {
            return true;
        }

        return false;
    }

    /*

	Responsible for building the request URL

	*/
    public function get_request_url($endpoint, $params = false)
    {
        if ($this->endpoint_contains_protocol($endpoint)) {
            return $endpoint; // is a full URL
        }

        $connection = $this->DB_Settings_Connection->get();

        if (is_object($connection) && isset($connection->domain)) {
            return "https://" . $connection->domain . $endpoint . $params;
        }
    }

    /*

	Callback to the on_headers Guzzle function

	*/
    public function check_rate_limit($response)
    {
        $call_total = $this->get_shopify_api_call_amount($response);

        if (
            $call_total === WP_SHOPIFY_SHOPIFY_RATE_LIMIT ||
            $call_total === false
        ) {
            $this->throttle_request();
        }
    }

    /*

	Sets the body argument for wp_remote_request

	*/
    public function maybe_set_request_arg_body($request_args, $body)
    {
        if ($body) {
            $request_args['body'] = json_encode($body);
        }

        return $request_args;
    }

    /*

	Sets the timing argument for wp_remote_request

	*/
    public function maybe_set_request_arg_timing($request_args, $blocking)
    {
        $request_args['timeout'] = $blocking ? 0.01 : 30;

        return $request_args;
    }

    /*

	Sets the blocking argument for wp_remote_request

	*/
    public function maybe_set_request_arg_blocking($request_args, $blocking)
    {
        $request_args['blocking'] = $blocking ? false : true;

        return $request_args;
    }

    /*

	Sets the default headers used in each request despite the method

	*/
    public function default_request_headers($request_args, $auth_token)
    {
        return $request_args['headers'] = [
            'Authorization' => 'Basic ' . $auth_token,
            'Content-Type' => 'application/json',
        ];
    }

    /*

	Sets the headers argument for wp_remote_request

	*/
    public function maybe_set_request_arg_headers($request_args)
    {
        $request_args['headers'] = $this->default_request_headers(
            $request_args,
            $this->DB_Settings_Connection->get_auth_token()
        );

        return $request_args;
    }

    /*

	Sets the method argument for wp_remote_request

	*/
    public function maybe_set_request_arg_method($request_args, $method)
    {
        $request_args['method'] = $method;

        return $request_args;
    }

    public function build_request_args($method, $body, $blocking)
    {
        $request_args = [];
        $request_args = $this->maybe_set_request_arg_body($request_args, $body);
        $request_args = $this->maybe_set_request_arg_timing(
            $request_args,
            $blocking
        );
        $request_args = $this->maybe_set_request_arg_blocking(
            $request_args,
            $blocking
        );
        $request_args = $this->maybe_set_request_arg_headers($request_args);
        $request_args = $this->maybe_set_request_arg_method(
            $request_args,
            $method
        );

        return $request_args;
    }

    public function is_server_error($response)
    {
        if (is_wp_error($response)) {
            return true;
        }
    }

    public function get_server_error_message($response)
    {
        return Utils_HTTP::get_error_message_from_status_code($response);
    }

    /*

	Responsible for inserting data <type> into DB

	Returns response object on success or WP_Error on fail

	*/
    public function post($endpoint, $body = false, $blocking = false)
    {
        return $this->request(
            'POST',
            $this->get_request_url($endpoint),
            $body,
            $blocking
        );
    }

    /*

	Responsible for deleting data <type> from DB

	Returns response object on success or WP_Error on fail

	*/
    public function delete($endpoint = false, $blocking = false)
    {
        return $this->request(
            'DELETE',
            $this->get_request_url($endpoint),
            [],
            $blocking
        );
    }

    /*

	Responsible for getting data <type> from Shopify

	Returns response object on success or WP_Error on fail

	*/
    public function get($endpoint, $params = false, $blocking = false)
    {
        return $this->request(
            'GET',
            $this->get_request_url($endpoint, $params),
            [],
            $blocking
        );
    }

    /*

	Lowest level request wrapper

	Param 1: $method
	Param 1: $url
	Param 1: $body
	Param 1: $blocking

	Returns response object on success or WP_Error on fail

	*/
    public function request($method, $url, $body = false, $blocking = false)
    {

        $request_args = $this->build_request_args($method, $body, $blocking);

        $url_filtered = apply_filters(
            'wps_remote_request_url',
            $url,
            $request_args
        );

        if (!$url_filtered) {
            return Utils::wp_error(
                'WP Shopify HTTP Error: Request URL not found.'
            );
        }

        $response = \wp_remote_request($url, $request_args);

        if (Utils_HTTP::is_client_error($response)) {
            return Utils::wp_error(
                Utils_HTTP::get_client_error_message($response)
            );
        }

        if ($this->is_server_error($response)) {
            return Utils::wp_error($this->get_server_error_message($response));
        }

        // Throttles API calls if needed to stay under limit
        $this->check_rate_limit($response);
        //
        $api_ver = wp_remote_retrieve_header(
            $response,
            'x-shopify-api-version'
        );
        $dep_reason = wp_remote_retrieve_header(
            $response,
            'x-shopify-api-deprecated-reason'
        );

        if (!empty($dep_reason)) {
            return false;
        }

        if ($api_ver !== WP_SHOPIFY_ADMIN_REST_API_VERSION) {
            return false;
        }

        $json_from_response = wp_remote_retrieve_body($response);

        /*

		JSON_BIGINT_AS_STRING -- Decodes large integers as their original string value. Available since PHP 5.4.0.

		Setting this is important in order to prevent large numbers being coerced into
		incorrect values. Will turn them into strings instead. 512 here is the default.

		http://blog.pixelastic.com/2011/10/12/fix-floating-issue-json-decode-php-5-3/

      */

        return [
            'headers' => wp_remote_retrieve_headers($response),
            'body' => json_decode(
                $json_from_response,
                false,
                512,
                JSON_BIGINT_AS_STRING
            ),
        ];
    }
}
