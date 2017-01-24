<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class studentController extends Controller {

    public function index(){

        $student = Student::paginate(1);

        return view('student/index', [
            'students' => $student,
        ]);
    }

    // 添加页面
    public function create(){
        return view('student/create');
    }

    // 保存添加
    public function save(Request $request){
        $data = $request->input("Student");
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ( $student->save() ) {
        } else {
            $request->back();
        }
    }
}