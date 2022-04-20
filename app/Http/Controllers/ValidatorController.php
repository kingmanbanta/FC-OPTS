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
use App\Models\PurchaseRequest;
use App\Models\Canvass;
use App\Models\CanvassItem;
use App\Models\PurchaseRequestItem;
use App\Models\PurchaseRequestHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ValidatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Validator']);
    }
    public function index()
    {
        $id = Auth::user()->id;
        $item = Item::count();
        $supplier = Supplier::count();
        $pr = PurchaseRequest::count();
        $my_pr = PurchaseRequest::where('user_id','=',$id)->count();
        return view('validator.dashboard',compact('item','supplier','pr','my_pr'));
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
        $file = $request->file('validator-profile_pic');
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

        $purchaserequest = PurchaseRequest::join('purchase_request_histories', 'purchase_requests.pr_no', '=', 'purchase_request_histories.pr_no')
            ->select('*')
            ->where('user_id', '=', $id)->get();
        // $item='';
        $get_item = DB::select('SELECT * FROM items ORDER BY item_desc asc');
        // foreach($get_item as $row){
        //     $item .= '<option value="'.$row["item_desc"].'">'.$row["item_desc"].'</option>';
        // }
        // dd($get_item);


        return view('manage_purchase_request.purchase_request', compact('generatePR', 'user', 'userr', 'purchaserequest' , 'get_item'));
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
            $requisition->remarks = 'pending';
            $requisition->department_id = $request->input('department');
            $requisition->user_id = Auth::user()->id;
            $prh = new PurchaseRequestHistory;
            $prh->pr_no = $request->input('pr_no');
            $prh->action = 'New Purchase Request';
            $canvass = new Canvass;
            $canvass->pr_no = $request->input('pr_no');
            $requisition->save();
            $prh->save();
            $canvass->save();

            return response()->json([
                'success' => 'Requisition added successfully'
            ]);
        }
    }
    public function view_purchase_request($pr_no)
    {
        $pr_info = PurchaseRequest::join('purchase_request_items', 'purchase_requests.pr_no', '=', 'purchase_request_items.pr_no')
            ->join('departments', 'purchase_requests.department_id', '=', 'departments.id')
            ->join('buildings', 'departments.building_id', '=', 'buildings.id')
            ->join('purchase_request_histories', 'purchase_requests.pr_no', '=', 'purchase_request_histories.pr_no')
            ->select('*')
            ->where('purchase_requests.pr_no', '=', $pr_no)->get()->toArray();
        $pr_infos = PurchaseRequest::where('purchase_requests.pr_no', '=', $pr_no)->get()->toArray();
        $output = [];
        foreach ($pr_info as $data) {
            $output[] = $data;
        }
        $outputs = [];
        foreach ($pr_infos as $dataa) {
            $outputs[] = $dataa;
        }
        // dd($outputs);
        // return view('manage_purchase_request.view_purchase_request',['output'=>$output]);
        return view('manage_purchase_request.view_purchase_requesttt', ['output' => $output, 'outputs' => $outputs]);
    }
    public function pr_check_fund()
    {
        $pr = PurchaseRequest::join('purchase_request_histories', 'purchase_requests.pr_no', '=', 'purchase_request_histories.pr_no')
            ->select('*')
            ->where('purchase_request_histories.action', '=', 'Verified')->get();
        $checked_pr = PurchaseRequest::join('purchase_request_histories', 'purchase_requests.pr_no', '=', 'purchase_request_histories.pr_no')
            ->select('*')
            ->where('purchase_request_histories.action', '=', 'Checked')
            ->get();
        return view('manage_purchase_request.pr_check_fund', compact('pr','checked_pr'));
    }
    public function view_pr_check_fund($pr_no)
    {
        $pr_info = PurchaseRequest::join('purchase_request_items', 'purchase_requests.pr_no', '=', 'purchase_request_items.pr_no')
            ->join('departments', 'purchase_requests.department_id', '=', 'departments.id')
            ->join('buildings', 'departments.building_id', '=', 'buildings.id')
            ->join('purchase_request_histories', 'purchase_requests.pr_no', '=', 'purchase_request_histories.pr_no')
            ->select('*')
            ->where('purchase_requests.pr_no', '=', $pr_no)->get()->toArray();
        $output = [];
        foreach ($pr_info as $data) {
            $output[] = $data;
        }
        $pr_infos = PurchaseRequest::where('purchase_requests.pr_no', '=', $pr_no)->get()->toArray();
        $outputs = [];
        foreach ($pr_infos as $dataa) {
            $outputs[] = $dataa;
        }
        $pr_infoss = PurchaseRequest::join('purchase_request_items','purchase_requests.pr_no', '=','purchase_request_items.pr_no')
            ->join('canvasses', 'purchase_requests.pr_no', '=', 'canvasses.pr_no')
            ->join('canvass_items', 'canvasses.canvass_no', '=', 'canvass_items.canvass_no')
            // ->join('purchase_request_items','canvass_items.item_id', '=','purchase_request_items.item_id')
            ->join('items', 'canvass_items.item_id', '=', 'items.id')
            ->join('suppliers', 'items.supplier_id', '=', 'suppliers.id')
            ->select(
                // 'canvass_items.id',
                // 'canvass_items.canvass_no',
                'items.item_desc',
                'items.brand',
                'items.unit',
                'items.price',
                'purchase_request_items.quantity',
                // 'purchase_request_items.item_desc',
                'suppliers.business_name',
            )
            ->where('purchase_requests.pr_no', '=', $pr_no)
            ->where('canvass_items.selected', '=', '1')
            // ->groupBy('items.item_desc',
            //     'items.brand',
            //     'items.unit',
            //     'items.price',
            //     'purchase_request_items.quantity',
            //     'suppliers.business_name'
            //     )
            ->get()->toArray();

        $canvassed_item = [];
        foreach ($pr_infoss as $dataaa) {
            $canvassed_item[] = $dataaa;
        }
        // dd($canvassed_item);
        // return view('manage_purchase_request.view_purchase_request',['output'=>$output]);
        return view('manage_purchase_request.view_pr_check_fund', ['output' => $output, 'outputs' => $outputs, 'canvassed_item' => $canvassed_item]);
    }
}
