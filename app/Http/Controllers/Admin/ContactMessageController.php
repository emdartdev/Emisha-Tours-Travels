<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactMessage::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%")
                  ->orWhere('service', 'like', "%{$term}%")
                  ->orWhere('message', 'like', "%{$term}%");
            });
        }

        $messages = $query->latest()->paginate(15)->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function markRead(int $id): RedirectResponse
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->update(['status' => 'read']);

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function markReplied(int $id): RedirectResponse
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->update(['status' => 'replied']);

        return redirect()->back()->with('success', 'Message marked as replied.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
