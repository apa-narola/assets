<?php

/**
 * Returns UUID of 32 characters
 *
 * @return string
 */
function generateUUID() {
    $currentTime = (string) microtime(true);

    $randNumber = (string) rand(10000, 1000000);

    $shuffledString = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");

    return md5($currentTime . $randNumber . $shuffledString);
}

/**
 * Generate success json response.
 *
 * @param $data
 * @param $message
 *
 * @return Response
 */
function success($data, $message) {
    $result = [];

    $result['flag'] = true;
    $result['message'] = $message;
    $result['data'] = $data;

    return json_encode($result);
}

/**
 * Generate error json response
 *
 * @param       $code
 * @param       $message
 * @param array $data
 *
 * @return Response
 */
function error($code, $message, $data = []) {
    $error = [];

    $error['flag'] = false;
    $error['message'] = $message;
    $error['code'] = $code;

    if (!empty($data)) {
        $error['data'] = $data;
    }

    return json_encode($error);
}

/**
 * Returns PHP DateTime object from JS timestamp
 *
 * @param      $JSTimestamp
 * @param bool $setZeroTime
 *
 * @return \DateTime
 */
function toPHPDateTimeFromJSTimestamp($JSTimestamp, $setZeroTime = false) {
    $phpDateTimeObj = new \DateTime();

    $phpDateTimeObj->setTimestamp($JSTimestamp / 1000);

    if ($setZeroTime) {
        $phpDateTimeObj->setTime(0, 0, 0);
    }

    return $phpDateTimeObj;
}

/**
 * Returns PHP DateTime object from Mongo Date
 *
 * @param \MongoDate $mongoDate
 * @param bool $setZeroTime
 *
 * @return \DateTime
 */
function toPHPDateTimeFromMongoDate($mongoDate, $setZeroTime = false) {
    $phpDateTimeObj = new \DateTime();

    $phpDateTimeObj->setTimestamp($mongoDate->sec);

    if ($setZeroTime) {
        $phpDateTimeObj->setTime(0, 0, 0);
    }

    return $phpDateTimeObj;
}

/**
 * Returns MongoDate object from JS timestamp
 *
 * @param      $JSTimestamp
 * @param bool $setZeroTime
 *
 * @return \MongoDate
 */
function toMongoDateFromJSTimestamp($JSTimestamp, $setZeroTime = false) {
    $phpDateTimeObj = new \DateTime();

    $phpDateTimeObj->setTimestamp($JSTimestamp / 1000);

    if ($setZeroTime) {
        $phpDateTimeObj->setTime(0, 0, 0);
    }

    $mongoDate = new MongoDate($phpDateTimeObj->getTimestamp());

    return $mongoDate;
}

/**
 * Returns MongoDate object from PHP DateTime Object
 *
 * @param \DateTime $phpDateTimeObj
 *
 * @return \MongoDate
 */
function toMongoDateFromPHPDateTime($phpDateTimeObj) {
    $mongoDate = new MongoDate($phpDateTimeObj->getTimestamp());

    return $mongoDate;
}

/**
 * Returns MongoDate object from PHP Date String
 *
 * @param string $phpDateStr
 *
 * @return \MongoDate
 */
function toMongoDateFromPHPDateString($phpDateStr) {
    $mongoDate = new MongoDate(strtotime($phpDateStr));

    return $mongoDate;
}

/**
 * Returns JS timestamp from PHPDatetime
 *
 * @param \DateTime $phpDateTimeObj
 *
 * @return \int
 */
function toJSTimestampFromPHPDateTime($phpDateTimeObj) {
    $jsTimestamp = $phpDateTimeObj->getTimestamp() * 1000;

    return $jsTimestamp;
}

/**
 * Returns JS timestamp from Mongo date
 *
 * @param \MongoDate $mongoDate
 * @param bool $setZeroTime
 *
 * @return \DateTime
 */
function toJSTimestampFromMongoDate($mongoDate, $setZeroTime = false) {
    $phpDateTimeObj = toPHPDateTimeFromMongoDate($mongoDate, $setZeroTime);

    $jsTimestamp = toJSTimestampFromPHPDateTime($phpDateTimeObj);

    return $jsTimestamp;
}

/**
 * Get start of day time from timestamp.
 *
 * @param $timestamp
 *
 * @return Carbon\Carbon
 */
function startOfDay($timestamp) {
    return dateFromTimestamp($timestamp)->startOfDay();
}

/**
 * Get end of day time from timestamp.
 *
 * @param $timestamp
 *
 * @return Carbon\Carbon
 */
function endOfDay($timestamp) {
    return dateFromTimestamp($timestamp)->endOfDay();
}


/**
 * Get timestamp in seconds from millis
 *
 * @param $timestamp
 *
 * @return float
 */
function getTimestampInSeconds($timestamp) {
    return $timestamp / 1000;
}


/**
 * Validate input by checking given key value
 *
 * @param $input
 * @param $key
 *
 * @return bool
 */
function validate($input, $key) {
    if (isset($input[$key]) && (((string) $input[$key] == "0") || ($input[$key] != "" && $input[$key] != null)) && $input[$key] != -1) {
        return true;
    }

    return false;
}

/*
 * TODO Temporary
 */

function canUpdateOrderStatus($name) {
    if ($name == 'Shrijy' || $name == 'Parul') {
        return true;
    }

    return true;
}

/**
 * convert hour-min string to timestamp
 *
 * @param $durationStr - hh:mm:ss (format)
 *
 * @return number timestamp
 */
function durationInTimestamp($durationStr) {
    $timestampStart = strtotime("00:00:00");
    $timestampEnd = strtotime($durationStr);

    return ($timestampEnd - $timestampStart);
}


function phpDateFromMySQLDate($date, $format = "c") {
    return date($format, strtotime($date));
}

function getDurationInMinute($durationStr) {
    $movieDurationArr = explode(":", $durationStr);

    return ($movieDurationArr[0] * 60) + $movieDurationArr[1] + ($movieDurationArr[2] / 60);
}

function sendGET($url, $params = array(), $serviceName = "", $action = "") {
    if (empty($serviceName))
        $serviceName = __FUNCTION__;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    curl_close($ch);

    if ($response === false)
        return $response;

    return $response;
}

/**
 * Send CURL post request
 *
 * @param        $url
 * @param        $data
 * @param string $action
 *
 * @param array $otherParams
 * @return mixed
 */
function sendPost($url, $data, $action = "", $otherParams = []) {
    $post_field_string = 'data=' . json_encode($data);

    if ($action != "") {
        $post_field_string .= '&action=' . $action;
    }
    if (count($otherParams)) {
        foreach ($otherParams as $param) {
            $post_field_string .= '&' . $param['key'] . '=' . $param['value'];
        }
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);

    curl_close($ch);

//    logger("API Request: ", ['Request' => $url, 'Data' => $data, 'Response' => $response]);
    actionLog($url, $data, $response);

    $jsonResponse = json_decode($response, true);
    /* if (!$jsonResponse) {
      return $response;
      } */

    return $jsonResponse;
}

/**
 * Send CURL post request
 *
 * @param        $url
 * @param        $data
 * @param string $action
 *
 * @param array $otherParams
 * @return mixed
 */
function sendPostBtob($url, $data) {
    $post_field_string = 'dataquery=' . $data;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);

    curl_close($ch);

//    logger("API Request: ", ['Request' => $url, 'Data' => $data, 'Response' => $response]);
    //actionLog($url, $data, $response);

    $jsonResponse = json_decode($response, true);
    /* if (!$jsonResponse) {
      return $response;
      } */

    return $jsonResponse;
}

function JSTimestampFromMySQLDate($date) {
    return strtotime($date) * 1000;
}


function is_timestamp($timestamp) {
    if (strtotime(date('d-m-Y H:i:s', $timestamp)) === (int) $timestamp) {
        return $timestamp;
    } else
        return false;
}

function getBitValue($input, $key) {
    return isset($input[$key]) && $input[$key] ? DB::raw($input[$key]) : DB::raw(b'0');
}

function convertToBitValue($value) {
    return $value ? DB::raw($value) : DB::raw(b'0');
}


/**
 * @param $data
 *
 * @return array|mixed
 */
function convertToArray($data) {
    if (is_array($data) || is_object($data)) {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        return print_r($data, true);
    }

    return $data;
}

function convertCamelCaseToSimpleForm($str) {
    $str[0] = strtoupper($str[0]);
    $arr = preg_split('/(?=[A-Z])|(_)/', $str);
    /* foreach ($arr as $string) {
      $string[0] = strtoupper($string[0]);
      } */
    return join(" ", $arr);
}

function convertSnakeCaseToSimpleForm($str) {
    $str[0] = strtoupper($str[0]);
    $arr = preg_split('/(_)/', $str);
    foreach ($arr as $string) {
        if (strlen($string))
            $string[0] = strtoupper($string[0]);
    }
    return join(" ", $arr);
}

function getOfferDiscountType($offerDiscountTypeId = null) {

    $offerDiscountTypeName = null;
    switch ($offerDiscountTypeId) {
        case '-1':
            $offerDiscountTypeName = "All";
            break;
        case '1':
            $offerDiscountTypeName = "Instant";
            break;
        case '2':
            $offerDiscountTypeName = "Cashback";
            break;
        case '3':
            $offerDiscountTypeName = "Other";
            break;
        default :
            break;
    }
    return $offerDiscountTypeName;
}

function getOfferType($offerTypeId = null) {

    $offerTypeName = null;
    switch ($offerTypeId) {
        case '1':
            $offerTypeName = "Promotional Offer";
            break;
        case '2':
            $offerTypeName = "Payment Gateway Offer";
            break;
    }
    return $offerTypeName;
}

function getOfferStatus($getOfferStatusId = null) {

    $getOfferStatusType = null;
    switch ($getOfferStatusId) {
        case '-1':
            $getOfferStatusType = "All";
            break;
        case '1':
            $getOfferStatusType = "Success";
            break;
        case '2':
            $getOfferStatusType = "Pending";
            break;
        case '3':
            $getOfferStatusType = "Failed";
            break;
        default :
            break;
    }
    return $getOfferStatusType;
}

function getOfferServiceName($getOfferServiceId = null) {

    $getOfferServiceName = null;
    switch ($getOfferServiceId) {
        case '-1':
            $getOfferServiceName = "All";
            break;
        case '1':
            $getOfferServiceName = "Mobile Prepaid";
            break;
        case '2':
            $getOfferServiceName = "Mobile Postpaid";
            break;
        case '3':
            $getOfferServiceName = "Dth";
            break;
        case '4':
            $getOfferServiceName = "Data Card";
            break;
        case '5':
            $getOfferServiceName = "Movie";
            break;
        case '6':
            $getOfferServiceName = "Event";
            break;
        case '7':
            $getOfferServiceName = "Play";
            break;
        case '8':
            $getOfferServiceName = "ST";
            break;
        case '9':
            $getOfferServiceName = "Private Bus";
            break;
        case '10':
            $getOfferServiceName = "Flight";
            break;
        case '11':
            $getOfferServiceName = "Hotel";
            break;
        case '12':
            $getOfferServiceName = "UtilityBill";
            break;
        case '13':
            $getOfferServiceName = "Dmr";
            break;
        case '14':
            $getOfferServiceName = "Refill";
            break;
        case '15':
            $getOfferServiceName = "User";
            break;
        default :
            break;
    }
    return $getOfferServiceName;
}


/**
 * return array with same keyvalue
 */
function searchArrayByKey($array, $key, $value) {
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, searchArrayByKey($subarray, $key, $value));
        }
    }

    return $results;
}

/*
 * print array
 */

function pr($content = null, $exit = 1) {
    if (is_array($content)) {
        echo "<pre>";
        print_r($content);
    } else {
        echo $content;
    }
    if ($exit)
        exit;
}

function d($v,$t) 
	{
		echo '<pre>';
		echo '<h1>' . $t. '</h1>';
		var_dump($v);
		echo '</pre>';
	}
	//d($person, "All persons");
