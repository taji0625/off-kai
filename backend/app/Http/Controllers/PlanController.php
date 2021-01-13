<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Plan::class, 'plan');
    }

    public function index() 
    {
        $plans = Plan::all()->sortByDesc('created_at');
        return view('plans.index', ['plans' => $plans]);
    }

    public function create(Plan $plan)
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('plans.create', [
            'plan' => $plan,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all());
        $plan->user_id = $request->user()->id;
        $plan->save();

        $request->tags->each(function ($tagName) use ($plan) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $plan->tags()->attach($tag);
        });

        return redirect()->route('plans.index');
    }

    public function edit(Plan $plan)
    {
        $tagNames = $plan->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('plans.edit', [
            'plan' => $plan,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all())->save();
        $plan->tags()->detach();
        $request->tags->each(function ($tagName) use ($plan) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $plan->tags()->attach($tag);
        });
        return redirect()->route('plans.index');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index');
    }

    public function show(Plan $plan, Comment $comment)
    {
        $user = auth()->user();
        $comments = $plan->comments()->orderBy('created_at', 'desc')->get();
        
        return view('plans.show', [
            'plan' => $plan,
            'comments' => $comments,
            'user' => $user,
        ]);
    }

    public function interest(Request $request, Plan $plan)
    {
        $plan->interests()->detach($request->user()->id);
        $plan->interests()->attach($request->user()->id);

        return [
            'id' => $plan->id,
            'countInterests' => $plan->count_interests,
        ];
    }

    public function uninterest(Request $request, Plan $plan)
    {
        $plan->interests()->detach($request->user()->id);

        return [
            'id' => $plan->id,
            'countInterests' => $plan->count_interests,
        ];
    }
}
