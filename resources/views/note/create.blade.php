<x-app-layout>
    <div class="container py-5">
        <h1 class="text-center display-4">Create Note</h1>
        <div class="row">
            <div class="mx-auto col-lg-6">
                <form action="{{ route('note.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" class="mb-3 form-control">
                    @error('image')
                        <small class="text-danger">{{ $errors->first('image') }}</small>
                    @enderror
                    <textarea name="notes" class="form-control" rows="10">{{ old('notes') }}</textarea>
                    @error('notes')
                        <small class="text-danger">{{ $errors->first('notes') }}</small>
                    @enderror
                    <div class="mt-3">
                        <a class="btn btn-primary pe-3" href="{{ route('note.index') }}">Back</a>
                        <button class="btn btn-success pe-3" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
