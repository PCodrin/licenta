@if ($errors->any())
    <div class="notification is-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <ol><strong style="color:red;">{{ $error }}</strong></ol>
            @endforeach
        </ul>
    </div>
@endif
