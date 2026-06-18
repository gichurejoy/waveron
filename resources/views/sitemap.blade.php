<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Static Pages --}}
    <url>
        <loc>https://waverontechnologies.co.ke/</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/about</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/services</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/services/software-development</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/services/graphic-design</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/services/branding</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/services/digital-marketing</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/portfolio</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/careers</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/contact</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/quote</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/blog</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/privacy-policy</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>https://waverontechnologies.co.ke/terms-of-service</loc>
        <lastmod>2026-06-05</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>

    {{-- Dynamic Blog Posts --}}
    @foreach($posts as $post)
    <url>
        <loc>https://waverontechnologies.co.ke/blog/{{ $post->slug }}</loc>
        <lastmod>{{ $post->updated_at->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

</urlset>
