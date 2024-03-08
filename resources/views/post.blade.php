<x-layout>

    <article>
        <h1> {{ $post->title }} </h1>

        <p>
            by the  Author <a href="#"> John Snow </a> in
            <a href="categories/{{$post->category->slug}}">
                {{$post->category->name}}
            </a>
        </p>

        <div>
            {!!  $post->body!!}
        </div>
    </article>

    <a href="/">back to homepage</a>
</x-layout>

