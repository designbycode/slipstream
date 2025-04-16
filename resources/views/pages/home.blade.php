<x-app-layout>
    <div class="wrapper my-20">
        <h1 class="text-2xl font-bold tracking-tight mb-2">Home</h1>

        @can('publish articles')
            <x-button>Delete</x-button>
        @endcan
    </div>
    <div class="wrapper my-20">
        @role('writer')
        <h1 class="text-2xl font-bold tracking-tight mb-2">Writers</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus dignissimos earum eius inventore iusto nemo possimus quis? Adipisci, deserunt, voluptates. Excepturi, in, incidunt. Ab blanditiis, delectus fugit laudantium
            pariatur perferendis!</p>
        @endrole

        @role('admin')
        <h1 class="text-2xl font-bold tracking-tight mb-2">Admin</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus dignissimos earum eius inventore iusto nemo possimus quis? Adipisci, deserunt, voluptates. Excepturi, in, incidunt. Ab blanditiis, delectus fugit laudantium
            pariatur perferendis!</p>
        @endrole


        @role('Super Admin')
        <h1 class="text-2xl font-bold tracking-tight mb-2">Super Admin</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus dignissimos earum eius inventore iusto nemo possimus quis? Adipisci, deserunt, voluptates. Excepturi, in, incidunt. Ab blanditiis, delectus fugit laudantium
            pariatur perferendis!</p>
        @endrole
    </div>
</x-app-layout>
