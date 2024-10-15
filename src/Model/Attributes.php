<?php

namespace App\Model;

use Symfony\Component\Serializer\Attribute\SerializedPath;

class Attributes
{
    public ?string $title = null;
    #[SerializedPath('grid.columns')]
    public ?array $columns = null;
}
