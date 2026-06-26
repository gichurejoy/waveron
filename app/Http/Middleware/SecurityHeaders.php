<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * Applies a comprehensive set of HTTP security headers to every response
     * to protect against XSS, clickjacking, MIME sniffing, and MITM attacks.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // ── HSTS ──────────────────────────────────────────────────────────────
        // Tell browsers to always use HTTPS for the next 1 year.
        // includeSubDomains: applies to all subdomains.
        // preload: can be submitted to browser preload lists.
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains; preload'
        );

        // ── Clickjacking Protection ───────────────────────────────────────────
        // Only allow the site to be embedded in iframes from the same origin.
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // ── MIME-Type Sniffing Protection ─────────────────────────────────────
        // Prevent browsers from guessing (sniffing) the content type.
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // ── XSS Protection (legacy browsers) ─────────────────────────────────
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // ── Referrer Policy ───────────────────────────────────────────────────
        // Send the full referrer to same-origin; only the origin to cross-origin.
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // ── Permissions Policy ────────────────────────────────────────────────
        // Restrict access to sensitive browser APIs.
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=(), interest-cohort=()'
        );

        // ── Content-Security-Policy ───────────────────────────────────────────
        // Define exactly which sources are allowed for scripts, styles, fonts, etc.
        // This is crafted to allow Bootstrap CDN, Google Fonts, Google Analytics,
        // and Lucide, while blocking everything else by default.
        $csp = implode('; ', [
            "default-src 'self'",

            // Scripts: self + CDNs used in the project
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' " .
                "https://cdn.jsdelivr.net " .
                "https://unpkg.com " .
                "https://www.googletagmanager.com " .
                "https://www.google-analytics.com " .
                "https://pagead2.googlesyndication.com " .
                "https://partner.googleadservices.com",

            // Styles: self + CDN
            "style-src 'self' 'unsafe-inline' " .
                "https://cdn.jsdelivr.net " .
                "https://fonts.googleapis.com",

            // Fonts
            "font-src 'self' " .
                "https://fonts.gstatic.com " .
                "https://cdn.jsdelivr.net",

            // Images: self + data URIs + CDNs used in portfolio / blog
            "img-src 'self' data: blob: " .
                "https://ui-avatars.com " .
                "https://images.unsplash.com " .
                "https://www.google-analytics.com " .
                "https://pagead2.googlesyndication.com " .
                "https://storage.googleapis.com " .
                "https://*.supabase.co",

            // Frames: same origin only (Filament admin panel)
            "frame-src 'self'",

            // Connect: analytics / API calls
            "connect-src 'self' " .
                "https://www.google-analytics.com " .
                "https://analytics.google.com " .
                "https://pagead2.googlesyndication.com",

            // Media
            "media-src 'self'",

            // Objects (Flash etc.)
            "object-src 'none'",

            // Upgrade insecure requests to HTTPS automatically
            "upgrade-insecure-requests",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
