<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactUsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
});
Route::controller(RegisterController::class)->group(function () {
    Route::post('/register', 'register');
});

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



Route::get('/courses', [CourseController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/user/{userId}/courses', [CourseController::class, 'coursesAcheter']);
Route::get('/formations', [FormationController::class, 'index']);
Route::get('/course/{courseId}', [CourseController::class, 'course']);
Route::get('/objectCourses/{objectiveId}', [CourseController::class, 'objectCourses']);
Route::get('/videoCourses/{courseId}', [CourseController::class, 'videoCourses']);
Route::get('/CommentCourses/{courseId}', [CourseController::class, 'CommentCourses']);
Route::post('/registerComments', [CourseController::class, 'registerComments']);
Route::get('/formation/{formationId}', [FormationController::class, 'formation']);

Route::get('/objectFormation/{objectiveId}', [FormationController::class, 'objectFormation']);
Route::get('/CommentFormation/{formationId}', [FormationController::class, 'CommentFormation']);
Route::post('/registerCommentsFor', [FormationController::class, 'registerCommentsFor']);

Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);

Route::get('/QuizmyCourse/{courseId}', [QuizController::class, 'quizCourse']);
Route::post('/ResultatTest', [QuizController::class, 'registerResultat']);
Route::get('/FindquizCourse/{courseId}/{compteId}', [QuizController::class, 'findquizCourseUser']);
Route::put('/updateResultat/{courseId}/{compteId}', [QuizController::class, 'updateResultatUse']);


Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate']);
Route::put('/updateCertificate/{courseId}/{compteId}', [CertificateController::class, 'updateNewCertificate']);


Route::get('/certificategetDown/{courseId}/{compteId}', [CertificateController::class, 'certificategetDownoald']);

Route::get('/CommentCoursesAvg/{courseId}', [CourseController::class, 'CommentCoursesMoyn']);


Route::put('/updateRatCourse/{courseId}', [CourseController::class, 'updateCourseRat']);


Route::post('/contact-us', [ContactUsController::class, 'sendEmail']);
