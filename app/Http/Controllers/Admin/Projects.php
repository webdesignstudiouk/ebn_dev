<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail as Mailer;
use Illuminate\Support\Facades\Log;

use App\Mail\BugUpdate;

use Auth;
use App\User;
use App\Client;
use App\Clients_Portfolio;
use App\Service;
use App\Clients_Project_Bugs;
use App\Clients_Project_Bugs_Updates;

class Projects extends Controller
{
	protected $projects;
	protected $clients;
	protected $bugs;

	public function __construct(){
		$this->projects = new Clients_Portfolio;
		$this->clients = new Client;
		$this->bugs = new Clients_Project_Bugs;
	}

	public function projects(){
		$projects = $this->projects->get();
		return view('admin.Projects.projects')
		->with('projects', $projects);
	}

	public function userProjects($id){
		$client = $this->clients->find($id);
		$projects = $client->portfolio;
		return view('admin.Projects.projects')
		->with('client', $client)
		->with('projects', $projects);
	}

	public function project($id){
		$project = $this->projects->find($id);

		$projectMetaKeys = array_keys($project->getMeta()->toArray());
		$projectMetaValues = array_values($project->getMeta()->toArray());
		$projectDetails = array();

		foreach($projectMetaKeys as $key){
			$projectDetails['keys'] = $projectMetaKeys;
			$projectDetails['values'] = $projectMetaValues;
		}

		$services = Service::pluck('name', 'id')->toArray();
		return view('admin.Projects.project')
		->with('project', $project)
		->with('projectDetails', $projectDetails)
		->with('services', $services);
	}

	public function updateProject(Request $request){
		$id = $request->input('id');
		$project = $this->projects->find($id);

		$count = 0;
		$projectMetaKeys = array_keys($project->getMeta()->toArray());
		$projectMetaValues = array_values($project->getMeta()->toArray());
		foreach($projectMetaKeys as $key){
			$$key = $request->input($key);
			$count++;
		}

		$count = 0;
		foreach($projectMetaKeys as $key){
			$project->setMeta($key, $$key);
			$count++;
		}

		$project->save();

		return redirect('admin/projects/'.$id);
	}

	public function userProject($client_id, $project_id){
		$client = $this->clients->find($client_id);
		$project = $this->projects->find($project_id);
		$projectMetaKeys = array_keys($project->getMeta()->toArray());
		$projectMetaValues = array_values($project->getMeta()->toArray());
		$projectDetails = array();

		foreach($projectMetaKeys as $key){
			$projectDetails['keys'] = $projectMetaKeys;
			$projectDetails['values'] = $projectMetaValues;
		}

		$services = Service::pluck('name', 'id')->toArray();
		return view('admin.Projects.project')
		->with('client', $client)
		->with('project', $project)
		->with('projectDetails', $projectDetails)
		->with('services', $services);
	}

	public function addMeta(Request $request){
		$id = $request->input('id');
		$key = $request->input('key');
		$value = $request->input('value');
		if($key != ""){
			$project = $this->projects->find($id);
			$project->setMeta($key, $value);
			$project->save();
		}
		return redirect('admin/projects/'.$id);
	}

	public function deleteMeta($id, $meta){
		$project = $this->projects->find($id);
		unset($project->$meta);
		$project->save();
		return redirect('admin/projects/'.$id);
	}

	public function portfolioList($id){
		$client = $this->clients->find($id);
		$portfolio = $client->portfolio;
		return view('admin.Clients.client_portfolio')
		->with('client', $client)
		->with('portfolio', $portfolio);
	}

	public function projectBugsAdmin($project_id){
		$project = $this->projects->find($project_id);
		$client = $this->clients->find($project->client_id);
		return view('admin.Projects.Bugs.bugs')
		->with('client', $client)
		->with('project', $project);
	}

	public function projectBugsClient($client_id, $project_id){
		$project = $this->projects->find($project_id);
		$client = $this->clients->find($project->client_id);
		return view('admin.Projects.Bugs.bugs')
		->with('client', $client)
		->with('project', $project);
	}

	public function projectBug($project_id, $bug_id){
		$bug = $this->bugs->find($bug_id);
		$project = $this->projects->find($project_id);
		$client = $this->clients->find($project->client_id);
		return view('admin.Projects.Bugs.bug')
		->with('client', $client)
		->with('project', $project)
		->with('bug', $bug);
	}

	public function user_projectBug($client_id,$project_id, $bug_id){
		$bug = $this->bugs->find($bug_id);
		$project = $this->projects->find($project_id);
		$client = $this->clients->find($client_id);
		return view('admin.Projects.Bugs.bug')
		->with('client', $client)
		->with('project', $project)
		->with('bug', $bug);
	}

	public function updateBug(Request $request){
		$bugId = $request->input('bug_id');
		$description = $request->input('description');
		$bug = $this->bugs->find($bugId);
		$bug->description = $description;
		$bug->save();


		$blog = Blog::where('status','published')->get()->sortByDesc("id")->take(3);
		$portfolio = Clients_Portfolio::all()->sortBy("id")->take(3);
		return view('email.bugUpdate')
		->with('blog', $blog)
		->with('portfolio', $portfolio);

		return back();
	}

	public function closeBug($bugId, $loggedInUser){
		$bug = $this->bugs->find($bugId);
		if($bug->status != "closed"){
			$bug->status = "closed";
			$bug->save();

			$bugUpdate = new Clients_Project_Bugs_Updates;
			$bugUpdate->bug_id = $bugId;
			$bugUpdate->author_id = $loggedInUser;
			$bugUpdate->description = "Bug Closed";
			$bugUpdate->type = "closed";
			$bugUpdate->save();
		}
		return back();
	}

	public function deleteBug($bugId){
		$bug = $this->bugs->find($bugId)->delete();
		$bugUpdate = new Clients_Project_Bugs_Updates;
		$bugUpdate->where('bug_id', $bugId)->delete();
		return back();
	}

	public function createBug(Request $request){
		$projectId = $request->input('project_id');
		$description = $request->input('description');

		$bug = new Clients_Project_Bugs;
		$bug->project_id = $projectId;
		$bug->description = $description;
		$bug->status = "open";
		$bug->save();

		$project = $this->projects->find($projectId);

		//Notification::send(User::all(), new BugCreated($bug));
		return back();
	}

	public function addBugUpdate(Request $request){
		$bugId = $request->input('bug_id');
		$description = $request->input('description');
		$type = $request->input('type');
		$authorId = $request->input('author_id');
		$bugUpdate = new Clients_Project_Bugs_Updates;
		$bugUpdate->bug_id = $bugId;
		$bugUpdate->author_id = $authorId;
		$bugUpdate->description = $description;
		$bugUpdate->type = $type;
		$bugUpdate->save();

		/*
		$bug = \App\Clients_Project_Bugs::find($bugId);
		foreach($bug->project->client->users as $user){
			Mailer::to("ian@energybuyersnetwork.com")->queue(new BugUpdate($bugId, $description));
		}
		*/
		return back();
	}
}
