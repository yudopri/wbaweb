<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PartnerController extends Controller
{
    public function index()
    {
        // Get all services from the database
        $partners = Partner::all();

        // Return the view with the services data
        return view('admin.partner.index', compact('partners'));
    }

    // Show form to create a new service
    public function create()
    {
        return view('admin.partner.create');
    }

    // Store a new service
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name_partner' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the icon
        ]);

        // Store the icon in the internal storage and get the file path
        $iconPath = $request->file('icon')->store('partner', 'local'); // Store in internal storage

        // Create a new service entry in the database
        Partner::create([
            'name_partner' => $request->name_partner,
            'icon' => $iconPath,  // Store the path of the icon
        ]);

        // Redirect to the index route
        return redirect()->route('admin.partner.index');
    }

    public function update(Request $request, Partner $partner)
    {
        // Validate the request data
        $request->validate([
            'name_partner' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the icon
        ]);

        // If a new icon is uploaded, store it and get the path
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('partner', 'local'); // Store in internal storage
            $partner->icon = $iconPath; // Update the icon path in the database
        }

        // Update the service in the database
        $partner->update([
            'name_partner' => $request->name_partner,
        ]);

        // Redirect to the index route
        return redirect()->route('admin.partner.index');
    }

    // Show form to edit an existing service
    public function edit($id)
    {
        // Fetch the service to be edited
        $partner = Partner::findOrFail($id);

        // Return the edit view with the service data
        return view('admin.partner.edit', compact('partner'));
    }




    // Update an existing service

    // Delete a service
    public function destroy($id)
{
    // Find the service by ID
    $partner = Partner::findOrFail($id);

    // Delete the service
    $partner->delete();

    // Redirect back with a success message
    return redirect()->route('admin.partner.index')->with('message', 'Partner deleted successfully');
}
public function show($id)
    {
        // Find the service by ID
        $partner = Partner::findOrFail($id);

        // Return a view with the service data
        return view('admin.partner.show', compact('partner'));
    }
}
