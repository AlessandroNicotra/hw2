<nav>
    <a href="/index" id="logo">HW2</a>
    <form action="/search_f" method="post">
        @csrf
        <input type="text" name="cerca" placeholder="Cerca un film">
        <input type="submit" value="CERCA">
    </form>
</nav>
