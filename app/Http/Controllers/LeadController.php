<?php

namespace App\Http\Controllers;
use App\Models\Lead;
use Illuminate\Http\Request;
class LeadController extends Controller
{
    public function index(Request $request)
{
    // $query = Lead::where('user_id', auth()->id());
    $query = Lead::query();

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

    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    $leads = $query->latest()->paginate(10);


    return view('leads.index', compact('leads'));
}


    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'note' => 'nullable|string',
        ]);

        Lead::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note' => $request->note,
            'status' => 'New',
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully!');
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'note' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $lead->update($request->only('name', 'email', 'phone', 'note', 'status'));

        return redirect()->route('leads.index')->with('success', 'Lead updated!');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted.');
    }

}
