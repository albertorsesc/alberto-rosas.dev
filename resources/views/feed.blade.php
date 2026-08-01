<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Alberto Rosas</title>
        <link>{{ url('/blog') }}</link>
        <atom:link href="{{ url('/blog/feed') }}" rel="self" type="application/rss+xml" />
        <description>Writing on production AI: agents, retrieval, security and guardrails, evaluation, and the engineering behind real systems.</description>
        <language>en-us</language>
@if ($docs->isNotEmpty())
        <lastBuildDate>{{ $docs->first()->date->toRfc2822String() }}</lastBuildDate>
@endif
@foreach ($docs as $doc)
        <item>
            <title>{{ $doc->title }}</title>
            <link>{{ route('prezet.show', $doc->slug) }}</link>
            <guid isPermaLink="true">{{ route('prezet.show', $doc->slug) }}</guid>
            <pubDate>{{ $doc->date->toRfc2822String() }}</pubDate>
@if ($doc->category)
            <category>{{ $doc->category }}</category>
@endif
            <description>{{ $doc->excerpt }}</description>
        </item>
@endforeach
    </channel>
</rss>
