<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DevConfigService
{
    protected string $path;

    public function __construct()
    {
        // directory for configs
        $this->path = base_path('devconf');

        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }
    }

    /**
     * Get config for device
     */
    public function get(string $deviceId): ?array
    {
        $file = $this->path . '/' . $deviceId . '.json';

        if (!file_exists($file)) {
            return null;
        }

        return json_decode(file_get_contents($file), true);
    }

    /**
     * Save configuration
     */
    public function save(string $deviceId, array $config): bool
    {
        $file = $this->path . '/' . $deviceId . '.json';

        return (bool) file_put_contents(
            $file,
            json_encode($config, JSON_PRETTY_PRINT)
        );
    }

    /**
     * List all configs
     */
    public function all(): array
    {
        $out = [];

        foreach (glob($this->path.'/*.json') as $file) {
            $id = basename($file, '.json');
            $out[$id] = json_decode(file_get_contents($file), true);
        }

        return $out;
    }
}
