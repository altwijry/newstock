<?php

namespace App\Exceptions;

use Exception;

/**
 * Catalog Not Found Exception
 *
 * Thrown when a requested catalog cannot be found in the database.
 *
 * @package App\Exceptions
 * @author NewStock Team
 * @version 2.0.0
 */
class CatalogNotFoundException extends Exception
{
    /**
     * Catalog ID that was not found
     *
     * @var int
     */
    protected int $catalogId;

    /**
     * Create a new exception instance
     *
     * @param int $catalogId The ID of the catalog that was not found
     * @param string $message Custom error message (optional)
     * @param int $code Error code (default: 404)
     * @param \Throwable|null $previous Previous exception
     */
    public function __construct(
        int $catalogId,
        string $message = '',
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        $this->catalogId = $catalogId;
        
        if (empty($message)) {
            $message = "Catalog with ID {$catalogId} not found";
        }
        
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the catalog ID
     *
     * @return int
     */
    public function getCatalogId(): int
    {
        return $this->catalogId;
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
                'error' => 'Catalog Not Found',
                'message' => $this->getMessage(),
                'catalog_id' => $this->catalogId,
            ], $this->code);
        }

        return response()->view('errors.catalog-not-found', [
            'message' => $this->getMessage(),
            'catalogId' => $this->catalogId,
        ], $this->code);
    }

    /**
     * Report the exception
     *
     * @return bool|null
     */
    public function report()
    {
        \Log::warning("Catalog not found: ID {$this->catalogId}");
        return false;
    }
}
