@if (count($breadcrumbs))

    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb->url }}" class="breadcrumb-link">{{ $breadcrumb->title }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                    @endif

                @endforeach
            </ol>
        </nav>
    </div>

@endif
