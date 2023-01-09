<h1>Home</h1><br>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <a href="#" class="nav-link">

        <i class="fa-solid fa-right-from-bracket"></i>
        <button class="btn btn-info">
            Logout
        </button>
    </a>
</form>
