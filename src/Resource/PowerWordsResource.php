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

            Text::make('SEO Power Word', 'word')
            	->rules('required')
            	->classes('cf-input')
            	->searchable()
            	->help('Please enter unique power word')
            	->setJs(['vendor/powerwords/js/validate_power_word.js'])
            	->displayAsEdit(),

            Select::make('Parent Power Word', 'parent_id')
            	->relation('word', 'word')
            	->modify(function($parent_id, $powerWord){
            		return ($powerWord->parent_power_words) ? $powerWord->parent_power_words->word : '';
            	})
            	->options(PowerWords::whereIsParentPowerWords()->pluck('word', 'id')->toArray())
            	->container([
	            	'sectionName' => 'parent-word',
	            	'view' => view('vellum::containers.row', ['yieldName'=>'parent-word', 'colClass'=>'cf-select-container'])
	            ]),

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
    	$deleteDialogNotif = [
    		'header' => 'Are you sure you want to delete this power word? You may no longer undo this once deleted.',
    		'valueDisplayedIn' => [
    			'title' => 'word',
    			'subText' => ''
    		],
    		'dismiss' => 'Cancel',
    		'continue' => 'Yes, Delete this power word'
    	];

        return [
            new \Vellum\Actions\EditAction,
            new \Vellum\Actions\DeleteAction($deleteDialogNotif, true),
        ];
    }

    public function excludedFields()
    {
    	return [
    		//
    	];
    }
}
