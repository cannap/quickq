<?php

namespace Framework\Core\Http;

use RuntimeException;

class Response
{
    private array $headers = [];
    private mixed $content;
    private string $contentType = "application/json; charset=utf-8";
    private int $statusCode;

    public function __construct($content = '', int $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    public function send(): void
    {
        if (!headers_sent()) {
            $this->sendHeaders();
        }

        if ($this->content !== '') {
            echo $this->getContent();
        }
    }

    private function sendHeaders(): void
    {
        header_remove("X-Powered-By");
        header_remove("Server");
        header("Content-Type: {$this->contentType}");

        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value", false);
        }
    }

    private function getContent()
    {
        if ($this->contentType === "application/json; charset=utf-8" && $this->content !== '') {
            $content = json_encode($this->content);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('JSON encoding error: ' . json_last_error_msg());
            }
            return $content;
        }

        return $this->content;
    }

    public function header(string $key, string $value, bool $replace = true): self
    {
        if ($replace || !isset($this->headers[$key])) {
            $this->headers[$key] = $value;
        } else {
            $this->headers[$key] .= ", $value";
        }
        return $this;
    }

}