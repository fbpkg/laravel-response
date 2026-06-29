# Laravel Response

Fluent response builder for Laravel APIs with clean and consistent JSON structure.

---

## Installation

```bash
composer require fbpkg/laravel-response
````

---

## Usage

### Basic success response

```php
return LaravelResponse::success('OK')
    ->data($user)
    ->send();
```

---

### Error response

```php
return LaravelResponse::error('Something went wrong', 500)
    ->send();
```

---

### Validation response

```php
return LaravelResponse::error('Validation failed', 422)
    ->validation($validator)
    ->alert('warning', 'Please fix errors')
    ->send();
```

---

## Output Example

```json
{
  "status": "error",
  "message": "Validation failed",
  "meta": {
    "validation": {
      "email": ["Email is required"]
    },
    "alert": {
      "type": "warning",
      "message": "Please fix errors"
    }
  }
}
```

---

## License

MIT