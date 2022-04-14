<?php

namespace WP_Shopify\Processing;

if (!defined('ABSPATH')) {
    exit();
}

use WP_Shopify\Utils;
use WP_Shopify\Utils\Server;

class Options extends \WP_Shopify\Processing\Vendor_Background_Process
{
    protected $action = 'wps_background_processing_options';

    protected $DB_Settings_Syncing;
    protected $DB_Options;

    public function __construct($DB_Settings_Syncing, $DB_Options)
    {
        $this->DB_Settings_Syncing = $DB_Settings_Syncing;
        $this->DB_Options = $DB_Options;

        parent::__construct($DB_Settings_Syncing);
    }

    /*

	Entry point. Initial call before processing starts.

	*/
    public function process($items, $params = false)
    {
        if ($this->expired_from_server_issues($items, __METHOD__, __LINE__)) {
            return;
        }

        $this->dispatch_items($items);
    }

    /*

	Performs actions required for each item in the queue

	*/
    protected function task($product)
    {
        // Stops background process if syncing stops
        if (!$this->DB_Settings_Syncing->is_syncing()) {
            $this->complete();
            return false;
        }

        if ($this->time_exceeded() || $this->memory_exceeded()) {
            return $product;
        }

        // Actual work
        $result = $this->DB_Options->insert_items_of_type($product->options);

        if (is_wp_error($result)) {
            $this->DB_Settings_Syncing->save_notice_and_expire_sync($result);
            $this->complete();
            return false;
        }

        return false;
    }

    /*

	After an individual task item is removed from the queue

	*/
    protected function after_queue_item_removal($product)
    {
        $this->DB_Settings_Syncing->increment_current_amount('products');
    }
}
