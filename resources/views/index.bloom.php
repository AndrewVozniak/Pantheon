@include(start)
    @component(header)

    <h1>Hello {{ $name }}</h1>
    <h2>If condition:</h2>
    <span>
        @if($name === 'Bloom')
            <p>Hi Bloom!</p>
        @elseif($name === 'Jane' or $name == 'John')
            <p>Hi Jane or {{ $name }}!</p>
        @else
            <p>Hi Stranger!</p>
        @endif
    </span>

    <h2>Foreach loop:</h2>
    <ul>
        @foreach($someArray as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    <h2>For loop:</h2>
    <ul>
        @for($i = 0; $i < 10; $i++)
            <li>{{ $i }}</li>
        @endfor
    </ul>

    <h2>Isset example:</h2>
    <span>
        @isset($name)
            <p>Hi {{ $name }}!</p>
        @endisset
    </span>

    <h2>Empty example:</h2>
    <span>
        @empty($emptyArray)
            <p>Hi {{ $name }}!</p>
        @endempty
    </span>
@include(end)