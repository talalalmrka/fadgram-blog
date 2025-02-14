<div class="flex flex-col items-center justify-center">
    <!-- Avatar -->
    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
        x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
        class="group relative w-32 h-32 rounded-full overflow-hidden">

        <div class="w-full h-full rounded-full overflow-hidden">
            <!-- Avatar Image -->
            <img id="avatar" src="{{ $user->getThumbnailUrl() }}" alt="{{ $user->display_name }}"
                class="w-full h-full rounded-full object-cover">
            <!-- Edit Button -->
            <div x-show="!uploading"
                class="hidden group-hover:flex absolute inset-0 items-center justify-center flex-wrap gap-2 bg-black/50 rounded-full">
                <button type="button" x-on:click="$refs.fileInput.click()" class="btn primary pill shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-card-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path
                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </button>
                <button type="button" wire:click="deleteThumbnail" class="btn red pill shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                        <path
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="absolute inset-0 w-full h-full flex items-center justify-center bg-black/50 rounded-full"
            x-show="uploading">
            <x-circular-progress-bar x-data="{ percent: progress }" class="lg light" />
        </div>

        <!-- File Input (Hidden) -->
        <input wire:model.live="thumbnail" id="thumbnail" x-ref="fileInput" type="file" class="hidden">
    </div>

    <x-form.error id="thumbnail" />
    <h3 class="text-2xl mt-4">{{ $user->display_name }}</h3>
    <p class="text-base font-light text-gray-500 dark:text-gray-400">
        {{ $user->email }}
    </p>
</div>
