<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendingPrescription;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    public function index()
    {
        return view('prescription.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_location' => 'required|string',
            'prescription_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        // Handle file upload
        if ($request->hasFile('prescription_image')) {
            $image = $request->file('prescription_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Images/prescriptions'), $imageName);
            
            $prescription = PendingPrescription::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_location' => $request->customer_location,
                'prescription_image' => 'Images/prescriptions/' . $imageName,
                'status' => 'pending',
            ]);

            return redirect()->back()->with('success', 'Prescription uploaded successfully! Please contact us for further assistance.');
        }

        return redirect()->back()->with('error', 'Failed to upload prescription. Please try again.');
    }
}
