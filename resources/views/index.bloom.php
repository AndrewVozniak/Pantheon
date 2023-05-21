@layout(app)

@section(title)
    Sample title
@endsection

@section(header)
    <h1>Заголовок дочернего шаблона</h1>
@endsection

@section(content)
    @include(card)
    <h1 class="text-3xl font-bold underline text-red-400 mb-2">Hello {{ $name }}</h1>
    <h2 class="text-2xl mt-5">If condition:</h2>
    <span>
        @if($name === 'Bloom')
            <p>Hi Bloom!</p>
        @elseif($name === 'Jane' or $name == 'John')
            <p>Hi Jane or {{ $name }}!</p>
        @else
            <p>Hi Stranger!</p>
        @endif
    </span>

    <h2 class="text-2xl mt-5">Foreach loop:</h2>
    <ul>
        @foreach($someArray as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    <h2 class="text-2xl mt-5">For loop:</h2>
    <ul>
        @for($i = 0; $i < 10; $i++)
            <li>{{ $i }}</li>
        @endfor
    </ul>

    <h2 class="text-2xl mt-5">Isset example:</h2>
    <span>
        @isset($name)
            <p>Hi {{ $name }}!</p>
        @endisset
    </span>

    <h2 class="text-2xl mt-5">Empty example:</h2>
    <span>
        @empty($emptyArray)
            <p>Hi {{ $name }}!</p>
        @endempty
    </span>

    <div class="mt-5">
        <div x-data="{ count: 0 }">
            <button x-on:click="count++" class="text-3xl font-bold underline text-red-400">Click me:</button>

            <span x-text="count" class="text-3xl font-bold underline text-red-400"></span>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="text-2xl">Route demonstration</h2>
        <a href="@route(home, ['id' => 1])" class="text-3xl font-bold underline text-red-400">Home</a>
    </div>

    <!-- @alert(s)-->
@endsection

@section(footer)
    <p>Подвал дочернего шаблона.</p>
@endsection