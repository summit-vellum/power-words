<?php

namespace Quill\PowerWords\Resource;

use Quill\Html\Fields\ID;
use Quill\PowerWords\Models\PowerWords;
use Vellum\Contracts\Formable;

class PowerWordsResource extends PowerWords implements Formable
{
    public function fields()
    {
        return [
            ID::make()->sortable()->searchable(),
        ];
    }

    public function filters()
    {
        return [
            //
        ];
    }

    public function actions()
    {
        return [
            new \Vellum\Actions\EditAction,
            new \Vellum\Actions\ViewAction,
            new \Vellum\Actions\DeleteAction,
        ];
    }

    public function excludedFields()
    {
    	return [
    		//
    	];
    }
}
