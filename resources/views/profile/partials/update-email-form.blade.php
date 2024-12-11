<div class="max-w-xl">
  <form method="POST" action="{{ route('profile.update.email') }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo Electrónico</label>
      <input type="email" id="email" name="email"
        class="mt-1 block w-full rounded-md shadow-sm form-input dark:bg-gray-700 dark:text-gray-300"
        value="{{ old('email', auth()->user()->email) }}" required>
    </div>

    <div>
      <button type="submit" class="btn btn-primary">Actualizar Correo</button>
    </div>
  </form>
</div>