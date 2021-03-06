<?php

namespace Quill\PowerWords\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Quill\PowerWords\Models\PowerWords;

class PowerWordsSaving
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
    	$siteConfig = config('site');
    	$data->site_id = (isset($siteConfig['site_id']) && $siteConfig['site_id'] != '') ? $siteConfig['site_id'] : 0;
        $this->data = $data;
    }
}
