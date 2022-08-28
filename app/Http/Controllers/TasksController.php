<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TasksNotification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TasksController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();

        if ($request->ajax()) {
            $data = Task::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('AssignedTo', function (Task $task) {
                    return $task->user->name;
                })
                ->addColumn('Client', function (Task $task) {
                    return $task->client->company;
                })
                ->addColumn('action', function (Task $task) {
                    $actionBtn = '
                    <a class="btn btn-sm btn-info" href="' . route('tasks.show', $task->id) . '">Show</a>
                    <a href="' . route('tasks.edit', $task) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('tasks.destroy', $task->id) . '" onsubmit=" return confirmDelete();" method="POST" style="display: inline-block;">
                       <input type="hidden" name="_method" value="DELETE">
                       <input type="hidden" name="_token" value="' . csrf_token() . '">
                       <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                    </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $tasks = Task::all();
        }
        return view('tasks.index', compact('tasks', 'user', 'notifications'));
    }

    public function store(CreateTaskRequest $request)
    {
        $task = Task::create($request->validated());
        $user = User::find($request->user_id);

        return redirect()->route('tasks.index')->with('success-create', 'The task added successfully');

    }

    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();


        $users = User::all()->pluck('name', 'id');
        $clients = Client::all()->pluck('company', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('tasks.create', compact('users', 'clients', 'projects', 'user', 'notifications'));
    }

    public function show($id)
    {
        $task = Task::find($id);
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        return view('tasks.show', compact('task', 'notifications', 'user'));

    }

    public function edit(Task $task)
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        $users = User::all()->pluck('name', 'id');
        $clients = Client::all()->pluck('company', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('tasks.edit', compact('users', 'clients', 'projects', 'task', 'user', 'notifications'));
    }

    public function taskComplete(Request $request, $id)
    {
        $user = User::where('id', 1)->get('email');

        $input = $request->all('status', 'title');
        $task = Task::find($id)->update(['status' => 'closed']);

        Notification::send($user, new TasksNotification($input));

        return redirect()->back();

    }

    public function update(EditTaskRequest $request, Task $task)
    {
        $user = Auth::user()->get('email');
        $task->update($request->validated());

        $input = $request->all('status', 'title');
        Notification::send($user, new TasksNotification($input));

        return redirect()->route('tasks.index')->with('success-edit', 'The task updated successfully');

    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success-delete', 'The task deleted successfully');

    }
}
