<?php


namespace App\Http\Controllers;

use App\UserInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class userController extends Controller
{

    public function getUserInfo($id = 4) {

        //查询
        $user = DB::select('select * from user');
        dd($user);

        //新增
        $bool = DB::insert('insert into user (name,password,state,create_id,create_time) VALUES (?, ?, ?, ?, ?)',
                            ['liuyuzhe', '123456', 1, 1, date('Y-m-d H:i:s')]);
        dd($bool);

        //修改
        $row = DB::update('update user set password = ? where name = ?',
                            ['liuxiaoshuai.','liuxiaoshuai']);
        dd($row);

        //删除
        $row = DB::delete('delete from user where name = ?',
                            ['liuyuzhe']);
        dd($row);
    }

    // 使用查询构造器添加数据
    public function testInsert() {
        // 查询构造器添加单条记录
        $bool = DB::table("user")->insert([
            'name' => 'liuyuzhe',
            'password' => '123456'
        ]);
        dd($bool);

        // 查询构造器添加单条记录并返回ID
        $id = DB::table("user")->insertGetId([
           'name' => 'lxs',
           'password' => 'lxs'
        ]);
        dd($id);

        // 查询构造器添加多条记录
        $bool = DB::table("user")->insert([
           ['name' => '1', 'password' => '1'],
           ['name' => '2', 'password' => '2']
        ]);
        dd($bool);
    }

    // 使用查询构造器修改数据
    public function testUpdate(){
        // 查询构造器修改记录
        $row = DB::table("user")
            ->where(["name" => "liuxiaoshuai"])
            ->update(["password" => 'newpassword']);
        dd($row);

        // 查询构造器自增 默认自增1
        $row = DB::table("user")
            ->where(["name" => "liuxiaoshuai"])
            ->increment('state', 2);
        dd($row);

        // 查询构造器自减 默认自减1
        $row = DB::table("user")
            ->where(["name" => "liuxiaoshuai"])
            ->decrement('state', 2);
        dd($row);

        // 查询构造器某字段 自增并修改其它字段信息
        $row = DB::table("user")
            ->where(["name" => "liuxiaoshuai"])
            ->increment("state", 2, ['password' => 'liuxiaoshuai.']);
        dd($row);
    }

    // 使用查询构造器删除数据
    public function testDelete(){
        // 查询构造器删除记录
        $row = DB::table("user")
            ->where(['name' => 'liuxiaoshuai'])
            ->delete();
        dd($row);

        // 查询构造器删除记录 使用大于等于条件
        $row = DB::table("user")
            ->where('admin_state', '<=', 0)
            ->delete();
        dd($row);

        // 查询构造器清空表
        DB::table("user")->truncate();
    }

    // 使用查询构造器查询数据
    public function testSelect(){
        // 查询构造器查询所有数据 - get
        $users = DB::table("user")
            ->get();
        dd($users);

        // 查询构造器条件查询数据 - where
        $users = DB::table("user")
            ->where("id", ">=", 1)
            ->get();
        dd($users);

        // 查询构造器多条件查询数据 - whereRaw
        $users = DB::table("user")
            ->whereRaw('id >= ? and name = ?', ['0', 'liuyuzhe'])
            ->get();
        dd($users);

        // 查询构造器查询指定字段 - pluck
        $names = DB::table("user")
            ->pluck("name");
        dd($names);

        // 查询构造器查询指定键作为下标 - lists 5.3以后不支持
        $names = DB::table("user")
            ->lists("name", "id");
        dd($names);

        // 查询构造器查询分批获取数据
        echo "<pre>";
        DB::table("user")->chunk(2, function($users){
            var_dump($users);

            if ( 满足条件 ) {
                return false;
            }
        });
    }

    // 使用查询构造器中的聚合函数
    public function testJh(){
        // 总数
        $count = DB::table("user")
            ->count();
        dd($count);

        // 最大值
        $max = DB::table("user")
            ->max('id');
        dd($max);

        // 最小值
        $min = DB::table("user")
            ->min('id');
        dd($min);

        // 平均数
        $avg = DB::table("user")
            ->avg('id');
        dd($avg);

        // 总和
        $sum = DB::table("user")
            ->sum('id');
        dd($sum);
    }

    //ORM
    public function ormSelect(){
        // all()
        dd(UserInfo::all());
        // find()
        dd(UserInfo::find(1));
        // findOrFail()
        dd(UserInfo::findOrFail(10));
        // get()
        dd(UserInfo::get());
        // chunk()
        UserInfo::chunk(2, function($users){
            dd($users);
        });
        // first()
        $users = UserInfo::where('id','>', 3)
                    ->orderBy('id', 'desc')
                    ->first();
        dd($users);
        // count()
        dd(UserInfo::count());
    }

    public function ormInsert(){
        //使用模型新增数据
        $userInfo = new UserInfo();
        $userInfo->name = 'lxs';
        $userInfo->password = 'lxslxs';
        $userInfo->save();

        //使用模型的create方法新增数据
        $userInfo = UserInfo::create([
           "name" => "test_name",
           "password" => "test_password"
        ]);
        dd($userInfo);

        //使用模型的firstOrCreate()
        $userInfo = UserInfo::firstOrCreate(
          ["name" => "test_name1", "password" => "test_password"]
        );
        dd($userInfo);

        //使用模型的firstOrNew()
        $userInfo = UserInfo::firstOrNew([
            "name" => "test_name11",
            "password" => "test_password"
        ]);
        $userInfo->save();
        dd($userInfo);
    }

    public function ormUpdate(){
        //使用模型更新数据
        $userInfo = UserInfo::find(13);
        $userInfo->name = "new_name";
        $bool = $userInfo->save();
        dd($bool);

        $row = UserInfo::where("id",13)->update(
            ['name' => 'new_name2']
        );
        dd($row);
    }

    public function ormDelete(){
        //使用模型删除数据
        $userInfo = UserInfo::find(13);
        $bool = $userInfo->delete();
        dd($bool);

        //通过主键批量删除
        $row = UserInfo::destroy(11,10);
        $row = UserInfo::destroy([11,10]);
        dd($row);

        //删除指定条件的数据
        $row = UserInfo::where("id", ">", 8)->delete();
        dd($row);
    }

    public function showUser(){
        $name = "liuxiaoshuai";
        $userInfo = UserInfo::get();
        return view("user/user-info",[
            "name" => $name,
            "userInfo" => $userInfo
        ]);
    }

    public function urlTest(){
        dd("urlTest");
    }

    public function request1(Request $request){
        // request 取值
        echo $request->input("name");

        // request 取值，如果值为空则填写默认值
        echo $request->input("sex", "boy");

        // request 取所有值
        var_dump($request->all());

        // request 判断是否存在某个键
        var_dump($request->has("sex"));

        // request 判断请求类型
        echo $request->method();

        // request 判断是否是某个请求类型
        var_dump($request->isMethod("GET"));

        // request 判断是否是ajax
        var_dump($request->ajax());

        // request 获取当前url
        echo $request->url();

        // request 判断当前路由
        var_dump($request->is("userinfo/*"));
    }

    public function session1(Request $request){
        // 存储session的三种方法
        $request->session()->put("name","lxs");
        echo $request->session()->get("name");

        Session()->put("sex","boy");
        echo Session()->get("sex");

        Session::put("key1","value1");
        echo Session::get("key1");

        // 获取所有Session中的值
        dd(Session::all());

        // 获取session中的值，如果不存在则去默认值
        echo Session::get("key2","default");

        // 删除指定session
        Session::forget("name");

        // 批量存储session
        Session::put([
            "key2"=>"value2",
            "key3"=>"value3"
        ]);

        // 给session中的某个值添加数据
        Session::push("keys", "key1");

        // 取出session并删除
        echo Session::pull("name");

        // 判断session是否存在某个键
        var_dump(Session::has("key3"));

        // 清除session中的所有数据
        Session::flush();

        // 暂存数据-只能获取一次
        Session::flash("key-flash", "value-flash");
    }

    public function session2(){
        echo Session::get("key-flash");
    }

    public function response(){
        // array() 转 json
        $data = [
            'errCode' => 0,
            'errMsg' => 'success',
            'data' => 'info'
        ];

        return response($data);

        // 重定向 并携带数据
        return redirect("testRedirect")->with("message", "我是快闪数据");

        return redirect()->action("userController@testRedirect")
            ->with("message", "我是快闪数据");
        return redirect()->route("testRedirect")
            ->with([
                "message" => "我是快闪数据",
                "info" => "info"
            ]);

        // 返回上一个页面
        return redirect()->back();
    }

    public function testRedirect(){
        return Session::get("info","暂无数据啊1111");
    }
}