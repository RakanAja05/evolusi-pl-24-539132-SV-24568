<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>
</head>
<body>
    <h1>Task List</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('tasks.create') }}">+ Tambah Task</a>

    <br><br>

    @if ($tasks->isEmpty())
        <p>Belum ada task.</p>
    @else
        @foreach ($tasks as $task)
            <div>
                <h2>{{ $task->title }}</h2>

                <p>{{ $task->description }}</p>

                <p>
                    Status:
                    <strong>{{ $task->status }}</strong>
                </p>

                <a href="{{ route('tasks.edit', $task) }}">
                    Edit
                </a>

                <form
                    action="{{ route('tasks.destroy', $task) }}"
                    method="POST"
                    style="display:inline;"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>
                </form>
            </div>

            <hr>
        @endforeach
    @endif
</body>
</html>
