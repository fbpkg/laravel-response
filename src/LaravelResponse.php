<?php

namespace Fbpkg\LaravelResponse;

use Illuminate\Validation\Validator;
use Illuminate\Http\JsonResponse;

class LaravelResponse
{
    protected array $payload = [];
    protected int $status = 200;

    /**
     * Set success response.
     * 
     * @param string $message Success message
     * @param int $status HTTP status code (default: 200)
     * @return self
     */
    public function success(string $message = 'OK', int $status = 200): self
    {
        $this->status = $status;

        $this->payload['status'] = 'success';
        $this->payload['message'] = $message;

        return $this;
    }

    /**
     * Set error response.
     * 
     * @param string $message Error message
     * @param int $status HTTP status code (default: 500)
     * @return self
     */
    public function error(string $message = 'Error', int $status = 500): self
    {
        $this->payload['status'] = 'error';
        $this->payload['message'] = $message;

        $this->status = $status;

        return $this;
    }

    /**
     * Set HTTP status code.
     *
     * @param int $status HTTP status code
     * @return self
     */
    public function status(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Attach main data payload.
     * 
     * @param mixed $data Any data (array, object, collection, etc.)
     * @return self
     */
    public function data(mixed $data): self
    {
        $this->payload['data'] = $data;

        return $this;
    }

    /**
     * Add a single metadata key (overwrites if key exists).
     * 
     * @param string $key Metadata key
     * @param mixed $value Metadata value
     * @return self
     */
    public function withMeta(string $key, mixed $value): self
    {
        $this->payload['meta'][$key] = $value;

        return $this;
    }

    /**
     * Attach main errors payload.
     * 
     * @param array $errors
     * @return self
     */
    public function errors(array $errors): self
    {
        $this->payload['errors'] = $errors;

        return $this;
    }

    /**
     * Attach Laravel validation errors to meta.
     * 
     * @param Validator $validator
     * @return self
     */
    public function validation(Validator $validator): self
    {
        return $this->withMeta(
            'validation',
            $validator->errors()->toArray()
        );
    }

    /**
     * Add UI alert hints for frontend.
     * 
     * @param string $type Alert type: 'success', 'error', 'warning', 'info'
     * @param string|null $message Alert message (optional, will use main message if null)
     * @return self
     */
    public function alert(string $type, ?string $message = null): self
    {
        return $this->withMeta('alert', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    /**
     * Send JSON response.
     * 
     * @return JsonResponse
     */
    public function send(): JsonResponse
    {
        return response()->json(
            $this->payload,
            $this->status
        );
    }
}