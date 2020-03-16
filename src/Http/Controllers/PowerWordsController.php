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
