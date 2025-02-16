<div>
    @foreach ($templates as $template)
        <div>
            <h2>{{ $template->salesStage->name }}</h2>
            <div>{!! $template->content !!}</div>
            <button wire:click="previewTemplate({{ $template->id }})">Preview</button>
        </div>
    @endforeach
</div>
