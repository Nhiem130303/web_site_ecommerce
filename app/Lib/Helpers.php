<?php

if (!function_exists('pd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pd()
    {
        echo '<pre>';
        array_map(function ($x) {
            print_r($x);
        }, func_get_args());
        echo '</pre>';
        die(1);
    }
}

if (!function_exists('pr')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pr()
    {
        echo '<pre>';
        array_map(function ($x) {
            print_r($x);
        }, func_get_args());
        echo '</pre>';
    }
}

if (!function_exists('limit_text')) {

    /**
     * @param $text
     * @param $limit
     * @return string
     */
    function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}

if (!function_exists('convert_phone')) {
    function convert_phone($phone)
    {
        if (preg_match('/^0/', $phone)) {
            $phone = preg_replace('/^0/', '84', $phone);
        }

        if (preg_match('/^\+/', $phone)) {
            $phone = preg_replace('/^\+/', '', $phone);
        }

        return $phone;
    }
}

if (!function_exists('phone_validate')) {
    function phone_validate($phone)
    {
        $prefixHeaderNumbers = '086|096|097|';
        $prefixHeaderNumbers .= '098|032|033|';
        $prefixHeaderNumbers .= '034|035|036|';
        $prefixHeaderNumbers .= '037|038|039|';
        $prefixHeaderNumbers .= '089|090|093|';
        $prefixHeaderNumbers .= '070|079|077|';
        $prefixHeaderNumbers .= '076|078|091|';
        $prefixHeaderNumbers .= '094|088|083|';
        $prefixHeaderNumbers .= '084|085|081|082';

        $phone = preg_replace('/^\+84/', '0', $phone);

        if (!preg_match('/^0/', $phone)) {
            return [
                'status' => false,
                'messages' => "Số điện thoại không đúng định dạng"
            ];
        }

        if (!preg_match('/^[0-9]+$/', $phone)) {
            return [
                'status' => false,
                'messages' => "Số điện thoại phải là số"
            ];
        }

        $phoneLength = strlen($phone);
        if ($phoneLength < 10 || $phoneLength > 10) {
            return [
                'status' => false,
                'messages' => "Số điện thoại phải là 10 chữ số"
            ];
        }

        if (!preg_match('/^' . $prefixHeaderNumbers . '/', $phone)) {
            return [
                'status' => false,
                'messages' => "Đầu số điện thoại của bạn không được hỗ trợ"
            ];
        }

        return [
            'status' => true,
            'messages' => ""
        ];
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($value)
    {
        return number_format($value, 0, ",", ".");
    }
}




