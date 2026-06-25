@csrf

@if ($course->exists)
    @method('PUT')
@endif

<div>
    <label for="name" class="block text-sm font-semibold text-slate-800">Course name</label>
    <input
        id="name"
        name="name"
        type="text"
        value="{{ old('name', $course->name) }}"
        placeholder="e.g. Introduction to Programming"
        required
        autofocus
        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
    >
    @error('name')
        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label for="credits" class="block text-sm font-semibold text-slate-800">Credits</label>
    <input
        id="credits"
        name="credits"
        type="number"
        min="1"
        max="30"
        value="{{ old('credits', $course->credits) }}"
        placeholder="3"
        required
        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
    >
    @error('credits')
        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <label for="documents" class="block text-sm font-semibold text-slate-800">Documents</label>
    <p class="mt-1 text-sm text-slate-500">
        {{ $course->exists
            ? 'Choose one or more files to add to the existing course documents.'
            : 'Choose one or more PDF, Word, or JPEG files up to 2 MB each.' }}
    </p>
    <input
        id="documents"
        name="documents[]"
        type="file"
        accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/*"
        multiple
        class="mt-3 block w-full cursor-pointer rounded-2xl border-2 border-dashed border-indigo-300 bg-indigo-50/50 p-2 text-sm text-slate-500 outline-none transition file:mr-6 file:cursor-pointer file:rounded-xl file:border-0 file:bg-indigo-600 file:px-5 file:py-3 file:text-sm file:font-semibold file:text-white hover:border-indigo-400 hover:bg-indigo-50 hover:file:bg-indigo-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
    >
    @error('documents')
        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
    @enderror
    @error('documents.*')
        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>

<div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
    <a href="{{ route('course.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancel</a>
    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700">
        {{ $course->exists ? 'Save changes' : 'Create course' }}
    </button>
    @if ($course->exists)
        <button
            type="submit"
            form="delete-course-form"
            class="inline-flex items-center justify-center rounded-xl border border-rose-200 bg-rose-50 px-5 py-3 text-sm font-semibold text-rose-700 transition hover:border-rose-300 hover:bg-rose-100"
        >
            Delete
        </button>
    @endif
</div>
