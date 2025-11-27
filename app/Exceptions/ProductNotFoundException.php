<?php

namespace App\Exceptions;

use Exception;

/**
 * Product Not Found Exception
 *
 * Thrown when a requested product cannot be found in the database.
 *
 * @package App\Exceptions
 * @author NewStock Team
 * @version 2.0.0
 */
class ProductNotFoundException extends Exception
{
    /**
     * Product ID that was not found
     *
     * @var int
     */
    protected int $productId;

    /**
     * Create a new exception instance
     *
     * @param int $productId The ID of the product that was not found
     * @param string $message Custom error message (optional)
     * @param int $code Error code (default: 404)
     * @param \Throwable|null $previous Previous exception
     */
    public function __construct(
        int $productId,
        string $message = '',
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        $this->productId = $productId;
        
        if (empty($message)) {
            $message = "Product with ID {$productId} not found";
        }
        
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the product ID
     *
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
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
                'error' => 'Product Not Found',
                'message' => $this->getMessage(),
                'product_id' => $this->productId,
            ], $this->code);
        }

        return response()->view('errors.product-not-found', [
            'message' => $this->getMessage(),
            'productId' => $this->productId,
        ], $this->code);
    }

    /**
     * Report the exception
     *
     * @return bool|null
     */
    public function report()
    {
        // Log the exception
        \Log::warning("Product not found: ID {$this->productId}");
        
        return false; // Don't report to error tracking services
    }
}
