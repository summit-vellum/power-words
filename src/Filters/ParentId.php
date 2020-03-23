<?php

namespace Quill\PowerWords\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Vellum\Filters\Filter;
use Quill\PowerWords\Models\PowerWords;


class ParentId extends Filter
{

    /**
     * Additional query builder
     * @param  Builder $builder Current eloquent query
     * @param  mixed  $value   Value to be used for the query
     * @return Builder
     */
    public function applyFilter(Builder $builder)
    {
    	if (request($this->filterName()) != null) {
    		$builder->with('parent_power_words')
	            ->whereHas('parent_power_words', function($query) {
	                $query->where($this->foreignKey(), request($this->filterName()));
	        });
    	}

        return $builder;
    }

    /**
     * Key to be used for select name and param url
     * @return string
     */
    public function key()
    {
        return 'parent_id';
    }

    protected function foreignKey()
    {
        return 'id';
    }

    /**
     * List of values in the dropdown
     * @return array
     */
    public function options()
    {
        return PowerWords::whereIsParentPowerWords()->pluck('word', 'id')->toArray();
    }


    public function js()
    {
    	return [
    		//
    	];
    }

    public function css()
    {
    	return [
    		//
    	];
    }

    public function html()
    {
    	return '';
    }

    public function label()
    {
    	return 'Arrangement';
    }

}
