<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProspectsSources;
use App\Models\ProspectsTypes;
use App\Models\Prospects;
use Kris\LaravelFormBuilder\FormBuilder;
use Bican\Roles\Models\Role;
use Cache;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $client = new \Github\Client();
//        //$client->authenticate("webdesignstudiouk", "K1r4d4x31246969!", \Github\Client::AUTH_HTTP_PASSWORD);
//        $client->authenticate("a0abde5f0413c442991af23e729cb22d29942e2f", null, \Github\Client::AUTH_HTTP_TOKEN);
//
//        //get all commits (changes)
//        $commits = $client->api('repo')->commits()->all('webdesignstudiouk', 'ebn_dev', array('sha' => 'master'));
//
//        //get all issues
//        $issues = $client->api('issue')->all('webdesignstudiouk', 'ebn_dev');
//
//        //get new feature colomn
//        $cards = $client->api('repo')->projects()->columns()->cards()->all(1049735);

        return view('admin.changeLog');
//            ->with('commits', $commits)
//            ->with('issues', $issues)
//            ->with('cards', $cards);
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

    public function storedInfomation($type_id)
    {
        if ($type_id == "deleted") {
            $typeTitle = "Deleted";
        } else {
            $typeTitle = ProspectsTypes::find($type_id)->title;
        }

        if (!Cache::has('admin_prospects_count')) {
            Cache::put('admin_prospects_count', array(
                '1' => Prospects::where('type_id', 1)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count(),
                '2' => Prospects::where('type_id', 2)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count(),
                '3' => Prospects::where('type_id', 3)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count(),
                'deleted' => Prospects::withTrashed()->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count(),
              ), \Carbon\Carbon::now()->addDay());
        }

        $count = Cache::get('admin_prospects_count');


        return view('admin.storedInfomation.storedInfomation')
            ->with('count', $count)
            ->with('typeTitle', $typeTitle)
            ->with('type', $type_id);
    }

    public function stored_infomation_table_ajax($type_id)
    {
        if ($type_id == "deleted") {
            $prospects = Prospects::withTrashed()->with('user')->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->paginate(1000);
        } else {
            $prospects = Prospects::with('user')->where('type_id', $type_id)->where('user_id', '!=', 2)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->paginate(1000);
        }

        return view('admin.storedInfomation.ajax.stored_information_ajax')
            ->with('prospects', $prospects);
    }


}
