<?php

namespace Quill\PowerWords\Resource;

use Quill\Html\Fields\ID;
use Quill\PowerWords\Models\PowerWords;
use Vellum\Contracts\Formable;
use Quill\Html\Fields\Text;
use Quill\Html\Fields\Select;

class PowerWordsResource extends PowerWords implements Formable
{
    public function fields()
    {
        return [
            ID::make()->sortable()->searchable(),

            Select::make('Parent Word', 'parent_id')
            	->relation('word', 'word')
            	->modify(function($parent_id, $powerWord){
            		return ($powerWord->parent_power_words) ? $powerWord->parent_power_words->word : '';
            	})
            	->options(PowerWords::whereIsParentPowerWords()->pluck('word', 'id')->toArray())
            	->container([
	            	'sectionName' => 'parent-word',
	            	'view' => view('vellum::containers.render-select', ['yieldName'=>'parent-word'])
	            ]),

            Text::make('Power words', 'word')
            	->rules('required')
            	->classes('cf-input')
            	->searchable()
            	->help('Please enter unique power word'),

           	Text::make('Deleted at')
            ->hideFromIndex()
            ->hideOnForms()
        ];
    }

    public function filters()
    {
        return [
            \Quill\PowerWords\Filters\ParentId::class
        ];
    }

    public function actions()
    {
        return [
            new \Vellum\Actions\EditAction,
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
