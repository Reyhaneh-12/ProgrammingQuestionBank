<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Problem;
use App\Models\Reply;
use App\Models\Language;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use ZipArchive;
use Symfony\Component\HttpFoundation\File\File;

class ProblemController extends Controller
{
    //Home
    public function home()
    {
        $problems = Problem::orderBy('id', 'desc')->take(12)->get();
        $languages = Language::all();
        $comments = Comment::orderBy('id', 'desc')->take(2)->get();
        return view('home', ['problems' => $problems, 'languages'=> $languages, 'comments'=> $comments ]);
    }

    public function admin_special_home()
    {
        $problems = Problem::orderBy('id', 'desc')->take(12)->get();
        $comments = Comment::orderBy('id', 'desc')->take(2)->get();
        return view('special-home', ['problems' => $problems, 'comments'=> $comments ]);
    }

    //problem details
    public function problem_details(Problem $problem)
    {
        $replies = Reply::where('confirmation_status', 1 )->where('problem_id', $problem->id )->get();
        return view('problems.problem-details', ['replies' => $replies, 'problem'=> $problem ]);
    }

    //problem show
    public function problem_show(Problem $problem)
    {
        if (Storage::disk('public')->exists("files/$problem->file_path")){
            $path = Storage::disk('public')->path("files/$problem->file_path");
            $content = file_get_contents($path);

            ///for view && download
            return response($content)->withHeaders([
                'content-Type' => mime_content_type($path)
            ]);

            ///for download
            //return Storage::disk('public')->download("$pro->file");
        }
        return '404';
        
    }

    //reply show
    public function reply_show(Reply $reply)
    {
        if (Storage::disk('public')->exists("reply-files/$reply->file_path")){
            $path = Storage::disk('public')->path("reply-files/$reply->file_path");
            $content = file_get_contents($path);

            ///for view && download
            return response($content)->withHeaders([
                'content-Type' => mime_content_type($path)
            ]);
        }
        return '404';
        
    }

    //reply add and reply save
    public function reply_save(Request $request, Problem $problem)
    { 
        $request->validate([
            'message' => 'required|string',
            'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

        $file=$request->file('file_path');
        $fileName = time().'.'.$file->extension();  
        Storage::putFileAs('public/reply-files', $file, $fileName);

        $reply=Reply::create([
            'message' => $request->message,
            'file_path' => $fileName,
            'problem_id' => $problem->id,
            'user_id' => Auth::user()->id,
        ]);

        $msg= "پاسخ شما برای طراح ارسال شد.";
        return redirect()->back()->with('success', $msg );
    }

    public function problem_reply_edit(Reply $reply)
    {
        return view('problems.reply-edit', ['reply'=> $reply]);
    }

    public function problem_reply_update(Request $request, Reply $reply)
    {
        if(empty($request->file_path))
        {
            if( $request->message==$reply->message )
            {
                $msg= "تغییرات جدیدی وارد نشده است!";
                return redirect()->back()->with('warning', $msg );
            }
            else
            {
                $request->validate([
                    'message' => 'required|string|max:255',
                ]);
            }
            
        }
        else
        {
            $request->validate([
                'message' => 'required|string|max:255',
                'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);


            //delete old file
            if(Storage::disk('public')->exists("reply-files/$reply->file_path"))
            {
                Storage::disk('public')->delete("reply-files/$reply->file_path");
            }

            //save new file
            $file=$request->file('file_path');
            $fileName = time().'.'.$file->extension();  
            Storage::putFileAs('public/reply-files', $file, $fileName);
            $reply->file_path= $fileName;

        }

        $reply->message = $request->message;
        
        try{
            $reply->save();
        }catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }


        $msg = "ویرایش پاسخ با موفقیت انجام شد." ;
        return redirect(route('profile'))->with('success', $msg);
        
    }

    

    //download all problems
    public function download_problems()
    {
        $categories= Category::all();
        $languages= Language::all();
        return view('problems.download_problems', ['categories'=> $categories, 'languages'=> $languages ]);
    }
    public function download_selected_problems(Request $request)
    {
        if($request->category_id==0 && $request->language_id==0)
        {
            $problems= Problem::all();
        }
        else if($request->category_id==0)
        {
            $problems= Problem::where('language_id', $request->language_id)->get();
        }
        else if($request->language_id==0)
        {
            $problems= Problem::where('category_id', $request->category_id)->get();
        }
        else
        {
            $problems= Problem::where('category_id', $request->category_id)->where('language_id', $request->language_id)->get();
        }

        if($problems->count()==0)
        {
            $msg = "سوالی با این دسته‌بندی و زبان وجود ندارد";
            return redirect()->back()->with('warning', $msg );
        }
        else
        {
            $zip = new ZipArchive;
            $fileName = 'problems.zip';

            if ($zip->open(storage_path("$fileName"), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) 
            {
                foreach($problems as $problem)
                {
                    $path = Storage::disk('public')->path("files/$problem->file_path");
                    $zip->addFile($path, $problem->file_path);
                }
                $zip->close();
            }
            return response()->download(storage_path($fileName));

        }

    }

    //problems all
    public function problems_all()
    {
        $problems = Problem::orderBy('id', 'desc')->get();
        $languages = Language::all();
        return view('problems.problems-all', ['problems' => $problems, 'languages'=> $languages]);
    }

    //Filter
    public function problem_filter(Language $language)
    {
        $problems = Problem::where('language_id', $language->id )->get();
        $languages = Language::all();
        return view('problems.problems-all', ['problems' => $problems, 'languages'=> $languages ] );
    }

    //comment add
    public function comment_save(Request $request)
    {
        $user=Auth::user();
        $request->validate([
            'message' => 'required|string',
        ]);
        $comment=Comment::create([
            'message' => $request->message,
            'reply' => NULL,
            'user_id' => $user->id,
        ]);

        $msg= "نظر شما با موفقیت ثبت شد.";
        return redirect()->back()->with('success', $msg );
    }


    //Upload And Download Problem
    public function problem_create()
    {
        $languages=Language::all();
        $categories= Category::all();
        return view('problems.problem-add', ['languages'=> $languages, 'categories'=> $categories]);
    }
    public function problem_save(Request $request)
    {
       $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|integer',
        'language_id' => 'required|integer',
        'number' => 'required|integer',
        'description' => 'required|string|max:255',
        'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);
        
        $file=$request->file('file_path');
        $fileName = time().'.'.$file->extension();  
        Storage::putFileAs('public/files', $file, $fileName);

        $problem = Problem::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'language_id' => $request->language_id,
            'number' => $request->number,
            'description' => $request->description,
            'file_path' => $fileName,
            'user_id' => Auth::user()->id,
        ]);

        $msg= "سوال جدید با موفقیت ثبت شد.";
        return redirect()->back()->with('success', $msg );
    }


    //Problem Replies
    public function problem_replies(Problem $problem)
    {
        $replies = Reply::where( 'problem_id' , $problem->id )->orderBy('id', 'desc')->get();
        return view('problems.problem-replies', ['replies'=> $replies, 'problem'=> $problem]);
    }

    public function reply_confirmation(Reply $reply)
    {
        $reply->confirmation_status = 1;

        try{
            $reply->save();
        }catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }

        $msg = "پاسخ با موفقیت تایید شد.";
        return redirect()->back()->with('success', $msg );
    }


    public function reply_destroy(Reply $reply)
    {
        if(Storage::disk('public')->exists("reply-files/$reply->file_path"))
        {
            Storage::disk('public')->delete("reply-files/$reply->file_path");
        }
        else
        {
            $msg= "فایل مورد نظر پیدا نشد.";
            return redirect()->back()->with('error', $msg );
        }
        
        try{
            $reply->delete();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }   

        $msg= "آیتم مور نظر با موفقیت حذف گردید.";
        return redirect()->back()->with('success', $msg );
    }



    //Edit and Update Problem
    public function problem_edit(Problem $problem)
    {
        $languages= Language::where('id', '<>', $problem->language_id)->get();
        $categories= Category::where('id', '<>', $problem->category_id)->get();
        return view('problems.problem-edit', ['problem'=> $problem, 'languages'=> $languages, 'categories'=> $categories ]);
    }

    public function problem_update(Request $request, Problem $problem)
    {
        if(empty($request->file_path))
        {
            if( $request->title==$problem->title && $request->category_id==$problem->category_id && $request->description==$problem->description && 
                $request->number==$problem->number && $request->language_id==$problem->language_id )
            {
                $msg= "تغییرات جدیدی وارد نشده است!";
                return redirect()->back()->with('warning', $msg );
            }
            else
            {
                $request->validate([
                    'title' => 'required|string|max:255',
                    'category_id' => 'required|integer',
                    'language_id' => 'required|integer',
                    'number' => 'required|integer',
                    'description' => 'required|string|max:255',
                ]);
            }
            
        }
        else
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|integer',
                'language_id' => 'required|integer',
                'number' => 'required|integer',
                'description' => 'required|string|max:255',
                'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);


            //delete old file
            if(Storage::disk('public')->exists("files/$problem->file_path"))
            {
                Storage::disk('public')->delete("files/$problem->file_path");
            }

            //save new file
            $file=$request->file('file_path');
            $fileName = time().'.'.$file->extension();  
            Storage::putFileAs('public/files', $file, $fileName);
            $problem->file_path= $fileName;

        }

        $problem->title = $request->title;
        $problem->category_id = $request->category_id;
        $problem->description = $request->description;
        $problem->number = $request->number;
        $problem->language_id = $request->language_id;
        
        try{
            $problem->save();
        }catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }


        $msg = "ویرایش سوال با موفقیت انجام شد." ;
        return redirect(route('profile'))->with('success', $msg);
        
    }

    public function problem_destroy(Problem $problem)
    {
        if(Storage::disk('public')->exists("files/$problem->file_path"))
        {
            Storage::disk('public')->delete("files/$problem->file_path");
        }
        else
        {
            $msg= "فایل مورد نظر پیدا نشد.";
            return redirect()->back()->with('error', $msg );
        }
        
        try{
            $problem->delete();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }   

        $msg= "آیتم مور نظر با موفقیت حذف گردید.";
        return redirect()->back()->with('success', $msg );
    }


    //Category Create and Category Problems
    public function category_create()
    {
        return view('problems.category-add');
    }

    public function category_save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        $msg= "دسته‌بندی جدید با موفقیت ثبت شد.";
        return redirect()->back()->with('success', $msg );
    }

    public function category_problems(Category $category)
    {
        $problems = Problem::where('category_id', $category->id)->get();
        return view('problems.category-problems', ['problems'=> $problems, 'category'=> $category ]);
    }


    //Language Create and Language Problems
    public function language_create()
    {
        return view('problems.language-add');
    }

    public function language_save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:languages',
        ]);

        $language = Language::create([
            'name' => $request->name,
        ]);

        $msg= "زبان جدید با موفقیت ثبت شد.";
        return redirect()->back()->with('success', $msg );
    }

    public function language_problems(Language $language)
    {
        $problems = Problem::where('language_id', $language->id)->get();
        return view('problems.language-problems', ['problems' => $problems, 'language'=> $language ]);
    }



}
