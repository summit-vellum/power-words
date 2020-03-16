<?php

namespace Quill\PowerWords\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vellum\Contracts\Resource;
use Quill\PowerWords\Models\PowerWords;

class PowerWordsController extends Controller
{
    protected $powerwords;

    public function __construct(Resource $resource)
    {
        $this->powerwords = $resource;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['column_name'] = $this->powerwords->getProperties();
        $data['rows'] = $this->powerwords->getValues();

        return view('powerwords::index');
    }

    /**
     * Validates whether the seo title contains a power word
     *
     * @param      \Illuminate\Http\Request             $request     The request
     * @param      \Quill\PowerWords\Models\PowerWords  $powerWords  The power words
     *
     * @return     json                               if word exists
     */
    public function checkUsage(Request $request, PowerWords $powerWords)
    {
    	$seoTitle = $request->get('seoTitle');
    	$seoTitle = explode(' ', $seoTitle);
    	$aWordExists = false;

    	foreach ($seoTitle as $word) {
    		$seoTitlePowerWord = $powerWords->whereWord($word)->get();
    		if ($seoTitlePowerWord->count()) {
    			$aWordExists = true;
    			break;
    		}
    	}

    	return response()->json([
    		'aWordExists' => $aWordExists
    	]);
    }

    public function validateWord(Request $request, PowerWords $powerWords)
    {
    	$success = true;
    	$id = $request->get('id');
    	$word = $request->get('word');

    	if ($id) {
    		$exists = $powerWords->whereIdNot($id)->where('word', $word)->get();
    	} else {
    		$exists = $powerWords->where('word', $word)->get();
    	}

    	if (count($exists) > 0) {
    		$success = false;
    	}

    	return response()->json([
    		'success' => $success
    	]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
