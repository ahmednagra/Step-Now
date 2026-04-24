@php
    use Illuminate\Support\Facades\Route;
@endphp
<div class="bg-light p-2 rounded mb-3" style="overflow-x: auto; white-space: nowrap;">
    <ul class="nav nav-pills flex-row" style="min-width: max-content;">
        <li class="nav-item">
            <a href="{{ route('admin.service.edit', ['slug' => $slug]) }}"
                class="nav-link {{ Route::currentRouteName() == 'admin.service.edit' ? 'active' : '' }}">
                Edit Service
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.service.section.index', ['slug' => $slug]) }}"
                class="nav-link {{ Route::currentRouteName() == 'admin.service.section.index' || Route::currentRouteName() == 'admin.service.section.add' || Route::currentRouteName() == 'admin.service.section.edit' ? 'active' : '' }}">
                Sections
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.service.block.index', ['slug' => $slug]) }}"
                class="nav-link {{ Route::currentRouteName() == 'admin.service.block.index' || Route::currentRouteName() == 'admin.service.block.add' || Route::currentRouteName() == 'admin.service.block.edit' ? 'active' : '' }}">
                Blocks
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.service.element.index', ['slug' => $slug]) }}"
                class="nav-link {{ Route::currentRouteName() == 'admin.service.element.index' || Route::currentRouteName() == 'admin.service.element.add' || Route::currentRouteName() == 'admin.service.element.edit' ? 'active' : '' }}">
                Elements
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.service.feature.index', ['slug' => $slug]) }}"
                class="nav-link {{ Route::currentRouteName() == 'admin.service.feature.index' || Route::currentRouteName() == 'admin.service.feature.add' || Route::currentRouteName() == 'admin.service.feature.edit' ? 'active' : '' }}">
                Features
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.service.setting', ['slug' => $slug]) }}"
                class="nav-link {{ Route::currentRouteName() == 'admin.service.setting' ? 'active' : '' }}">
                Settings
            </a>
        </li>
    </ul>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const activeLink = document.querySelector('.nav-link.active');
        if (activeLink) {
            activeLink.scrollIntoView({
                behavior: 'smooth',
                inline: 'start'
            });
        }
    });
</script>
