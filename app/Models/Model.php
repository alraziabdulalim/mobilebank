<?php

namespace App\Models;

class Model
{
    protected string $dataFile;

    public function __construct(string $filename)
    {
        $this->dataFile = __DIR__ . "/../../datastore/JSON/{$filename}.json";

        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }

    public function getAll(): array
    {
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }

    public function store(array $data): bool
    {
        $currentData = $this->getAll();
        $currentData[] = $data;

        return file_put_contents($this->dataFile, json_encode($currentData, JSON_PRETTY_PRINT)) !== false;
    }

    public function findById($id): ?array
    {
        $data = $this->getAll();

        foreach ($data as $record) {
            if ($record['id'] == $id) {
                return $record;
            }
        }

        return null;
    }

    protected function findByEmail(string $email): ?array
    {
        $allData = $this->getAll();
        foreach ($allData as $record) {
            if ($record['email'] === $email) {
                return $record;
            }
        }
        return null;
    }

    public function update($id, array $newData): bool
    {
        $data = $this->getAll();

        foreach ($data as &$record) {
            if ($record['id'] == $id) {
                $record = array_merge($record, $newData);
                return file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT)) !== false;
            }
        }

        return false;
    }

    public function delete($id): bool
    {
        $data = $this->getAll();

        $filteredData = array_filter($data, fn($record) => $record['id'] != $id);

        return file_put_contents($this->dataFile, json_encode($filteredData, JSON_PRETTY_PRINT)) !== false;
    }
}
