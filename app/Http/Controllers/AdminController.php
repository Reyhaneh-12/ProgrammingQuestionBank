<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Problem;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Language;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Exception;
use phpDocumentor\Reflection\Types\Null_;

class AdminController extends Controller
{
    //
    public function index()
    {
        $users=User::where('role_id','<>',1)->orderBy('id', 'desc')->get();
        $problems = Problem::orderBy('id', 'desc')->get();
        $replies = Reply::orderBy('id', 'desc')->get();
        $comments= Comment::orderBy('id', 'desc')->get();
        $languages= Language::orderBy('id', 'desc')->get();
        $categories= Category::orderBy('id', 'desc')->get();
        $roles= Role::orderBy('id', 'asc')->get();

        return view('admin.management-panel', ['users'=> $users, 'problems' => $problems, 'replies' => $replies, 'comments'=> $comments, 'languages'=> $languages, 'categories'=> $categories, 'roles'=> $roles ]);
    }

    //User Edit and User Update and User Delete
    public function user_edit(User $user)
    {
        return view('admin.user-edit', ['user'=> $user]);
    }
    public function user_update(Request $request, User $user)
    {
        if (Hash::check($request->current_password, $user->password))//check the current_password matches with the password user
        {
            if(!empty($request->new_password))
            {
                if( $request->username!=$user->username && $request->id!=$user->id )
                {
                    $request->validate([
                        'id' => 'required|integer|unique:users',
                        'username' => 'required|string|min:6|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else if( $request->username!=$user->username )
                {
                    $request->validate([
                        'username' => 'required|string|min:6|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else if( $request->id!=$user->id )
                {
                    $request->validate([
                        'id' => 'required|integer|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else
                {
                    $request->validate([
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);

                }
                
                $password= Hash::make($request->new_password);
                $user->password = $password;

            }
            else
            {
                if( $request->username!=$user->username && $request->id!=$user->id )
                {
                    $request->validate([
                        'id' => 'required|integer|unique:users',
                        'username' => 'required|string|min:6|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else if( $request->username!=$user->username )
                {
                    $request->validate([
                        'username' => 'required|string|min:6|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else if( $request->id!=$user->id )
                {
                    $request->validate([
                        'id' => 'required|integer|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else
                {
                    $msg= "تغییرات جدیدی وارد نشده است!";
                    return redirect()->back()->with('warning', $msg); 
                }
                
            }

            $user->id = $request->id;
            $user->username = $request->username;

            try{
                $user->save();
            }catch(Exception $exception){
                return redirect()->back()->with('error-code', $exception->getCode());
            }

            $msg = "ویرایش کاربر با موفقیت انجام شد." ;
            return redirect(route('admin.index'))->with('success', $msg);
        }
        else
        {
            $msg = "رمز وارد شده نادرست است." ;
            return redirect()->back()->with('error', $msg);
        }
    }

    public function user_destroy(User $user)
    {
        if($user->role_id==2)
        {
            $user->problems()->delete();
        }
        elseif($user->role_id==3)
        {
            $user->comments()->delete();
        }
        
        try{
            $user->delete();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }   

        $msg="آیتم مور نظر با موفقیت حذف گردید.";
        return redirect(route('admin.index'))->with('success', $msg );
    }
    

    //Problem Edit and Problem Update
    public function problem_edit(Problem $problem)
    {
        $users= User::where('role_id', '<>', 3 )->where('id', '<>', $problem->user_id)->get();
        $languages= Language::where('id', '<>', $problem->language_id)->get();
        $categories= Category::where('id', '<>', $problem->category_id)->get();
        return view('admin.problem-edit', ['problem'=> $problem, 'users'=> $users, 'languages'=> $languages, 'categories'=> $categories ]);
    }

    public function problem_update(Request $request, Problem $problem)
    {
        if(empty($request->file_path))
        {
            if( $request->id==$problem->id && $request->title==$problem->title && $request->category_id==$problem->category_id && $request->description==$problem->description && 
                $request->number==$problem->number && $request->language_id==$problem->language_id && $request->user_id==$problem->user_id)
            {
                $msg= "تغییرات جدیدی وارد نشده است!";
                return redirect()->back()->with('warning', $msg );
            }
            else if($request->id!=$problem->id)
            {
                $request->validate([
                    'id' =>'required|integer|unique:problems',
                    'title' => 'required|string|max:255',
                    'category_id' => 'required|integer',
                    'language_id' => 'required|integer',
                    'number' => 'required|integer',
                    'description' => 'required|string|max:255',
                    'user_id' => 'required|integer',
                ]);
            }
            else
            {
                $request->validate([
                    'title' => 'required|string|max:255',
                    'category_id' => 'required|integer',
                    'language_id' => 'required|integer',
                    'number' => 'required|integer',
                    'description' => 'required|string|max:255',
                    'user_id' => 'required|integer',
                ]);
            }
            
        }
        else
        {
            if($request->id!=$problem->id)
            {
                $request->validate([
                    'id' =>'required|integer|unique:problems',
                    'title' => 'required|string|max:255',
                    'category_id' => 'required|integer',
                    'language_id' => 'required|integer',
                    'number' => 'required|integer',
                    'description' => 'required|string|max:255',
                    'user_id' => 'required|integer',
                    'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);
            }
            else
            {
                $request->validate([
                    'title' => 'required|string|max:255',
                    'category_id' => 'required|integer',
                    'language_id' => 'required|integer',
                    'number' => 'required|integer',
                    'description' => 'required|string|max:255',
                    'user_id' => 'required|integer',
                    'file_path' => 'required|mimes:pdf,xlx,csv|max:2048',
                ]);
            }

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

        $problem->id = $request->id;
        $problem->title = $request->title;
        $problem->category_id = $request->category_id;
        $problem->description = $request->description;
        $problem->number = $request->number;
        $problem->language_id = $request->language_id;
        $problem->user_id = $request->user_id;
        
        try{
            $problem->save();
        }catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }


        $msg = "ویرایش سوال با موفقیت انجام شد." ;
        return redirect(route('admin.index'))->with('success', $msg);
        
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

        $msg="آیتم مورد نظر با موفقیت حذف گردید.";
        return redirect(route('admin.index'))->with('success', $msg );
    }


    //Category Edit and Category Update
    public function category_edit(Category $category)
    {
        return view('admin.category-edit', ['category' => $category ]);
    }

    public function category_update(Request $request ,Category $category)
    {
        if( $request->id!=$category->id && $request->name!=$category->name )
        {
            $request->validate([
                'id' => 'required|integer|unique:categories',
                'name' => 'required|string|unique:categories',
            ]);
        }
        elseif($request->id!=$category->id)
        {
            $request->validate([
                'id' => 'required|integer|unique:categories',
            ]);
        }
        elseif($request->name!=$category->name)
        {
            $request->validate([
                'name' => 'required|string|unique:categories',
            ]);
        }
        else
        {
            $msg= "تغییرات جدیدی وارد نشده است!";
            return redirect()->back()->with('warning', $msg ); 
        }

        $category->id = $request->id;
        $category->name = $request->name;

        try{
            $category->save();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }

        $msg = "ویرایش زبان با موفقیت انجام شد." ;
        return redirect(route('admin.index'))->with('success', $msg);

    }

    public function category_destroy(Category $category)
    {
        if(!empty(Problem::where('category_id', $category->id)))
            $category->problems()->delete();

        try{
            $category->delete();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }   
    
        $msg="آیتم مور نظر با موفقیت حذف گردید.";
        return redirect(route('admin.index'))->with('success', $msg );
    }


    //Comment Reply
    public function comment_reply(Comment $comment)
    {
        return view('comments.comment-reply',['comment' => $comment ]);
    }
    public function reply_save(Request $request, Comment $comment)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);
        $comment->reply= $request->reply;

        try{
            $comment->save();
        }catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }

        $msg= "پاسخ شما با موفقیت ثبت شد.";
        return redirect()->back()->with('success', $msg );
    }

    public function reply_edit(Comment $comment)
    {
        if($comment->reply==Null)
        {
            $msg = "شما پاسخی به این کامنت نداده‌اید!";
            return redirect()->back()->with('warning', $msg );
        }
        else
            return view('comments.reply-edit', ['comment' => $comment ]);
    }

    public function reply_update(Request $request, Comment $comment)
    {
        if( $comment->reply == $request->reply )
        {
            $msg= "تغییرات جدیدی وارد نشده است!";
            return redirect()->back()->with('warning', $msg );
        }
        else
        {
            $request->validate([
                'reply' => 'required|string',
            ]);
            $comment->reply= $request->reply;
    
            try{
                $comment->save();
            }catch(Exception $exception){
                return redirect()->back()->with('error-code', $exception->getCode());
            }
    
            $msg= "ویرایش پاسخ کامنت با موفقیت ثبت شد.";
            return redirect()->back()->with('success', $msg );
        }
        
    }

    public function comment_destroy(Comment $comment)
    {
        
        $comment->delete();   

        $msg="آیتم مورد نظر با موفقیت حذف گردید.";
        return redirect(route('admin.index'))->with('success', $msg );
    }



    //Language Edit and Language Update
    public function language_edit(Language $language)
    {
        return view('admin.language-edit', ['language' => $language ]);
    }

    public function language_update(Request $request ,Language $language)
    {
        if( $request->id!=$language->id && $request->name!=$language->name )
        {
            $request->validate([
                'id' => 'required|integer|unique:languages',
                'name' => 'required|string|unique:languages',
            ]);
        }
        elseif($request->id!=$language->id)
        {
            $request->validate([
                'id' => 'required|integer|unique:languages',
            ]);
        }
        elseif($request->name!=$language->name)
        {
            $request->validate([
                'name' => 'required|string|unique:languages',
            ]);
        }
        else
        {
            $msg= "تغییرات جدیدی وارد نشده است!";
            return redirect()->back()->with('warning', $msg ); 
        }

        $language->id = $request->id;
        $language->name = $request->name;

        try{
            $language->save();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }

        $msg = "ویرایش زبان با موفقیت انجام شد." ;
        return redirect(route('admin.index'))->with('success', $msg);

    }

    public function language_destroy(Language $language)
    {
        if(!empty(Problem::where('language_id', $language->id)))
            $language->problems()->delete();

        try{
            $language->delete();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }   
    
        $msg="آیتم مور نظر با موفقیت حذف گردید.";
        return redirect(route('admin.index'))->with('success', $msg );
    }
    

    //Role Edit and Role Update
    public function role_edit(Role $role)
    {
        return view('admin.role-edit', ['role'=> $role]);
    }

    public function role_update(Request $request ,Role $role)
    {

        if( $request->name!=$role->name )
        {
            $request->validate([
                'name' => 'required|string|unique:roles',
            ]);
        }
        else
        {
            $msg= "تغییرات جدیدی وارد نشده است!";
            return redirect()->back()->with('warning', $msg); 
        }

        $role->name = $request->name;

        try{
            $role->save();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error-code', $exception->getCode());
        }

        $msg = "ویرایش نقش با موفقیت انجام شد." ;
        return redirect(route('admin.index'))->with('success', $msg);
    }
    

    
}
