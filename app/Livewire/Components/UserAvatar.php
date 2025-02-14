<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserAvatar extends Component
{
    use WithFileUploads;
    public User $user;
    public $thumbnail;
    public function render(User $user)
    {
        return view('livewire.components.user-avatar');
    }
    public function rules()
    {
        return [
            'thumbnail' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:2048'],
        ];
    }
    public function updatedThumbnail()
    {
        $this->validate();
        $update = $this->user->setThumbnail($this->thumbnail);
        if ($update) {
            session()->flash('thumbnail', __('Avatar updated'));
        } else {
            $this->addError('thumbnail', __('Update avatar failed!'));
        }
    }

    public function deleteThumbnail()
    {
        $delete = $this->user->deleteThumbnail();
        if ($delete) {
            session()->flash('thumbnail', __('Avatar deleted.'));
        } else {
            $this->addError('thumbnail', __('Delete avatar failed!'));
        }
    }
}
