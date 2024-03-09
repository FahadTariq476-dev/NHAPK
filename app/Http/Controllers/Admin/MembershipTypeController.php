<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MembershipTypeController extends Controller
{
    /**
     * Category Page
     */
    protected function index()
    {
        return view('admin.MembershipType.index');
    }
    /**
     * Category List
     */
    protected function getListData(Request $request)
    {
        if ($request->ajax()) {
            $data = MembershipType::latest()->get();
            $formattedData = [];
            foreach ($data as $item) {
                $action = '<div class="btn-group">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                <li> <span data-id="' . $item->id . '" class="editItem text-info dropdown-item"><a>Edit</a></span> </li>
                <li><span data-id="' . $item->id . '" class="deleteItem text-danger dropdown-item"><a>Delete</a></span></li>
                </ul></div>';
                $status = $item->status == 1 ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Inactive</span';
                $formattedData[] = [
                    $item->id,
                    $item->name,
                    $item->description,
                    $status,
                    $action
                ];
            }
            return DataTables::of($formattedData)
                ->escapeColumns([]) // Specify the index of the action column that contains raw HTML
                ->make(true);
        }
    }
    /**
     * Category Modal
     */
    protected function getRowDetail(Request $request)
    {
        $update_id = $request->update_id;
        if (isset($update_id) && !empty($update_id)) {
            $data['membershiptype'] = MembershipType::find($update_id);
            $data['text'] = "Edit Membership Type";
        } else {
            $data['text'] = "Add Membership Type";
        }
        return view("Admin.MembershipType.modal", $data);
    }
    /**
     * Save Category
     */
    protected function save(Request $request)
    {
        $MembershipType = MembershipType::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->has('status') ? '1' : '0',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        if ($MembershipType) {
            return response()->json(['success' => true, 'message' => 'Membership  Type  saved successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Membership  Type  not saved']);
        }
    }
    /**
     * Delete Facility
     */
    protected function delete(Request $request)
    {
        MembershipType::find($request->id)->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
