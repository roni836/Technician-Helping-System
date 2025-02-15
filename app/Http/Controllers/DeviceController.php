<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    /**
     * Display a listing of the devices.
     */
    public function index()
    {
        $devices = Device::all();
        // Since your view is under resources/views/admin/manage_devices.blade.php
        return view('admin.manage_devices', compact('devices'));
    }

    /**
     * Store a newly created device in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_name' => 'required|string|max:255',
        ]);

        Device::create([
            'name' => $request->device_name,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device added successfully.');
    }

    /**
     * Show the form for editing the specified device.
     * (Optional if using modals for editing)
     */
    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('admin.edit_device', compact('device')); // If you have a separate edit view
    }

    /**
     * Update the specified device in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'device_name' => 'required|string|max:255',
        ]);

        $device = Device::findOrFail($id);
        $device->update([
            'name' => $request->device_name,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    /**
     * Remove the specified device from storage.
     */
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
    }
}
