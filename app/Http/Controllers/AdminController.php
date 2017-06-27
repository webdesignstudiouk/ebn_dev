<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProspectsSources;
use App\Models\ProspectsTypes;
use App\Models\Prospects;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;
use Bican\Roles\Models\Role;
use App\Models\User;

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
        //$client->authenticate("webdesignstudiouk", "K1r4d4x31246969!", \Github\Client::AUTH_HTTP_PASSWORD);
        $client->authenticate("a0abde5f0413c442991af23e729cb22d29942e2f", null, \Github\Client::AUTH_HTTP_TOKEN);
  
        //get all commits (changes)
        $commits = $client->api('repo')->commits()->all('webdesignstudiouk', 'ebn_dev', array('sha' => 'master'));

        //get all issues
        $issues = $client->api('issue')->all('webdesignstudiouk', 'ebn_dev');

        //get new feature colomn
        $cards = $client->api('repo')->projects()->columns()->cards()->all(1049735);

        return view('admin.changeLog')
            ->with('commits', $commits)
            ->with('issues', $issues)
            ->with('cards', $cards);
    }

	public function roles()
    {
        $roles = Role::orderBy('id', 'asc')->get();
        return view('admin.roles.roles')
            ->with('roles', $roles);
    }

	public function options(FormBuilder $formBuilder)
    {
		$sourceCodes = new ProspectsSources();
		$sourceCodes = $sourceCodes->all();

		return view('admin.system')
		->with('sourceCodes', $sourceCodes);
	}

  public function storedInfomation($type_id){
    if($type_id == "deleted"){
      $typeTitle = "Deleted";
      $prospects = Prospects::withTrashed()->with('user')->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->paginate(1000);
    }else{
      $typeTitle = ProspectsTypes::find($type_id)->title;
      $prospects = Prospects::with('user')->where('type_id', $type_id)->where('user_id', '!=', 2)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->paginate(1000);
    }

      $untouched = DB::select('SELECT p.id FROM prospects as p LEFT JOIN prospects_callbacks as c ON p.id = c.prospect_id WHERE c.prospect_id IS NULL AND p.user_id != ""');

      return view('admin.storedInfomation.storedInfomation')
           ->with('prospects', $prospects)
           ->with('typeTitle', $typeTitle)
           ->with('untouched', count($untouched));
	}



}
