<div style='background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; font-family: Arial, sans-serif; max-width: 100%; box-shadow: 0 1px 3px rgba(0,0,0,0.05); text-align: left;'>
    <div style='font-size: 12px; color: #202124; margin-bottom: 4px; display: flex; align-items: center; gap: 4px; line-height: 1.2;'>
        <span>waverontechnologies.co.ke</span>
        <span style='color: #5f6368;'>&rsaquo; blog &rsaquo; {{ $get('slug') ?? 'slug-path' }}</span>
    </div>
    <div style='font-size: 18px; color: #1a0dab; line-height: 1.3; font-weight: normal; margin-bottom: 4px; font-family: Arial, sans-serif; word-wrap: break-word;'>
        {{ $get('title') ?? 'Enter Title...' }}
    </div>
    <div style='font-size: 13px; color: #4d5156; line-height: 1.58; font-family: Arial, sans-serif; word-wrap: break-word;'>
        <span style='color: #70757a;'>{{ now()->format('M d, Y') }} &mdash; </span>{{ $get('excerpt') ?? 'Enter a short summary of the blog post to preview search engine representation...' }}
    </div>
</div>
