<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Building;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApproverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Approver']);
    }
    public function index()
    {
        return view('approver.dashboard');
    }
    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('roles.display_name', 'roles.id')
            ->where('users.id', '=', $id)
            ->first();
        $userr = User::join('staff', 'users.id', '=', 'staff.user_id')
            ->join('departments', 'staff.department_id', '=', 'departments.id')
            ->select(
                'staff.id',
                'staff.fname',
                'staff.mname',
                'staff.lname',
                'staff.sex',
                'staff.barangay',
                'staff.municipality',
                'staff.city',
                'staff.province',
                'staff.zipcode',
                'staff.position',
                'staff.contact_no',
                'departments.Dept_name',
                'departments.id'
            )
            ->where('staff.id', '=', $id)
            ->first();
        $department = Department::all();
        return view('manage_profile.profile', compact('department', 'user', 'userr'));
    }
    public function updateprofile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'up_fname' => 'required|max:255',
            'up_mname' => 'required|max:255',
            'up_lname' => 'required|max:255',
            'up_sex' => 'required|max:255',
            'up_contact_no' => 'required|max:255',
            'up_barangay' => 'required|max:255',
            'up_city' => 'required|max:255',
            'up_municipality' => 'required|max:255',
            'up_province' => 'required|max:255',
            'up_zipcode' => 'required|max:255',
            'up_position' => 'required|max:255',
            'up_department_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $users = User::find($id);
            if (!empty([$request->up_fname, $request->up_email])) {
                $users->name = $request->input('up_fname');
                $users->email = $request->input('up_email');
            } else {
            }
            $staff = Staff::find($id);
            if ($staff === null) {
                $staff = new Staff;
                $staff->id = $request->input('profile_id');
            } else {
            }
            if (!empty([
                $request->up_fname,
                $request->up_mname,
                $request->up_lname,
                $request->up_sex,
                $request->up_contact_no,
                // $request->up_email,
                $request->up_barangay,
                $request->up_municipality,
                $request->up_city,
                $request->up_province,
                $request->up_zipcode,
                $request->up_position,
                $request->up_department_id,
            ])) {
                $staff->fname = $request->input('up_fname');
                $staff->mname = $request->input('up_mname');
                $staff->lname = $request->input('up_lname');
                $staff->sex = $request->input('up_sex');
                // $staff->email = $request->input('email');
                $staff->contact_no = $request->input('up_contact_no');
                $staff->barangay = $request->input('up_barangay');
                $staff->municipality = $request->input('up_municipality');
                $staff->city = $request->input('up_city');
                $staff->province = $request->input('up_province');
                $staff->position = $request->input('up_position');
                $staff->zipcode = $request->input('up_zipcode');
                $staff->department_id = $request->input('up_department_id');
                $staff->user_id = $request->input('profile_id');
            } else {
            }
            //$users->password =Hash::make($request['upassword']);
            $staff->save();
            $users->save();
            return response()->json([
                'success' => 'staff updated successfully'
            ]);
        }
    }
    public function updatepasword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'old_password'=>[
            //     'required', function($attribute, $value, $fail){
            //         if( !Hash::check($value, Auth::user()->password) ){
            //             return $fail(__('The current password is incorrect'));
            //         }
            //     },
            //     'min:8',
            //     'max:30'
            //  ],
            'up_password' => 'required|min:8',
            'up_confirm_password' => 'required|min:8|same:up_password',
            'up_position' => 'required|max:255',
            'up_department_id' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $users = User::find($id);
            if (!empty([$request->up_email])) {
                $users->email = $request->input('up_email');
            } else {
            }
            if (empty($request->up_password)) {
                # code...
            } else {
                $users->password = Hash::make($request['up_password']);
            }




            $staff = Staff::find($id);
            if (!empty([
                $request->up_position,
                $request->up_department_id,
            ])) {
                $staff->position = $request->input('up_position');
                $staff->department_id = $request->input('up_department_id');
            } else {
            }
            $users->save();
            $staff->save();
            return response()->json([
                'success' => 'account updated successfully'
            ]);
        }
    }
    public function changeProfilePic(Request $request)
    {
        $path = 'user/';
        $file = $request->file('approver-profile_pic');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'something went wrong, upload new picture failed']);
        } else {
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];
            if ($oldPicture != '') {
                if (\file_exists(public_path($path . $oldPicture))) {
                    \unlink(public_path($path . $oldPicture));
                }
            }

            $update = User::find(Auth::user()->id)->update(['picture' => $new_name]);
            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'something went wrong,updating picture in db failed']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'your profile picture have been updated succesfully']);
            }
        }
    }
}
