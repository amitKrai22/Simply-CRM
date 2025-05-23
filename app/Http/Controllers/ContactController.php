<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        // $query = Contact::where('user_id', auth()->id());
        $query = Contact::query();

    if (!auth()->user()->isAdmin()) {
        $query->where('user_id', auth()->id());
    }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%$search%")
                ->orWhere('email', 'ILIKE', "%$search%")
                ->orWhere('phone', 'ILIKE', "%$search%");
            });
    }

    $contacts = $query->latest()->paginate(10); // 10 items per page


    return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'note' => 'nullable|string',
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note' => $request->note,
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully!');
    }

    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact); // optional auth check
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'note' => 'nullable|string',
        ]);

        $contact->update($request->only('name', 'email', 'phone', 'note'));

        return redirect()->route('contacts.index')->with('success', 'Contact updated!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted.');
    }
}

