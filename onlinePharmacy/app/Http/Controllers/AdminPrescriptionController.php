<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendingPrescription;

class AdminPrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = PendingPrescription::query()->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by name or phone
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $prescriptions = $query->paginate(15);

        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function show($id)
    {
        $prescription = PendingPrescription::findOrFail($id);
        return view('admin.prescriptions.show', compact('prescription'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $prescription = PendingPrescription::findOrFail($id);
        $prescription->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.prescriptions.index')
                         ->with('success', 'Prescription status updated successfully!');
    }

    public function destroy($id)
    {
        $prescription = PendingPrescription::findOrFail($id);
        
        // Delete the image file
        if (file_exists(public_path($prescription->prescription_image))) {
            unlink(public_path($prescription->prescription_image));
        }
        
        $prescription->delete();

        return redirect()->route('admin.prescriptions.index')
                         ->with('success', 'Prescription deleted successfully!');
    }
}
