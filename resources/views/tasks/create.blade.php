<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Task</title>
</head>
<body>
    <h1>Tambah Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Judul</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
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
            >{{ old('description') }}</textarea>
        </div>

        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="pending" @selected(old('status') === 'pending')>
                    Pending
                </option>

                <option value="in_progress" @selected(old('status') === 'in_progress')>
                    In Progress
                </option>

                <option value="completed" @selected(old('status') === 'completed')>
                    Completed
                </option>
            </select>
        </div>

        @error('status')
            <p>{{ $message }}</p>
        @enderror

        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('tasks.index') }}">Kembali</a>
    </form>
</body>
</html>
