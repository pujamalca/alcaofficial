@php
    $generalSettings = app(\App\Settings\GeneralSettings::class);
    $socialSettings = app(\App\Settings\SocialSettings::class);
    $siteName = $generalSettings->site_name ?? config('app.name', 'Starter Kit');
    $siteDescription = $generalSettings->site_description ?? 'Laravel Starter Kit yang lengkap dengan Filament Admin Panel, API RESTful, Content Management System, dan fitur-fitur modern lainnya untuk mempercepat development aplikasi web Anda.';
    $siteLogo = $generalSettings->site_logo;

    // Get pages for footer
    $footerPages = \App\Models\Page::showInFooter()->get();
@endphp

<footer class="bg-gray-900 text-white mt-auto">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            {{-- Footer Column 1 - About --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    @if($siteLogo)
                        <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-8 w-auto object-contain">
                    @else
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ substr($siteName, 0, 1) }}</span>
                        </div>
                    @endif
                    <h3 class="text-xl font-bold">{{ $siteName }}</h3>
                </div>
                <p class="footer-description text-gray-400 text-sm mb-4 max-w-md">
                    {{ $siteDescription }}
                </p>
                <div class="flex items-center gap-4 mt-24">
                @php
                    $socialLinks = [
                        ['label' => 'GitHub', 'icon' => 'github', 'url' => $socialSettings->github_url],
                        ['label' => 'X', 'icon' => 'twitter', 'url' => $socialSettings->twitter_url],
                        ['label' => 'LinkedIn', 'icon' => 'linkedin', 'url' => $socialSettings->linkedin_url],
                        ['label' => 'Facebook', 'icon' => 'facebook', 'url' => $socialSettings->facebook_url],
                        ['label' => 'Instagram', 'icon' => 'instagram', 'url' => $socialSettings->instagram_url],
                        ['label' => 'YouTube', 'icon' => 'youtube', 'url' => $socialSettings->youtube_url],
                    ];
                @endphp
                @foreach($socialLinks as $social)
                    @php
                        $href = $social['url'] ?: '#';
                        $isPlaceholder = empty($social['url']);
                    @endphp
                    <a href="{{ $href }}"
                       @if(!$isPlaceholder) target="_blank" rel="noopener noreferrer" @endif
                       class="text-gray-400 hover:text-white transition-colors {{ $isPlaceholder ? 'opacity-50 pointer-events-none' : '' }}"
                       aria-label="{{ $social['label'] }}"
                       @if($isPlaceholder) aria-disabled="true" tabindex="-1" @endif>
                        @include('layouts.partials.svg-icons.' . $social['icon'])
                    </a>
                @endforeach
                </div>
            </div>

            {{-- Footer Column 2 - Quick Links --}}
            <div>
                <h3 class="text-lg font-bold mb-4">Link Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                    <li><a href="/blog" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    @foreach($footerPages->take(4) as $footerPage)
                        <li><a href="{{ route('pages.show', $footerPage->slug) }}" class="text-gray-400 hover:text-white transition-colors">{{ $footerPage->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Footer Column 3 - More Links --}}
            <div>
                <h3 class="text-lg font-bold mb-4">Lainnya</h3>
                <ul class="space-y-2 text-sm">
                    @foreach($footerPages->skip(4) as $footerPage)
                        <li><a href="{{ route('pages.show', $footerPage->slug) }}" class="text-gray-400 hover:text-white transition-colors">{{ $footerPage->title }}</a></li>
                    @endforeach
                    <li><a href="/admin" class="text-gray-400 hover:text-white transition-colors">Admin Panel</a></li>
                </ul>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="border-t border-gray-800 pt-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-400">
                    &copy; {{ now()->year }} {{ $siteName }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
