<div class="space-y-4">
    <img src="{{ Storage::url($record->thumbnail) }}" alt="Thumbnail" class="w-full rounded-md">
    <div class="text-lg font-bold">{{ $record->title }}</div>
    <div class="prose max-w-none">
        {!! $record->content !!}
    </div>
</div>
