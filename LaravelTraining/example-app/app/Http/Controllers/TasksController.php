<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

function makeResponse($task, $user)
{
    $arrayUsers = $task->users()->select("users.id", 'users.email', 'users.first_name')->get()->makeHidden(['pivot']);

    $authorId = $task->created_by;

    // Добавляем поле `type` для каждого пользователя
    $usersWithType = $arrayUsers->map(function ($user) use ($authorId) {
        $user->type = ($user->id == $authorId) ? 'author' : 'user';
        return $user;
    });

    // Конвертируем коллекцию в массив
    $usersWithTypeArray = $usersWithType->toArray();
    return $usersWithTypeArray;
}

class TasksController extends Controller
{
    public function add(Request $request)
    {
        $validateData = $request->validate([
            "title" => "string|required|max:100",
            "description" => "string|required|min:100"
        ]);

        $user = $request->user();
        $task = $user->createdTasks()->create($validateData);
        $task->users()->attach($user->id);

        return response()->json([
            "success" => true,
            "message" => "Success",
            "name" => $validateData["title"],
        ]);
    }
    public function update(string $id, Request $request)
    {
        $validateData = $request->validate(["title" => "required|string|max:100"]);
        $task = Task::find($id);

        $task->update(["title" => $validateData["title"]]);
        return response()->json(["message" => $task]);
    }
    public function getOne(string $id)
    {
        $task = Task::find($id);
        return response()->json([
            'message' => $task
        ]);
    }

    public function addUsers(Request $request, Task $task)
    {

        $validData = $request->validate([
            "email" => "string|required|email"
        ]);
        try {
            $user = User::where("email", $validData["email"])->firstOrFail();
            // Do something with $task
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        if ($request->user()->id === $task->creator->id) {

            if (!$task->users->contains($user->id)) {

                $task->users()->attach($user->id);


                return response()->json(['message' => makeResponse($task, $user)]);
            } else {
                return response()->json(['message' => 'This User is alredy added'], 400);
            }
        }

        return response()->json(['message' => 'Not your tasks'], 403);
    }

    public function disk(Request $request)
    {
        return response()->json(["message" => $request->user()->createdTasks()->select("title", "tasks.id", "description")->get()->toArray()]);
    }

    public function shared(Request $request)
    {
        return response()->json(["message" => $request->user()->accessibleTasks()->select("title", "tasks.id", "description")->get()->toArray()]);
    }

    public function deleteUsers(Request $request, Task $task)
    {
        $validData = $request->validate([
            "email" => "string|required|email"
        ]);

        if ($request->user()->email === $validData["email"]) {
            return response()->json(["message" => "You try delete yourself"]);
        }

        $user = User::where("email", $validData["email"])->first();

        if ($request->user()->id === $task->creator->id) {


            $task->users()->detach($user->id);


            return response()->json(['message' => makeResponse($task, $user)]);
        }
    }
    public function getUsers(Request $request, Task $task)
    {
        return response()->json(['message' => makeResponse($task, $request->user())]);
    }
    public function delete(Task $task, Request $request)
    {
        if ($request->user()->id === $task->creator->id) {

            $task->users()->detach();

            // Удаляем сам task
            $task->delete();

            return response()->json([
                'message' => 'Task удалена успешно!'
            ]);
        }
    }
}
