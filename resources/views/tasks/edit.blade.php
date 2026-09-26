<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Judul</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $task->title) }}"
            >
        </div>

        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="description">Deskripsi</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description', $task->description) }}</textarea>
        </div>

        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="status">Status</label>
            <select id="status" name="status">
                <option
                    value="pending"
                    @selected(old('status', $task->status) === 'pending')
                >
                    Pending
                </option>

                <option
                    value="in_progress"
                    @selected(old('status', $task->status) === 'in_progress')
                >
                    In Progress
                </option>

                <option
                    value="completed"
                    @selected(old('status', $task->status) === 'completed')
                >
                    Completed
                </option>
            </select>
        </div>

        @error('status')
            <p>{{ $message }}</p>
        @enderror

        <br>

        <button type="submit">Update</button>
        <a href="{{ route('tasks.index') }}">Kembali</a>
    </form>
</body>
</html>
