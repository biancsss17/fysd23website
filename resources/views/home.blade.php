<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FYS D23') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto flex min-h-screen max-w-3xl items-center px-6 py-12">
        <section class="w-full rounded-2xl bg-white p-8 shadow-xl sm:p-12">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-indigo-600">FYS D23</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight">Build something useful.</h1>
            <p class="mt-4 max-w-xl text-slate-600">Your Laravel application is ready. Enter a business type below to test the future AI generation workflow.</p>
            @if ($errors->any())
                <div class="mt-6 rounded-lg bg-red-50 p-4 text-sm text-red-700" role="alert">{{ $errors->first('business_type') }}</div>
            @endif
            <form action="{{ url('/generate') }}" method="POST" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="business_type" class="block text-sm font-medium text-slate-700">Business type</label>
                    <input id="business_type" name="business_type" type="text" value="{{ old('business_type') }}" placeholder="e.g. Coffee shop" required class="mt-2 block w-full rounded-lg border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
                <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Generate</button>
            </form>
        </section>
    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
