<?php

namespace App\Http\Services;

use Illuminate\Http\Response;

class ResponseService
{
    /**
     * Generate a standardized JSON success response with optional data and message.
     *
     * @param array|null $data The payload to be returned with the response.
     * @param int $code HTTP status code (default is 200 OK).
     * @param string|null $message Custom success message. Defaults to a translation key.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send_response_success($data = null, int $code = 200, $message = null)
    {
        $message = $message ?: 'done successfully';
        $response = self::response_data(true, $code, $data, $message);

        return response()->json($response, $code);
    }

    /**
     * Generate a success response with a redirect URL.
     *
     * This is particularly useful when the frontend needs to redirect after a successful action.
     *
     * @param string $route The URL to redirect to.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send_back_response_success($route)
    {
        $response = self::response_data(true, 200, ['url' => $route], 'done successfully');

        return response()->json($response, 200);
    }

    /**
     * Generate a standardized JSON error response with custom data and message.
     *
     * @param array|null $data Additional error-related data (e.g., validation errors).
     * @param int $code HTTP error status code.
     * @param string|null $message Custom error message. Optional.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send_response_error($data, int $code, $message = null)
    {
        $response = self::response_data(false, $code, $data, $message);

        return response()->json($response, $code);
    }

    /**
     * Shortcut method to send a 400 Bad Request response.
     *
     * Useful for validation errors or malformed requests.
     *
     * @param string|null $message Custom error message. Optional.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send_bad_request($message = null)
    {
        return self::send_response_error(null, Response::HTTP_BAD_REQUEST, $message);
    }

    /**
     * Shortcut method to send a 404 Not Found response.
     *
     * Used when a requested resource is not available.
     *
     * @param string|null $message Optional custom message. Defaults to translated 'Not found'.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send_not_found($message = null)
    {
        $message = $message ?: 'Not found';

        return self::send_response_error(null, Response::HTTP_NOT_FOUND, $message);
    }

    /**
     * Build a consistent structure for API responses.
     *
     * Ensures all success/error responses follow a uniform format.
     *
     * @param bool $status True for success, false for error.
     * @param int $status_code HTTP status code to return.
     * @param mixed $data The actual data or error details to send back.
     * @param string|null $message Human-readable message to explain the result.
     * @return array Structured response array.
     */
    private static function response_data(bool $status, int $status_code, $data, $message)
    {
        $message = $message ?: Response::$statusTexts[$status_code];

        return [
            'status' => $status,
            'status_code' => $status_code,
            'data' => $data,
            'message' => $message,
        ];
    }
}
