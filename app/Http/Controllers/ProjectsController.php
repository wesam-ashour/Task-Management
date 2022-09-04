<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index','store']]);
        $this->middleware('permission:project-create', ['only' => ['create','store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        $projects = Project::all();
        $user = Auth::user();
        return view('projects.index', compact('projects','user','notifications'));
    }
    public function search(Request $request){
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        $from = $request->input('from');
        $to = $request->input('to');

        $projects = DB::table('projects')->select()
            ->where('deadline','>=',$from)
            ->where('deadline','<=',$to)
            ->get();
        return view('projects.index', compact('projects','user','notifications'));

    }

    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        $users = User::all()->pluck('name', 'id');
        $clients = Client::all()->pluck('company', 'id');

        return view('projects.create', compact('users', 'clients','notifications','user'));
    }

    public function store(CreateProjectRequest $request)
    {
//        $project = Project::create($request->validated());
        $validate = $request->validated();
        $Project = new Project();
        $Project->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
        $Project->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
        $Project->deadline = $request->deadline;
        $Project->status = $request->status;
        $Project->user_id = $request->user_id;
        $Project->client_id = $request->client_id;
        $Project->save();

        return redirect()->route('projects.index')->with('success-create','The project added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        $users = User::all()->pluck('name', 'id');
        $clients = Client::all()->pluck('company', 'id');

        return view('projects.edit', compact('users', 'clients','project','notifications','user'));
    }

    public function update(EditProjectRequest $request, Project $project)
    {
//        $project->update($request->validated());

        $Project = Project::findOrFail($project->id);
        $Project->update([
            $Project->title = ['en' => $request->title_en, 'ar' => $request->title_ar],
            $Project->description = ['en' => $request->description_en, 'ar' => $request->description_ar],
            $Project->deadline = $request->deadline,
            $Project->status = $request->status,
            $Project->user_id = $request->user_id,
            $Project->client_id = $request->client_id
        ]);

        return redirect()->route('projects.index')->with('success-edit','The project updated successfully');
    }

    public function destroy(Project $project)
    {
        if ($project->tasks()->exists()) {
            return redirect()->back()->with('status', 'Project belongs to task. Cannot delete.');
        }else{
            $project->delete();
        }

        return redirect()->route('projects.index')->with('success-delete','The project deleted successfully');

    }
}
