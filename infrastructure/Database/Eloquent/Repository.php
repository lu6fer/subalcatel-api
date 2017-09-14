<?php

namespace Infrastructure\Database\Eloquent;

use Optimus\Genie\Repository as BaseRepository;
use Illuminate\Support\Facades\Event;

abstract class Repository extends BaseRepository
{
    public function getBySlug($slug, array $options = [])
    {
        $query = $this->createBaseBuilder($options);

        return $query->where('slug', $slug)->first();
    }
}
