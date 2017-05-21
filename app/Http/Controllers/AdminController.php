<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProspectsSources;
use App\Models\ProspectsTypes;
use App\Models\Prospects;
use Kris\LaravelFormBuilder\FormBuilder;
use Github\Client;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \Github\Client();
        $client->authenticate("webdesignstudiouk", "K1r4d4x31246969!", \Github\Client::AUTH_HTTP_PASSWORD);

        //get all commits (changes)
        $commits = $client->api('repo')->commits()->all('webdesignstudiouk', 'ebn_dev', array('sha' => 'master'));
        
        //get all issues
        $issues = $client->api('issue')->all('webdesignstudiouk', 'ebn_dev');

        return view('admin.changeLog')
            ->with('commits', $commits)
            ->with('issues', $issues);
    }

	public function colours()
    {
        echo "test";
    }

	public function options(FormBuilder $formBuilder)
    {
		$sourceCodes = new ProspectsSources();
		$sourceCodes = $sourceCodes->all();
		$createSourceCodes_form = $formBuilder->create(\App\Forms\Options\CreateSourceCode::class, [
            'method' => 'POST',
            'url' => route('sourceCodes.store')
        ]);

		return view('admin.options')
		->with('sourceCodes', $sourceCodes)
		->with('createSourceCodes_form', $createSourceCodes_form);
	}

  public function storedInfomation($type_id){
    if($type_id == "deleted"){
      $typeTitle = "Deleted";
      $prospects = Prospects::withTrashed()->with('user')->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->paginate(1000);
    }else{
      $typeTitle = ProspectsTypes::find($type_id)->title;
      $prospects = Prospects::with('user')->where('type_id', $type_id)->where('user_id', '!=', 2)->where('user_id', '!=', 2)->paginate(1000);
    }
    return view('admin.storedInfomation.storedInfomation')
           ->with('prospects', $prospects)
           ->with('typeTitle', $typeTitle);
	}



}
