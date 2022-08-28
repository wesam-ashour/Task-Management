<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Task as ProductResource;

class TaskController extends BaseController

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {
        $products = Task::all();

        return $this->sendResponse(ProductResource::collection($products), 'Tasks retrieved successfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Task::create($input);
        return $this->sendResponse(new ProductResource($product), 'Task created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {
        $product = Task::find($id);

        if (is_null($product)) {
            return $this->sendError('Task not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Task retrieved successfully.');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Task $task)

    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $task->title = $input['title'];
        $task->description = $input['description'];
        $task->save();

        return $this->sendResponse(new ProductResource($task), 'Task updated successfully.');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Task $task)

    {
        $task->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }

}
