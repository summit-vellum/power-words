<?php

namespace Quill\PowerWords\Listeners;

class RegisterPowerWordsPermissionModule
{ 
    public function handle()
    {
        return [
            'PowerWords' => [
                'view'
            ]
        ];
    }
}
