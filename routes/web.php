<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ReqbidController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProposalbidController;
use App\Http\Controllers\ReqcommentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OfflinetopicController;
use App\Http\Controllers\BookorderController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\BooksController;
use App\Http\Controllers\admin\CourseController as AdminCourseController;
use App\Http\Controllers\admin\proposalController as AdminproposalController;
use App\Http\Controllers\admin\ResourceController  as AdminResourceController;
use App\Http\Controllers\admin\RequestController as AdminRequest;
use App\Http\Controllers\admin\TutorialController as AdminTutorialController;
use App\Http\Controllers\admin\BadgeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\EventController as AdminEventController;
use App\Http\Controllers\admin\PaymentLogController;
use App\Http\Controllers\BadgesController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\BookreviewController;
use App\Http\Controllers\CommentreportController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\CoursereviewController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfflinereportsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductreviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalreviewController;
use App\Http\Controllers\PropsolutionController;
use App\Http\Controllers\ReqSolutionController;
use App\Http\Controllers\ResourcebidController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TermsandPrivacyController;
use App\Http\Controllers\TutorialreviewController;

use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('index');


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    //request routes
    Route::get('/previous_year', [RequestController::class, 'previousyearQuestion'])->name('req.prevyear');
    Route::get('/AllSolution', [ReqSolutionController::class, 'allsolution'])->name('req.allsolution');
    Route::get('/edit/{id}', [RequestController::class, 'show'])->name('req.show');
    Route::post('/editreq/{id}', [RequestController::class, 'update'])->name('req.upd');
    Route::post('/addrequest', [RequestController::class, 'insert'])->name('req.insert');
    Route::post('/adddesc', [RequestController::class, 'insert'])->name('req.desc');
    Route::get('/request_single/{id}', [RequestController::class, 'showsingle'])->name('req.showsingle');
    Route::post('/request_bid', [ReqbidController::class, 'store'])->name('reqbid.store');
    Route::post('/request_sol', [ReqSolutionController::class, 'store'])->name('reqsol.store');
    Route::post('/request_comment', [ReqcommentController::class, 'store'])->name('reqcomment.store');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');

    Route::post('/request_review', [ReviewController::class, 'store'])->name('reqreview.store');
    Route::post('/proposal_review', [ProposalreviewController::class, 'store'])->name('propreview.store');
    Route::get('/latestreq', [RequestController::class, 'latest'])->name('request.latest');
    Route::get('/trendingreq', [RequestController::class, 'trending'])->name('request.trending');
    Route::get('/week', [RequestController::class, 'weekly'])->name('req.weekly');
    Route::post('/delete', [RequestController::class, 'destroy'])->name('req.destroy');
    Route::get('/myrequests', [RequestController::class, ('getuserrequests')])->name('req.myrequests');
    Route::post('/report/{uid}/{cid}', [CommentreportController::class, 'get'])->name('req.report');
    //proposal routes
    Route::post('/proposals', [ProposalController::class, 'get'])->name('proposal.get');
    Route::get('/proposal_single/{id}', [ProposalController::class, 'showproposal'])->name('proposal.showproposal');
    Route::post('/proposal_single', [ProposalbidController::class, 'store'])->name('proposalbid.store');
    Route::post('/proposal_sol', [PropsolutionController::class, 'store'])->name('prosolution.store');
    Route::get('/proposalsol/{uid}/{rid}/{sid}', [PropsolutionController::class, ('solutionreport')])->name('proposal.reppropsol');
    Route::get('/latest_proposal', [ProposalController::class, 'latesttutorial'])->name('proposal.new');
    Route::get('/weekly_proposal', [ProposalController::class, 'week'])->name('proposal.week');
    Route::get('/trending_proposal', [ProposalController::class, 'trending'])->name('proposal.trending');
    //book routes
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books_single/{id}', [BookController::class, 'showbook'])->name('books.showbook');
    Route::post('/books_single', [BookreviewController::class, 'store'])->name('books.storereview');
    Route::get('/books_latest', [BookController::class, 'latest'])->name('book.latest');
    Route::get('/books_trending', [BookController::class, 'trending'])->name('book.trending');
    Route::get('/books_weekly', [BookController::class, 'week'])->name('book.week');
    //course routes
    Route::post('/course', [CourseController::class, 'get'])->name('course.get');
    Route::get('/course_single/{id}', [CourseController::class, 'showcourse'])->name('course.showcourse');
    Route::post('/course_single', [CoursereviewController::class, 'store'])->name('course.storereview');
    Route::get('/course_latest', [CourseController::class, 'latest'])->name('course.latest');
    Route::get('/course_trending', [CourseController::class, 'trending'])->name('course.trending');
    Route::get('/course_weekly', [CourseController::class, 'week'])->name('course.week');
    //tutorial routes
    Route::post('/tutorial', [TutorialController::class, 'get'])->name('tutorial.get');
    Route::get('/tutorial_sin/{id}', [TutorialController::class, 'showsinglevideos'])->name('tutorial.sin');
    Route::post('/tutorial_sin', [TutorialreviewController::class, 'store'])->name('playlist.storereview');
    Route::get('/tutlatest', [TutorialController::class, 'latest'])->name('tutorial.latest');
    Route::get('/tuttrending', [TutorialController::class, 'trending'])->name('tutorial.trending');
    Route::get('/tutorial_weekly', [TutorialController::class, 'week'])->name('tutorial.week');
    //Resource
    Route::post('/resource', [ResourceController::class, 'store'])->name('resource.store');
    Route::get('/resource_single/{id}', [ResourceController::class, 'showresource'])->name('resource.showresource');
    Route::post('/resource_single', [ResourcebidController::class, 'store'])->name('resourcebid.store');
    Route::get('/res_latest', [ResourceController::class, 'latest'])->name('res.latest');
    Route::get('/res_trending', [ResourceController::class, 'trending'])->name('res.trending');
    Route::get('/res_weekly', [ResourceController::class, 'week'])->name('res.week');
    // event page
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
  
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    // Contest page
    Route::get('/contest', [ContestController::class, 'index'])->name('contest.index');
    Route::post('/contest', [ContestController::class, 'store'])->name('contest.store');
    //offline topic
    Route::get('/offlinetopic', [OfflinetopicController::class, ('show')])->name('offlinetopic.show');
    Route::post('/offlinetopic', [OfflinetopicController::class, ('get')])->name('offlinetopic.get');
    Route::post('/offlinetopic/report', [OfflinereportsController::class, ('store')])->name('offlinetopic.report');
    // Reported page
    Route::get('/reported',[ReqSolutionController::class,('Allrepsolution')])->name('reported.ind');
    //req solution
    Route::get('/mysolution', [ReqSolutionController::class, ('mysol')])->name('profile.mysol');
    Route::get('/mysolution/{uid}/{rid}/{sid}', [ReqSolutionController::class, ('solutionreport')])->name('profile.repsol');
    //feedback
    Route::get('/feedback', [FeedbackController::class, ('index')])->name('feedback.index');
    Route::post('/feedback', [FeedbackController::class, ('store')])->name('feedback.store');

    //product controller
    Route::get('/product', [ProductController::class, ('index')])->name('product.index');
    Route::post('/product', [ProductController::class, ('store')])->name('product.store');
    Route::patch('/product', [ProductController::class, ('search')])->name('product.search');
    Route::get('/product_single/{id}', [ProductController::class, ('showproduct')])->name('product.showproduct');
    Route::post('/product_single', [ProductreviewController::class, 'store'])->name('products.storereview');
    Route::get('/product_latest', [ProductController::class, 'latest'])->name('prod.latest');
    Route::get('/product_trending', [ProductController::class, 'trending'])->name('prod.trending');
    Route::get('/product_weekly', [ProductController::class, 'week'])->name('prod.week');

    //profile
    Route::get('/profile_dashboard/{id}', [ProfileController::class, ('show')])->name('profile.show');
    Route::post('/profile_dashboard/{id}', [ProfileController::class, ('updatecover')])->name('profile.upcover');
    Route::get('/profile_myreqs/{id}', [ProfileController::class, ('myreqs')])->name('profile.myreqs');
    Route::get('/profile_products/{id}', [ProfileController::class, ('products')])->name('profile.products');
    Route::get('/profile_book/{id}', [ProfileController::class, ('Book')])->name('profile.book');
    Route::get('/profile', [ProfileController::class, ('index')])->name('profile.index');
    Route::patch('/profile_basic/{id}', [ProfileController::class, ('update')])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, ('password')])->name('profile.password');
    Route::post('change-password', [ProfileController::class, ('UpdatePass')])->name('change.password');
    Route::get('/profile_review/{id}', [ProfileController::class, ('showreview')])->name('profile.review');
    Route::get('/profile_activity/{id}', [ProfileController::class, ('showactivity')])->name('profile.activity');
    Route::get('/profile_earning/{id}', [ProfileController::class, ('showearning')])->name('profile.earning');
});

Route::get('/', [RequestController::class, 'index'])->name('req.index');
Route::patch('/', [RequestController::class, 'search'])->name('req.search');
Route::get('ch/{name}', [RequestController::class, 'searchcat'])->name('req.searchcat');
//proposal
Route::get('/proposals', [ProposalController::class, 'index'])->name('proposal.index');
Route::patch('/proposals', [ProposalController::class, 'search'])->name('proposal.search');
Route::get('prop/{name}', [ProposalController::class, 'searchcat'])->name('prop.searchcat');
//Books home routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::patch('/books', [BookController::class, 'search'])->name('book.search');

//course homepqage
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/freecourses/{id}', [CourseController::class, 'freecourse'])->name('course.freecourse');
Route::patch('/course', [CourseController::class, 'search'])->name('course.search');

//tutorial
Route::get('/tutorial', [TutorialController::class, 'getvideos'])->name('tutorial.getvideos');
Route::patch('/tutorial', [TutorialController::class, 'search'])->name('tutorial.search');
Route::get('/freetutorial/{id}', [TutorialController::class, 'freetutorial'])->name('tutorial.freetutorial');
//marketplace
Route::get('/marketplace', [MarketplaceController::class, ('index')])->name('market.index');
Route::patch('/marketplace', [MarketplaceController::class, 'search'])->name('marketplace.search');
//resource home page
Route::get('/resource', [ResourceController::class, 'index'])->name('resource.index');
Route::patch('/resource', [ResourceController::class, 'search'])->name('res.search');
Route::get('/res/{cat}', [ResourceController::class, 'searchcategory'])->name('resource.searchcat');


//book order
Route::get('/bookorder', [BookorderController::class, ('index')])->name('bookorder.index');
Route::post('/bookorder/{bid}', [BookorderController::class, ('store')])->name('bookorder.store');
Route::get('/booksell', [BookorderController::class, ('Sell')])->name('bookorder.sell');

Route::middleware(['admin'])->name('admin.')->group(function () {
    //admin controller
    Route::get('/admin', [AdminController::class, 'index'])->name('index');
    Route::resource('/admin/book', BooksController::class);
    Route::post('/admin/book/del', [BooksController::class ,'del'])->name('book.delete');
    Route::get('/admin/product', [AdminProductController::class ,'index'])->name('product.index');
    Route::post('/admin/product/del', [AdminProductController::class ,'del'])->name('product.delete');
    Route::resource('/admin/courses', AdminCourseController::class);
    Route::post('/admin/courses/del', [AdminCourseController::class ,'del'])->name('course.delete');
    Route::resource('/admin/proposals', AdminProposalController::class);
    Route::post('/admin/proposals/del', [AdminProposalController::class ,'del'])->name('proposal.delete');
    Route::resource('/admin/resources', AdminResourceController::class);
    Route::post('/admin/resources/del', [AdminResourceController::class ,'del'])->name('resource.delete');
    Route::resource('/admin/request', AdminRequest::class);
    Route::post('/admin/request/del', [AdminRequest::class ,'del'])->name('request.delete');
    Route::resource('/admin/tutorials', AdminTutorialController::class);
    Route::post('/admin/tutorials/del', [AdminTutorialController::class ,'del'])->name('tutorial.delete');
    Route::resource('/admin/badge', BadgeController::class);
    Route::post('/admin/badge/del', [BadgeController::class ,'del'])->name('badge.delete');
    Route::resource('/admin/user', UserController::class);
    Route::post('/admin/user/del', [UserController::class ,'delete'])->name('user.delete');
    Route::resource('/admin/event', AdminEventController::class);
    Route::post('/admin/event/del', [AdminEventController::class ,'del'])->name('event.delete');
    Route::get('/admin/announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/admin/addannouncement', [AnnouncementController::class, 'get'])->name('addannouncement');
    Route::post('/admin/addannouncement', [AnnouncementController::class, 'store'])->name('storeannouncement');
    Route::get('/admin/announcement/{id}', [AnnouncementController::class, 'updatestatus'])->name('updateannouncement');
    Route::delete('/admin/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('destroyannouncement');
});

// terms of use and privacy
Route::get('/terms', [TermsandPrivacyController::class, 'termshow'])->name('term.show');
Route::get('/privacy', [TermsandPrivacyController::class, 'privacyshow'])->name('privacy.show');
Route::get('/badge', [BadgesController::class, 'show'])->name('badge.show');
//check chat
Route::get('/chat/{reqid}/{toid}', [MessageController::class, ('index')])->name('chat.index');
Route::post('/messages', [MessageController::class, ('store')])->name('chat.store');

// Payment Routes for bKash
Route::post('token', [PaymentController::class, 'token'])->name('token');
Route::get('createpayment', [PaymentController::class, 'createpayment'])->name('createpayment');
Route::get('executepayment', [PaymentController::class, 'executepayment'])->name('executepayment');

Route::middleware('auth')->group(function () {
    Route::post('payment-additional', [PaymentController::class, 'paymentAdditional'])->name('payment.additional');
    Route::any('my-messages', [MessageController::class, 'messages'])->name('messages');
    Route::post('send-message', [MessageController::class, 'sendMessage'])->name('messages-send');
    Route::post('get-messages/{from}', [MessageController::class, 'getMessage'])->name('get-messages');
    Route::post('delete-message', [MessageController::class, 'deleteMessage'])->name('delete-message');
});

Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/payment-log', [PaymentLogController::class, 'index'])->name('payment-log');
    Route::get('/pay-to-seller/{id}', [PaymentLogController::class, 'payToSeller'])->name('pay-to-seller');
});

Route::get('/request/action', [RequestController::class, 'action'])->name('live_search.action');