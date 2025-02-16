<div>
    <h1 class="text-2xl font-bold mb-4">Update Lead Status and Send Email</h1>

    <!-- Lead Selection -->
    <div class="mb-4">
        <label for="leadId" class="block text-sm font-medium text-gray-700">Select Lead</label>
        <select id="leadId" wire:model="leadId" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            <option value="">Select a Lead</option>
            @foreach ($leads as $lead)
                <option value="{{ $lead->id }}">{{ $lead->name }} ({{ $lead->email }})</option>
            @endforeach
        </select>
    </div>

    <!-- Sales Stage Selection -->
    @if ($leadId)
        <div class="mb-4">
            <label for="selectedStage" class="block text-sm font-medium text-gray-700">Select Sales Stage</label>
            <select id="selectedStage" wire:model="selectedStage" wire:change="updateStage($event.target.value)"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Select a Sales Stage</option>
                @foreach ($salesStages as $stage)
                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <!-- Email Preview -->
    @if ($templateContent)
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Email Preview</h2>
            <div class="p-4 border border-gray-300 rounded-md">
                {!! $templateContent !!}
            </div>
        </div>

        <!-- Approve and Send Button -->
        <button wire:click="sendEmail" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            Approve & Send Email
        </button>
    @endif

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>
