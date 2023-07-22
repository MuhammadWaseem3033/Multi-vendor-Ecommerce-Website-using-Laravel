<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function sections()
    {
        $sections = Section::get()->toArray();
        // dd($sections);     
        $title = 'Sections';
        return view('admin.sections.sections')->with(compact('sections', 'title'));
    }
    public function sectionUpdateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // reverse the status 
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id', $data['admin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);
        }
    }
    public function editSection(Request $request, $id = null)
    {
        if ($id=="") {
            $title = "Add Sections";
            $section = new Section;
            $massage = "Add new Section Successfully";
        } else {
            $title = "Edit Sections";
            $section = Section::find($id);
            $massage = "Update Section Successfully";
        }
        // dd($section);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customValidate = [
                'section_name.required' => 'Name is Required ',
            ];
            $this->validate($request, $rules, $customValidate);
            $section->name = $data['section_name'];
            $section->status = 1 ;
            $section->save();

            return redirect('admin/sections')->with('massage',"Your are successfully Adding the New Row");
        }
        // dd($section);
        return view('admin.sections.add-edit-section')->with(compact('title', 'massage', 'section'));
    }
    public function destroySection(Request $request, $id)
    {
        Section::where('id', $id)->delete();
        $massage = "Delete The Massage SuccessFully";
        return redirect()->back()->with('success_massage', $massage);
    }
}
