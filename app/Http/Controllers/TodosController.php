<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::paginate();

        return response()->json([
            'todos' => $todos,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->save();

        return response()->json([
            'msg' => 'Todo has been created!',
            'todo' => $todo,
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return response()->json([
            'todo' => $todo,
        ],200);
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
        $this->validator($request);

        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->save();

        return response()->json([
            'msg' => 'Todo has been updated!',
            'todo' => $todo,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return response()->json([
            'msg' => 'Todo has been deleted!',
            'todo' => $todo,
        ],200);
    }

    /**
     * Validate the Request.
     * @param Request $request
     * @return void
     */
    private function validator(Request $request){
        $this->validate($request,[
            'name' => 'required|string|min:5|max:191',
            'description' => 'required|string|min:5|max:5000',
        ]);
    }
}
