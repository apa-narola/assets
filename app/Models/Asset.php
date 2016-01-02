<?php
/**
 * Created by PhpStorm.
 * User: sujav
 * Date: 1/1/2016
 * Time: 4:56 PM
 */

namespace App\Models;


class Asset
{
    private $asset_id;
    private $asset_category_id;
    private $asset_type_id;
    private $property_id;
    private $condition_id;
    private $status_id;
    private $assigned;
    private $purchase_cost;
    private $purchase_date;
    private $image_and_document;
    private $date_entered;
    private $placed_in_service;
    private $last_service_date;
    private $service_period;
    private $disposal_date;
    private $notes;
    private $depreciation;
    private $lifespan;
    private $salvage_value;
    private $serial_no;
    private $model;
    private $manufacturer;
    private $supplier;
    private $barcode;
    private $location;
    public function __construct($mysql,$asset_id = -1)
    {
        //echo "hello, i am a page.";
    }
}