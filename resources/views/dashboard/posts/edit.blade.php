@php
    $title = !empty($post->id) ? __('Edit post ":name"', ['name' => $post->name]) : __('Create post');
@endphp
<x-dashboard-layout :title="$title">
    <x-slot name="header">
        {{ $title }}
    </x-slot>
    <x-slot name="actions">
        <a class="btn sm blue" href="{{ route('dashboard.posts') }}">{{ __('View all') }}</a>
        @if (!empty($post->id))
            <a class="btn sm green" href="{{ route('dashboard.posts.create') }}">{{ __('Create') }}</a>
        @endif
    </x-slot>
    <div class="container py-5">
        <x-status />
        <form action="{{ !empty($post->id) ? route('dashboard.posts.update', $post) : route('dashboard.posts.store') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="col md:col-span-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="col">
                                    <x-form.input id="name" name="name" :label="__('Name')" :value="old('name', $post->name)" />
                                </div>
                                @if (!empty($post->id))
                                    <div class="col">
                                        <a class="link blue" href="{{ $post->permalink }}" target="_blank">
                                            <svg width="16" height="16" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z">
                                                </path>
                                            </svg>
                                            <span class="truncate">{{ $post->permalink }}</span>
                                        </a>
                                    </div>
                                @endif
                                <div class="col">
                                    <x-form.select-user id="user_id" name="user_id" :label="__('Author')"
                                        :value="old('user_id', $post->user_id)" />
                                </div>
                                <div class="col">
                                    <x-form.input id="slug" name="slug" :label="__('Slug')" :value="old('slug', $post->slug)" />
                                </div>
                                <div class="col">
                                    <x-form.textarea id="description" name="description" rows="2"
                                        :label="__('Description')" :value="old('description', $post->description)" />
                                </div>
                                <div class="col">
                                    <x-form.editor id="content" name="content" rows="7" :label="__('Content')"
                                        :value="old('content', $post->content)" />
                                </div>

                            </div>
                        </div>
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="col">
                                    <x-form.file id="thumbnail" name="thumbnail" :label="__('Featured image')" :value="$post->getThumbnail()"
                                        accept="image/*" />

                                </div>
                                <div class="col">
                                    <x-form.file id="pdf" name="pdf" :label="__('Pdf')" :value="$post->getFirstMedia('pdf')"
                                        accept=".pdf" />

                                </div>
                                <div class="col">
                                    <button type="submit" name="save" class="btn primary gradient w-full">
                                        {{ !empty($post->id) ? __('Update') : __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!-- card -->
                    @dump($post->thumbnails)
                </div><!-- col -->
            </div><!-- grid -->
        </form>
    </div>
</x-dashboard-layout>
