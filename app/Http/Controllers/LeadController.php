<?php

namespace App\Http\Controllers;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::where('user_id', auth()->id())->latest()->get();
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
