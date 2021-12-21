<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//home public and private
Route::get('/', 'ProblemController@home')->name('publichome'); 
Route::get('/Home/NormalUser', 'ProblemController@home')->middleware(['auth'])->name('normalhome');
Route::get('/Home/Admin', 'ProblemController@admin_special_home')->middleware(['checkrole'])->name('adminhome');
Route::get('/Home/SpecialUser', 'ProblemController@admin_special_home')->middleware(['checkrolespecial'])->name('specialhome');
//problem details and reply
Route::get('/Home/Problem/Details/{problem}', 'ProblemController@problem_details')->middleware(['auth'])->name('problem.details');
Route::get('/Problem/Show/{problem}','ProblemController@problem_show')->middleware(['auth'])->name('problem.show');
Route::get('/Reply/Show/{reply}','ProblemController@reply_show')->middleware(['auth'])->name('reply.show');
Route::post('/Home/Problem/ReplySave/{problem}','ProblemController@reply_save')->middleware(['auth'])->name('problem.reply.save');
//designers
Route::get('/Home/Designers', 'DesignerController@all_designers')->middleware(['auth'])->name('designers'); 
Route::get('/Home/Designers/DesignerProblems/{user}', 'DesignerController@designer_problems')->middleware(['auth'])->name('designer.problems');
//download all problems
Route::get('/Home/DownloadProblems', 'ProblemController@download_problems')->middleware(['auth'])->name('download.problems'); 
Route::post('/Home/DownloadSelectedProblems', 'ProblemController@download_selected_problems')->middleware(['auth'])->name('download.selected.problems'); 
//filter 
Route::get('/Home/ProblemFilter/{language}', 'ProblemController@problem_filter')->name('problem.filter'); 
Route::get('/Home/ProblemsAll', 'ProblemController@problems_all')->name('problems.all'); 
//comments
Route::post('/Home/CommentSave','ProblemController@comment_save')->middleware(['auth'])->name('comment.save');
//all users profile
Route::get('/Home/Profile', 'UserController@profile')->middleware(['auth'])->name('profile'); 
Route::get('/Home/Profile/ReplyDestroy/{reply}', 'ProblemController@reply_destroy')->middleware(['auth'])->name('problem.reply.destroy'); 
//edit user
Route::get('/Profile/Edit', 'UserController@edit')->middleware(['auth'])->name('user.edit');
Route::put('/Profile/Update', 'UserController@update')->middleware(['auth'])->name('user.update');
//problem replies
Route::get('/Profile/Reply/Edit/{reply}','ProblemController@problem_reply_edit')->middleware(['auth'])->name('problem.reply.edit');
Route::put('/Profile/Reply/Update/{reply}','ProblemController@problem_reply_update')->middleware(['auth'])->name('problem.reply.update');




//admin
Route::get('/Admin/ManagementPanel','AdminController@index')->middleware(['checkrole'])->name('admin.index');
//user 
Route::get('/Admin/User/Edit/{user}', 'AdminController@user_edit')->middleware(['checkrole'])->name('admin.user.edit');
Route::put('/Admin/User/Update/{user}', 'AdminController@user_update')->middleware(['checkrole'])->name('admin.user.update');
Route::get('/Admin/User/Destroy/{user}', 'AdminController@user_destroy')->middleware(['checkrole'])->name('admin.user.destroy');
//admin -> problem
Route::get('/Admin/Problem/Edit/{problem}', 'AdminController@problem_edit')->middleware(['checkrole'])->name('admin.problem.edit');
Route::put('/Admin/Problem/Update/{problem}', 'AdminController@problem_update')->middleware(['checkrole'])->name('admin.problem.update');
Route::get('/Admin/Problem/Destroy/{problem}', 'AdminController@problem_destroy')->middleware(['checkrole'])->name('admin.problem.destroy');
//admin -> language
Route::get('/Admin/Language/Edit/{language}', 'AdminController@language_edit')->middleware(['checkrole'])->name('admin.language.edit');
Route::put('/Admin/Language/Update/{language}', 'AdminController@language_update')->middleware(['checkrole'])->name('admin.language.update');
Route::get('/Admin/Language/Destroy/{language}', 'AdminController@language_destroy')->middleware(['checkrole'])->name('admin.language.destroy');
//admin -> category
Route::get('/Admin/Category/Edit/{category}', 'AdminController@category_edit')->middleware(['checkrole'])->name('admin.category.edit');
Route::put('/Admin/Category/Update/{category}', 'AdminController@category_update')->middleware(['checkrole'])->name('admin.category.update');
Route::get('/Admin/Category/Destroy/{category}', 'AdminController@category_destroy')->middleware(['checkrole'])->name('admin.category.destroy');
//admin role
Route::get('/Admin/Role/Edit/{role}', 'AdminController@role_edit')->middleware(['checkrole'])->name('admin.role.edit');
Route::put('/Admin/Role/Update/{role}', 'AdminController@role_update')->middleware(['checkrole'])->name('admin.role.update');
//admin comment
Route::get('/Comment/Reply/{comment}','AdminController@comment_reply')->middleware(['checkrole'])->name('comment.reply');
Route::post('/Comment/Reply/Save/{comment}','AdminController@reply_save')->middleware(['checkrole'])->name('reply.save');
Route::get('/Admin/Comment/Reply/Edit/{comment}','AdminController@reply_edit')->middleware(['checkrole'])->name('reply.edit');
Route::post('/Admin/Comment/Reply/Update/{comment}','AdminController@reply_update')->middleware(['checkrole'])->name('reply.update');
Route::get('/Admin/Comment/Destroy/{comment}','AdminController@comment_destroy')->middleware(['checkrole'])->name('comment.destroy');





//upload problem
Route::get('/Problem/Add','ProblemController@problem_create')->middleware(['checkrolespecial'])->name('problem.add');
Route::post('/Problem/Save','ProblemController@problem_save')->middleware(['checkrolespecial'])->name('problem.save');
//edit and destroy problem
Route::get('/Problem/Edit/{problem}', 'ProblemController@problem_edit')->middleware(['checkrolespecial'])->name('problem.edit');
Route::put('Problem/Update/{problem}', 'ProblemController@problem_update')->middleware(['checkrolespecial'])->name('problem.update');
Route::get('Problem/Destroy/{problem}', 'ProblemController@problem_destroy')->middleware(['checkrolespecial'])->name('problem.destroy');

//problem replies
Route::get('/Problem/Replies/{problem}', 'ProblemController@problem_replies')->middleware(['checkrolespecial'])->name('problem.replies'); 
Route::get('/Problem/Reply/Confirmation/{reply}', 'ProblemController@reply_confirmation')->middleware(['checkrolespecial'])->name('reply.confirmation'); 
Route::get('Problem/Reply/Destroy/{reply}', 'ProblemController@reply_destroy')->middleware(['checkrolespecial'])->name('user.reply.destroy');
// Route::post('/Home/DownloadSelectedProblems', 'ProblemController@download_selected_problems')->name('download.selected.problems'); 

//add category
Route::get('/Problem/Add/CategoryAdd','ProblemController@category_create')->middleware(['checkrolespecial'])->name('category.add');
Route::post('/Problem/Add/CategorySave','ProblemController@category_save')->middleware(['checkrolespecial'])->name('category.save');
//category problems
Route::get('/Home/Problems/CategoryProblems/{category}', 'ProblemController@category_problems')->name('category.problems'); 

//add language
Route::get('/Problem/Add/LanguageAdd','ProblemController@language_create')->middleware(['checkrolespecial'])->name('language.add');
Route::post('/Problem/Add/LanguageSave','ProblemController@language_save')->middleware(['checkrolespecial'])->name('language.save');
//language problems
Route::get('/Home/Problems/LanguageProblems/{language}', 'ProblemController@language_problems')->name('language.problems'); 
 





Route::get('/dashboard', 'UserController@profile' )->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
