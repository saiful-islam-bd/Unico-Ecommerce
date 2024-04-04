<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        $product = $request->product_id;
        $vendor = $request->hvendor_id;

        $request->validate([
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Review Will Approve By Admin',
            'alert-type' => 'success',
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // End Method

    public function PendingReview()
    {
        $review = Review::where('status', 0)
            ->orderBy('id', 'DESC')
            ->get();
        return view('backend.review.pending_review', compact('review'));
    } // End Method

    public function ReviewApprove($id)
    {
        Review::where('id', $id)->update(['status' => 1]);

        $notification = [
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // End Method

    public function PublishReview()
    {
        $review = Review::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();
        return view('backend.review.publish_review', compact('review'));
    } // End Method

    public function ReviewDelete($id)
    {
        Review::findOrFail($id)->delete();

        $notification = [
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // End Method

    public function VendorAllReview()
    {
        $id = Auth::user()->id;

        $review = Review::where('vendor_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();
        return view('vendor.backend.review.approve_review', compact('review'));
    } // End Method
}
