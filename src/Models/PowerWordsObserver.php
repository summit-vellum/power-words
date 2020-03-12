<?php

namespace Quill\PowerWords\Models;

use Illuminate\Support\Str;
use Quill\PowerWords\Events\PowerWordsCreating;
use Quill\PowerWords\Events\PowerWordsCreated;
use Quill\PowerWords\Events\PowerWordsSaving;
use Quill\PowerWords\Events\PowerWordsSaved;
use Quill\PowerWords\Events\PowerWordsUpdating;
use Quill\PowerWords\Events\PowerWordsUpdated;
use Quill\PowerWords\Models\PowerWords;

class PowerWordsObserver
{

    public function creating(PowerWords $powerwords)
    {
        // creating logic... 
        event(new PowerWordsCreating($powerwords));
    }

    public function created(PowerWords $powerwords)
    {
        // created logic...
        event(new PowerWordsCreated($powerwords));
    }

    public function saving(PowerWords $powerwords)
    {
        // saving logic...
        event(new PowerWordsSaving($powerwords));
    }

    public function saved(PowerWords $powerwords)
    {
        // saved logic...
        event(new PowerWordsSaved($powerwords));
    }

    public function updating(PowerWords $powerwords)
    {
        // updating logic...
        event(new PowerWordsUpdating($powerwords));
    }

    public function updated(PowerWords $powerwords)
    {
        // updated logic...
        event(new PowerWordsUpdated($powerwords));
    }

}