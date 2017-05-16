<?php namespace App\Http\Controllers\API\v1;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Course;


class StudentController extends Controller
{
    public function __construct()
    {

    }

    // 5. 查詢各科成績的學生人數


   /**
    * a. 查詢特定學生
    *
    */
    public function show($id)
    {
        try {
            if (!is_numeric($id)) {
                $result['error'] = "The id must be integer.";
                return response($result, 400);
            }
            $studentArray = DB::table('student')->where('id', $id)->first();
            $result['data'] = $studentArray;
            return response($result);
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            return response($result, 400);
        }
    }

   /**
    * b. 依條件查詢學生
    * @param 
    *
    */
    public function postSearch(Request $request)
    {
        try {
            $input = $request->all();

            $rules = [
                    'id' => 'integer',
                    'name' => 'string',
                    'registerDate' => 'date'
            ];

            $input = $this->arrangeParameter($input, $rules);

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                $result['error'] = $validator->messages()->first();
                return response($result, 400);
            }

            if (count($input) == 0) {
                $studentObj = Student::all();
            } else {
                $studentObj = Student::searchstudent($input)->get();
            }

            $result['data'] = $studentObj->toArray();
            return response($result);

        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            return response($result, 400);
        }

    }

   /**
    * c. 查詢所有學生
    * @param start, limit
    *
    */
    public function index(Request $request)
    {
        try {
            $input = $request->all();

            $rules = [
                'start' => 'required | integer',
                'limit' => 'required | integer'
            ];

            $input = $this->arrangeParameter($input, $rules);

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                $result['error'] = $validator->messages()->first();
                return response($result, 400);
            }

            $studentObj = Student::skip($input['start'] - 1)->take($input['limit'])->get();
            $result['data'] = $studentObj->toArray();
            return response($result);
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            return response($result, 400);
        }
    }

   /**
    * d. 新增一個學生
    * 
    */
    public function postInsertStudent(Request $request)
    {
        try {
            $input = $request->all();

            $rules = [
                'name'         => 'required | max:60',
                'registerDate' => 'required',
                'birthday'     => 'required',
                'remark'       => 'max:100'

            ];

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                $result['error'] = $validator->messages()->first();
                return response($result, 400);
            }

            $studentObj = Student::create($input);
            // to do: url回應需要改善直接回port出來的方式
            $result['data']['uri']          = env('APP_URL', 'http://localhost') . ":80/assignments/api/v1/students/" . $studentObj->id;
            $result['data']['id']           = $studentObj->id;
            $result['data']['name']         = $studentObj->name;
            $result['data']['registerDate'] = $studentObj->registerDate;
            $result['data']['remark']       = $studentObj->remark;

            return response($result);

        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            return response($result, 400);
        }
    }

   /**
    * e. 查詢各科成績人數
    *
    */
    public function getGrades()
    {
        try {
            $gradeObj = Course::select("student_course_grade.gradelevel as level", "course.name as course", DB::raw("count(*) as count"))
                            ->leftJoin("student_course_grade", "course.id", "=", "student_course_grade.courseId")
                            ->groupBy("course.name", "student_course_grade.gradelevel")
                            ->get();

            $result['data']  = $gradeObj->toArray();
            return response($result, 200);
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            return response($result, 400);
        }
    }

   /**
    * 將傳入不需要的參數移除
    *
    */
    private function arrangeParameter($param = array(), $rules = array())
    {
        foreach ($param as $key => $value) {
            if (!array_key_exists($key, $rules)) {
                unset($param[$key]);
            }
        }
        return $param;
    }

}