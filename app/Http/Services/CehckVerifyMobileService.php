<?php

namespace App\Http\Services;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;

class CehckVerifyMobileService
{
    /**
     * Validate and format a mobile number based on the provided country code.
     *
     * @param string $country_code The numeric country calling code (e.g., +20).
     * @param string $mobile The mobile number to be validated.
     * @return array Status and either the formatted number or an error message.
     */
    public static function check_mobile($country_code, $mobile)
    {
        // Convert the country calling code to ISO Alpha-2 format (e.g., +20 → EG)
        $get_alpha_2_by_country_code = self::get_alpha_2_by_country_code($country_code);

        // If conversion failed, return with error message
        if (!$get_alpha_2_by_country_code['status']) {
            return [
                "status" => false,
                "message" => __("messages.Country code not found"),
            ];
        }

        // Validate the mobile number using the libphonenumber package
        $check_verify = self::check_verify_mobile($mobile, $get_alpha_2_by_country_code['alpha_2']);

        // If validation failed, return the error message
        if (!$check_verify['status']) {
            return [
                "status" => false,
                "message" => $check_verify['message'],
            ];
        }

        // Return success response with formatted number (without spaces)
        return [
            "status" => true,
            "number_format" => str_replace(" ", "", $check_verify['number_format']),
        ];
    }

    /**
     * Retrieve the ISO Alpha-2 country code from a numeric calling code.
     *
     * @param string $code The country calling code (e.g., +20).
     * @return array Contains status and the alpha_2 code if found.
     */
    public static function get_alpha_2_by_country_code($code)
    {
        $code = str_replace("+", "", $code);

        // Load country data from a local JSON file
        $countries_alpha = file_get_contents(public_path('countries_data.json'));
        $countries_alpha = json_decode($countries_alpha);
        $countries_alpha = (array) $countries_alpha;

        // Check if the country code exists in the dataset
        if (isset($countries_alpha[$code])) {
            return [
                "status" => true,
                "alpha_2" => $countries_alpha[$code]->alpha_2
            ];
        }

        return [
            "status" => false,
        ];
    }

    /**
     * Validate the mobile number using libphonenumber and format it.
     *
     * @param string $phone_number The phone number to validate.
     * @param string $country_code ISO Alpha-2 country code (e.g., EG).
     * @return array Status and either the formatted number or an error message.
     */
    public static function check_verify_mobile($phone_number, $country_code)
    {
        // Initialize the phone number utility
        $phone_util = PhoneNumberUtil::getInstance();

        try {
            // Attempt to parse the number using country context
            $number_proto = $phone_util->parse($phone_number, strtoupper($country_code));

            // Check if the parsed number is valid
            $is_valid = $phone_util->isValidNumber($number_proto);

            if ($is_valid) {
                // Format number to international format if valid
                $formatted_number = $phone_util->format($number_proto, PhoneNumberFormat::INTERNATIONAL);
                return [
                    "status" => true,
                    "number_format" => $formatted_number
                ];
            }

            // Return invalid message if number is not valid
            return [
                "status" => false,
                "message" => __('messages.Invalid phone number')
            ];
        } catch (NumberParseException $e) {
            // Catch any parsing errors and return the exception message
            return [
                "status" => false,
                "message" => "Number parsing error: " . $e->getMessage()
            ];
        }
    }
}
