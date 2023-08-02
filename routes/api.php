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
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
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

// Route General

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

Route::get('images/{filename}', [ImageController::class, 'getImage'])->name('image.display');

Route::post('/password/reset/request', [ForgotPasswordController::class, 'sendResetCode']);
Route::post('/password/reset/update/{code}', [ResetPasswordController::class, 'resetPassword']);
Route::post('/UserMailSend', [ContactUsController::class, 'sendEmailEnregister']);
Route::post('/contact-us', [ContactUsController::class, 'sendEmail']);

// Route definition with authentication middleware
Route::middleware('auth:api')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/formations', [FormationController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::get('/user/{userId}/courses', [CourseController::class, 'coursesAcheter']);
    Route::get('/course/{courseId}', [CourseController::class, 'course']);
    Route::get('/objectCourses/{objectiveId}', [CourseController::class, 'objectCourses']);
    Route::get('/videoCourses/{courseId}', [CourseController::class, 'videoCourses']);
    Route::get('/CommentCourses/{courseId}', [CourseController::class, 'CommentCourses']);
    Route::post('/registerComments', [CourseController::class, 'registerComments']);
    Route::get('/CommentCoursesAvg/{courseId}', [CourseController::class, 'CommentCoursesMoyn']);
    Route::put('/updateRatCourse/{courseId}', [CourseController::class, 'updateCourseRat']);
    Route::post('/CoursesAcheter', [CourseController::class, 'CoursesAcheterUser']);
    Route::get('/CoursesAcheterbyUser/{courseId}/{compteId}', [CourseController::class, 'CoursesacheterbyUser']);
    Route::get('/formation/{formationId}', [FormationController::class, 'formation']);
    Route::get('/objectFormation/{objectiveId}', [FormationController::class, 'objectFormation']);
    Route::get('/CommentFormation/{formationId}', [FormationController::class, 'CommentFormation']);
    Route::post('/registerCommentsFor', [FormationController::class, 'registerCommentsFor']);
    Route::post('/FormationInscp', [CertificateController::class, 'registerResultatIscription']);
    Route::get('/FormationInscpget/{formationId}/{compteId}', [CertificateController::class, 'FormationInscpgetUser']);
    Route::put('/updateAtestationInscr/{formationId}/{compteId}', [CertificateController::class, 'updateAtestationInscrForm']);
    Route::get('/AtestationDown/{formationId}/{compteId}', [CertificateController::class, 'AtestationDownInsc']);
    Route::get('/FindquizCourse/{courseId}/{compteId}', [QuizController::class, 'findquizCourseUser']);
    Route::get('/certificategetDown/{courseId}/{compteId}', [CertificateController::class, 'certificategetDownoald']);
    Route::put('/updateCertificate/{courseId}/{compteId}', [CertificateController::class, 'updateNewCertificate']);
    Route::get('/QuizmyCourse/{courseId}', [QuizController::class, 'quizCourse']);
    Route::post('/ResultatTest', [QuizController::class, 'registerResultat']);
    Route::put('/updateResultat/{courseId}/{compteId}', [QuizController::class, 'updateResultatUse']);

});
Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate']);
Route::post('/generate-atestation', [CertificateController::class, 'generateAtestation']);
