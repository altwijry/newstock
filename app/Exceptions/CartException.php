<?php

namespace App\Exceptions;

use Exception;

/**
 * Cart Exception
 *
 * Thrown when cart operations fail (e.g., insufficient stock, invalid coupon).
 *
 * @package App\Exceptions
 * @author NewStock Team
 * @version 2.0.0
 */
class CartException extends Exception
{
    /**
     * Exception type
     *
     * @var string
     */
    protected string $type;

    /**
     * Additional data related to the exception
     *
     * @var array
     */
    protected array $data;

    /**
     * Create a new exception instance
     *
     * @param string $message Error message
     * @param string $type Exception type (e.g., 'insufficient_stock', 'invalid_coupon')
     * @param array $data Additional data
     * @param int $code Error code (default: 400)
     * @param \Throwable|null $previous Previous exception
     */
    public function __construct(
        string $message,
        string $type = 'cart_error',
        array $data = [],
        int $code = 400,
        ?\Throwable $previous = null
    ) {
        $this->type = $type;
        $this->data = $data;
        
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the exception type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get additional data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Create insufficient stock exception
     *
     * @param int $productId
     * @param int $requested
     * @param int $available
     * @return static
     */
    public static function insufficientStock(int $productId, int $requested, int $available): self
    {
        return new static(
            "Insufficient stock for product ID {$productId}. Requested: {$requested}, Available: {$available}",
            'insufficient_stock',
            [
                'product_id' => $productId,
                'requested' => $requested,
                'available' => $available,
            ]
        );
    }

    /**
     * Create invalid coupon exception
     *
     * @param string $code
     * @return static
     */
    public static function invalidCoupon(string $code): self
    {
        return new static(
            "Invalid or expired coupon code: {$code}",
            'invalid_coupon',
            ['code' => $code]
        );
    }

    /**
     * Create empty cart exception
     *
     * @return static
     */
    public static function emptyCart(): self
    {
        return new static(
            "Cart is empty",
            'empty_cart'
        );
    }

    /**
     * Render the exception as an HTTP response
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Cart Error',
                'type' => $this->type,
                'message' => $this->getMessage(),
                'data' => $this->data,
            ], $this->code);
        }

        return response()->view('errors.cart-error', [
            'message' => $this->getMessage(),
            'type' => $this->type,
            'data' => $this->data,
        ], $this->code);
    }

    /**
     * Report the exception
     *
     * @return bool|null
     */
    public function report()
    {
        \Log::info("Cart exception: {$this->type} - {$this->getMessage()}", $this->data);
        return false;
    }
}
