<?php 

namespace Quill\PowerWords\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Quill\PowerWords\Models\PowerWords;

class PowerWordsSaved
{
    // use Dispatchable, InteractsWithSockets, 
    use SerializesModels;
 
    public $data;

    /**
     * Create a new event instance.
     *
     * @param  \Quill\PowerWords\Models\PowerWords  $data
     * @return void
     */
    public function __construct(PowerWords $data) 
    {
        $this->data = $data;  
    }
}
