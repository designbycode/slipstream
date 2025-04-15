<x-app-layout>
    <div class="wrapper my-20">
        <h1 class="text-2xl font-bold tracking-tight mb-2">Home</h1>

        <pre>

{{ json_encode(auth()->user(), JSON_PRETTY_PRINT) }}
</pre>
    </div>
</x-app-layout>
