<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use App\User;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel)
    {
        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::latest();
        }

        if ($username = request('by')) {
            $username = User::where('name', $username)->firstOrFail();
            $threads->where('user_id', $username->id);
        }

        $threads = $threads->get();

        return view('pages.thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        $thread = new Thread();
        $thread->fill($request->all());
        $thread = auth()->user()->threads()->save($thread);

        return redirect('thread');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, Thread $thread)
    {
        return view('pages.thread.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Thread              $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
    }
}
