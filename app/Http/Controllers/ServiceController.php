<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Show list of all services
    public function index()
    {
        // Get all services from the database
        $services = Service::all();

        // Return the view with the services data
        return view('admin.service.index', compact('services'));
    }

    // Show form to create a new service
    public function create()
    {
        return view('admin.service.create');
    }

    // Store a new service
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name_service' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the icon
        ]);

        // Store the icon in the internal storage and get the file path
        $iconPath = $request->file('icon')->store('services', 'local'); // Store in internal storage

        // Create a new service entry in the database
        Service::create([
            'name_service' => $request->name_service,
            'description' => $request->description,
            'icon' => $iconPath,  // Store the path of the icon
        ]);

        // Redirect to the index route
        return redirect()->route('admin.service.index');
    }

    public function update(Request $request, Service $service)
    {
        // Validate the request data
        $request->validate([
            'name_service' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the icon
        ]);

        // If a new icon is uploaded, store it and get the path
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('services', 'local'); // Store in internal storage
            $service->icon = $iconPath; // Update the icon path in the database
        }

        // Update the service in the database
        $service->update([
            'name_service' => $request->name_service,
            'description' => $request->description,
        ]);

        // Redirect to the index route
        return redirect()->route('admin.service.index');
    }

    // Show form to edit an existing service
    public function edit($id)
    {
        // Fetch the service to be edited
        $service = Service::findOrFail($id);

        // Return the edit view with the service data
        return view('admin.service.edit', compact('service'));
    }




    // Update an existing service

    // Delete a service
    public function destroy($id)
{
    // Find the service by ID
    $service = Service::findOrFail($id);

    // Delete the service
    $service->delete();

    // Redirect back with a success message
    return redirect()->route('admin.service.index')->with('message', 'Service deleted successfully');
}
public function show($id)
    {
        // Find the service by ID
        $service = Service::findOrFail($id);

        // Return a view with the service data
        return view('admin.service.show', compact('service'));
    }

}
