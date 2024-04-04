<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorCommission;

class VendorCommissionController extends Controller
{
    public function AllVendorCommission()
    {
        $vendorCommission = VendorCommission::latest()->get();
        return view('backend.vendorCommission.vendorCommission_all', compact('vendorCommission'));
    } // End Method

    public function AddVendorCommission()
    {
        return view('backend.vendorCommission.vendorCommission_add');
    } // End Method

    public function StoreVendorCommission(Request $request)
    {
        VendorCommission::insert([
            'percentage' => $request->percentage,
        ]);

        $notification = [
            'message' => 'Vendor Commission Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.vendorCommission')
            ->with($notification);
    } // End Method

    public function EditVendorCommission($id)
    {
        $vendorCommission = VendorCommission::findOrFail($id);
        return view('backend.vendorCommission.vendorCommission_edit', compact('vendorCommission'));
    } // End Method

    public function UpdateVendorCommission(Request $request)
    {
        $vendorCommission_id = $request->id;

        VendorCommission::findOrFail($vendorCommission_id)->update([
            'percentage' => $request->percentage,
        ]);

        $notification = [
            'message' => 'Vendor Commission Update Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('all.vendorCommission')
            ->with($notification);
    } // End Method

    public function DeleteSlider($id)
    {
        VendorCommission::findOrFail($id)->delete();

        $notification = [
            'message' => 'Vendor Commission Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // End Method
}
