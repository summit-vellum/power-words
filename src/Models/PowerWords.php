<?php

namespace Quill\PowerWords\Models;

use Vellum\Models\BaseModel;

class PowerWords extends BaseModel
{

    protected $table = 'powerwords';

    public function history()
    {
        return $this->morphOne('Quill\History\Models\History', 'historyable');
    }

    public function resourceLock()
    {
        return $this->morphOne('Vellum\Models\ResourceLock', 'resourceable');
    }

    public function autosaves()
    {
        return $this->morphOne('Vellum\Models\Autosaves', 'autosavable');
    }

}
