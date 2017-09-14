<?php

namespace Infrastructure\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

abstract class ModelSluggable extends BaseModel
{
    use Sluggable;
    use SluggableScopeHelpers;
}
