<?php

namespace Fbpkg\LaravelResponse;

use Illuminate\Http\JsonResponse;

class LaravelResponse
{
    protected array $payload = [];
    protected int $status = 200;

    /**
     * Success response
     */
    public function success(string $message = 'OK', int $status = 200): self
    {
        $this->status = $status;

        $this->payload['status'] = 'success';
        $this->payload['message'] = $message;

        return $this;
    }

    /**
     * Error response
     */
    public function error(string $message = 'Error', int $status = 500): self
    {
        $this->payload['status'] = 'error';
        $this->payload['message'] = $message;

        $this->status = $status;

        return $this;
    }

    /**
     * Attach data
     */
    public function data(mixed $data): self
    {
        $this->payload['data'] = $data;

        return $this;
    }

    /**
     * Attach validation errors (optional but useful early)
     */
    public function errors(array $errors): self
    {
        $this->payload['errors'] = $errors;

        return $this;
    }

    /**
     * UI alert meta (frontend hint)
     */
    public function alert(string $type, string $message = null): self
    {
        $this->payload['meta']['alert'] = [
            'type' => $type,
            'message' => $message,
        ];

        return $this;
    }

    /**
     * Final response output
     */
    public function send(): JsonResponse
    {
        return new JsonResponse($this->payload, $this->status);
    }
}