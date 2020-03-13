<?php

namespace Quill\PowerWords\Models;

use Vellum\Models\BaseModel;
use Quill\PowerWords\Models\PowerWords;

class PowerWords extends BaseModel
{

    protected $table = 'power_words';

    public function parent_power_words()
    {
    	return $this->hasOne(PowerWords::class, 'id', 'parent_id');
    }

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
