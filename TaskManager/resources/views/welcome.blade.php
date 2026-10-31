<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-900">
    <main class="mx-auto flex min-h-screen max-w-5xl items-center justify-center px-6 py-16">
        <section class="w-full max-w-lg rounded-2xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200 sm:p-12">
            <h1 class="text-3xl font-bold tracking-tight">Task Manager</h1>
            <p class="mt-3 text-slate-600">Manage your daily tasks easily.</p>
            <div class="mt-8 flex justify-center gap-3">
                <a href="{{ route('login') }}" class="rounded-lg bg-blue-600 px-5 py-2.5 font-semibold text-white transition hover:bg-blue-700">Login</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-emerald-600 px-5 py-2.5 font-semibold text-white transition hover:bg-emerald-700">Register</a>
            </div>
        </section>
    </main>
</body>
</html>
