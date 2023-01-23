<aside class="aside-menu h-100 py-5 d-flex flex-column justify-content-between">
    <nav class="">
        <ul class="text-left px-4">
            <li class="mb-4">
                <a href="{{ route('admin.dashboard') }}"><i class="fa-regular fa-user"></i> Area Personale</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-object-group"></i> I tuoi progetti</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-circle-plus"></i> Aggiungi nuovo</a>
            </li>


        </ul>
    </nav>
    <div class="settings-area p-3 text-left">
        <a href="#"><i class="fa-solid fa-gear"></i> Impostazioni</a>
    </div>

</aside>
