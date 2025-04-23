<x-mail::message>
    # ✅ Task Created Successfully!

    Hello {{ $user->name }},

    You have successfully created a new task. Here are the details:

    **📝 Title:**
    {{ $task->title }}

    @if($task->description)

    **📄 Description:**
    {{ $task->description }}

    @endif

    Thanks,
    {{ config('app.name') }}
</x-mail::message>