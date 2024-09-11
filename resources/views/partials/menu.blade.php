<!-- resources/views/layouts/menu-children.blade.php -->
<ul class="menu-sub">
    @foreach ($children as $childItem)
        <li class="menu-item">
            <a href="{{ url($childItem->nama_url) }}"
                class="menu-link {{ isset($childItem->children) ? 'menu-toggle' : '' }}">
                <div data-i18n="{{ $childItem->nama_modul }}">{{ $childItem->nama_modul }}</div>
            </a>

            @if (isset($childItem->children) && count($childItem->children) > 0)
                @include('partials.menu', ['children' => $childItem->children])
            @endif
        </li>
    @endforeach
</ul>
