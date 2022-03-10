<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Building;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Staff;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;
use \Response\json;

use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Administrator']);
    }
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::count();
        $item = Item::count();
        $supplier = Supplier::count();
        $department = Department::count();
        $building = Building::count();
        $my_pr = PurchaseRequest::where('user_id','=',$id)->count();
        return view('admin.dashboard',compact('user','item','my_pr','supplier','building','department'));
    }
    public function account()
    {
        $users = User::orderby('id', 'desc')->paginate(10);
        $roles = Role::all();
        return view('admin.manage_account.account', compact('users'), compact('roles'));
    }
    public function addAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $users = new User;

            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->password = Hash::make($request['password']);
            $users->save();
            $users->attachRole($request->role_id);
            return response()->json([
                'success' => 'account added successfully'
            ]);
        }
    }
    public function deleteAccount($id)
    {
        $users = User::find($id);
        $users->delete();
        return response()->json([
            'success' => 'account deleted successfully'
        ]);
    }
    public function getUserById($id)
    {
        $users = User::findOrFail($id);
        return response()->json($users);
    }
    public function updateAccount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'role_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $users = User::find($id);
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            //$users->password =Hash::make($request['upassword']);
            if (!empty($request->urole_id)) {
                $users->roles()->sync($request->urole_id);
            }
            if (!empty($request->newpassword)) {
                $users->password = Hash::make($request['newpassword']);
            } else {
            }
            $users->save();
            return response()->json([
                'success' => 'account updated successfully'
            ]);
        }
    }
    public function facility()
    {
        $building = Building::all();
        $department = Department::all();
        return view('manage_facility.facility', compact('department', 'building'));
    }
    public function adddepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:departments',
            'dept_name' => 'required|max:255',
            'build_id' => 'required|max:255',
        ]);
        if ($validator->fails())
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        else {
            $department = new Department;
            $department->id = $request->input('id');
            $department->Dept_name = $request->input('dept_name');
            $department->building_id = $request->input('build_id');

            $department->save();
            return response()->json([
                'success' => 'department added successfully'
            ]);
        }
    }
    public function addbuilding(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'build_name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $building = new Building;
            $building->Building_name = $request->input('build_name');
            $building->Address = $request->input('address');

            $building->save();
            return response()->json([
                'success' => 'building added successfully',

            ]);
        }
    }
    public function updatebuilding(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'build_edit_name' => ['required', 'string', 'max:255'],
            'build_edit_add' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails())
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        else {
            $building = Building::find($id);
            $building->Building_name = $request->input('build_edit_name');
            //$department->id->sync($request->dept_edit_id);
            $building->Address = $request->input('build_edit_add');

            $building->save();
            return response()->json([
                'success' => 'building updated successfully'
            ]);
        }
    }
    public function updatedepartment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dept_edit_name' => ['required', 'string', 'max:255'],
            'dept_no' => ['required', 'string', 'max:255'],
            // 'build_id' => ['required'],
        ]);
        if ($validator->fails())
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        else {
            $department = Department::find($id);
            $department->id = $request->input('dept_no');
            //$department->id->sync($request->dept_edit_id);
            $department->Dept_name = $request->input('dept_edit_name');
            if (!empty($request->build_id)) {
                $department->building_id = $request->input('build_id');
            }

            $department->save();
            return response()->json([
                'success' => 'department updated successfully'
            ]);
        }
    }

    public function deletedepartment($id)
    {
        $department = Department::find($id);
        $department->delete();
        return response()->json([
            'success' => 'department deleted successfully'
        ]);
    }
    public function deletebuilding($id)
    {
        $department = Building::find($id);
        $department->delete();
        return response()->json([
            'success' => 'department deleted successfully'
        ]);
    }
    public function supplier_items()
    {
        $supplier = Supplier::all();
        $item = Item::all();
        return view('manage_supplier_items.supplier_items', compact('item', 'supplier'));
    }
    public function addsupplier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|max:255',
            'contact_person' => 'required|max:255',
            'contact_no' => 'required|max:255',
            'email' => 'required|max:255',
            'business_add' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $supplier = new Supplier;
            $supplier->business_name = $request->input('business_name');
            $supplier->contact_person = $request->input('contact_person');
            $supplier->contact_no = $request->input('contact_no');
            $supplier->email = $request->input('email');
            $supplier->business_add = $request->input('business_add');

            $supplier->save();
            return response()->json([
                'success' => 'building added successfully'
            ]);
        }
    }
    public function additem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_desc' => 'required|max:255',
            'brand' => 'required|max:255',
            'unit' => 'required|max:255',
            'price' => 'required|max:255',
            'supplier_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $supplier = new Item;
            $supplier->item_desc = $request->input('item_desc');
            $supplier->brand = $request->input('brand');
            $supplier->unit = $request->input('unit');
            $supplier->price = $request->input('price');
            $supplier->supplier_id = $request->input('supplier_id');

            $supplier->save();
            return response()->json([
                'success' => 'item added successfully'
            ]);
        }
    }
    public function updatesupplier(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'up_business_name' => 'required|max:255',
            'up_contact_person' => 'required|max:255',
            'up_contact_no' => 'required|max:255',
            'up_email' => 'required|max:255',
            'up_business_add' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $supplier = Supplier::find($id);
            $supplier->business_name = $request->input('up_business_name');
            $supplier->contact_person = $request->input('up_contact_person');
            $supplier->contact_no = $request->input('up_contact_no');
            $supplier->email = $request->input('up_email');
            $supplier->business_add = $request->input('up_business_add');

            $supplier->save();
            return response()->json([
                'success' => 'supplier updated successfully'
            ]);
        }
    }
    public function updateitem(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'up_item_desc' => 'required|max:255',
            'up_brand' => 'required|max:255',
            'up_unit' => 'required|max:255',
            'up_price' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $item = Item::find($id);
            $item->item_desc = $request->input('up_item_desc');
            $item->brand = $request->input('up_brand');
            $item->unit = $request->input('up_unit');
            $item->price = $request->input('up_price');
            if (!empty($request->supplier_id)) {
                $item->supplier_id = $request->input('up_supplier_id');;
            }

            $item->save();
            return response()->json([
                'success' => 'item updated successfully'
            ]);
        }
    }
    public function deletesupplier($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return response()->json([
            'success' => 'supplier deleted successfully'
        ]);
    }
    public function deleteitem($id)
    {
        $item = Item::find($id);
        $item->delete();
        return response()->json([
            'success' => 'item deleted successfully'
        ]);
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
            'email' => 'required|max:255',
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
                $users->email = $request->input('email');
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
            // 'up_position' => 'required|max:255',
            // 'up_department_id' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $users = User::find($id);
            // if (!empty([$request->up_email])) {
            //     $users->email = $request->input('up_email');
            // } else {
            // }
            if (!empty($request->up_password)) {
                $users->password = Hash::make($request['up_password']);
            } else {
            }

            // $staff = Staff::find($id);
            // if (!empty([
            //     $request->up_position,
            //     $request->up_department_id,
            // ])) {
            //     $staff->position = $request->input('up_position');
            //     $staff->department_id = $request->input('up_department_id');
            // } else {
            // }
            $users->save();
            // $staff->save();
            return response()->json([
                'success' => 'account updated successfully'
            ]);
        }
    }
    public function changeProfilePic(Request $request)
    {
        $path = 'user/';
        $file = $request->file('admin-profile_pic');
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
    public function purchase_request()
    {
        $id = Auth::user()->id;
        $user = User::join('staff', 'users.id', '=', 'staff.user_id')
            ->join('departments', 'staff.department_id', '=', 'departments.id')
            ->join('buildings', 'departments.building_id', '=', 'buildings.id')
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
                'departments.id',
                'buildings.Building_name',
                'buildings.id'
            )
            ->where('staff.id', '=', $id)
            ->first();
        $userr = User::join('staff', 'users.id', '=', 'staff.user_id')
            ->join('departments', 'staff.department_id', '=', 'departments.id')
            ->select(
                'departments.Dept_name',
                'departments.id',
            )
            ->where('staff.id', '=', $id)
            ->first();
        $rand = rand(10, 10000);
        $generatePR = 'PR-' . date("Y-md") . '-' . $rand;

        $purchaserequest = PurchaseRequest::where('user_id', '=', $id)->get();

        return view('manage_purchase_request.purchase_request', compact('generatePR', 'user', 'userr','purchaserequest'));
    }
    public function addrequisition(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'type_of_req' => 'required|max:255',
            'purpose' => 'required|max:255',
            'beggining' => 'required|max:255',
            'ending' => 'required|max:255',
            'quantity' => 'required|max:255',
            'unit' => 'required|max:255',
            'item_desc' => 'required|max:255',
            'pr_no' => 'unique:purchase_requests'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            // $pr_item = new PurchaseRequestItem;
            $pr_no = $request->input('pr_no');
            // $purpose = $request->input('purpose');
            $beggining = $request->input('beggining');
            $ending = $request->input('ending');
            $quantity = $request->input('quantity');
            $unit = $request->input('unit');
            $item_desc = $request->input('item_desc');
            for ($i = 0; $i < count($item_desc); $i++) {
                $datasave = [
                    'pr_no' => $pr_no,
                    'item_desc' => $item_desc[$i],
                    'beggining' => $beggining[$i],
                    'ending' => $ending[$i],
                    'quantity' => $quantity[$i],
                    'unit' => $unit[$i],
                ];
                // $pr_item-> save($datasave);
                DB::table('purchase_request_items')->insert($datasave);
            }
            $requisition = new PurchaseRequest;
            $requisition->pr_no = $request->input('pr_no');
            $requisition->type = $request->input('type_of_req');
            $requisition->purpose = $request->input('purpose');
            $requisition->remarks = 'for approval';
            $requisition->department_id = $request->input('department');
            $requisition->user_id = Auth::user()->id;
            $requisition->save();

            return response()->json([
                'success' => 'Requisition added successfully'
            ]);
        }
    }
    public function view_purchase_request($pr_no)
    {
        $pr_info = PurchaseRequestItem::where('pr_no', '=', $pr_no)->get()->toArray();
        $output = [];
        foreach ($pr_info as $data) {
            $output[] = $data;
        }
        dd($output);
        return view('manage_purchase_request.view_purchase_request',compact('output'));
    }
}
