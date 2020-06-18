<?php
/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| This group of routes redirects to the site public pages.
|
*/

Route::get('/', 'SiteController@index')->name('welcome');
Route::get('services', 'SiteController@services')->name('services');
Route::get('how-it-works', 'SiteController@about')->name('about');
Route::get('offer', 'SiteController@offer')->name('offer');
Route::get('contact', 'SiteController@contact')->name('contact');
Route::get('privacy-policy', 'SiteController@privacy')->name('privacy');
Route::get('terms-conditions', 'SiteController@terms')->name('terms');

Route::get('password', function() {
    dd(Hash::make(request('password')));
});

/*
|------------------------------------------------------------------------------
| Authemtication Routes
|------------------------------------------------------------------------------
|
| The first line below this note «Auth::routes()» is automaticly inserted by 
| authentication scaffolding. Don't uncomment.
| 
| Another routes here below manage the authentication for clients, workers and 
| admins separately.
| 
| Only clients and workers can registrate. Admins can't because security
| reasons.
| 
*/

// Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('worker/login', 'Auth\WorkerLoginController@showLoginForm')->name('worker.login');
Route::post('worker/login', 'Auth\WorkerLoginController@login');
Route::post('worker/logout', 'Auth\WorkerLoginController@logout')->name('worker.logout');

Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('worker/register', 'Auth\WorkerRegisterController@showRegistrationForm')->name('worker.register');
Route::post('worker/register', 'Auth\WorkerRegisterController@register');

if ($options['reset'] ?? true) { // Password Reset Routes...

	// Route::resetPassword();
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

}

if ($options['verify'] ?? true) { // Email Verification Routes...

	// Route::emailVerification();
	Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
	Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
	Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
	// Workers email verification
	Route::get('worker/email/verify', 'Auth\WorkerVerificationController@show')
		->name('worker.verification.notice');
	Route::get('worker/email/verify/{id}', 'Auth\WorkerVerificationController@verify')
		->name('worker.verification.verify');
	Route::get('worker/email/resend', 'Auth\WorkerVerificationController@resend')
		->name('verification.resend');
}


/*
|------------------------------------------------------------------------------
| Client Routes
|------------------------------------------------------------------------------
|
| This group of routes manages the client workspace tasks
|
*/

Route::prefix('home')->middleware('verified')->group(function() { // Authenticated users routes
	// Client profile routes
	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/update', 'HomeController@update_profile')->name('user.update_profile');
	Route::get('/documents', 'HomeController@documents')->name('user.documents');
	Route::get('/document/upload', 'HomeController@document_upload')->name('user.document.upload');
	Route::post('/document/add', 'HomeController@document_add')->name('user.document.add');
	Route::get('/document/{document}/edit', 'HomeController@document_edit')->name('user.document.edit');
	Route::put('/document/{document}/update', 'HomeController@document_update')->name('user.document.update');
	Route::delete('/document/{document}/delete', 'HomeController@document_delete')->name('user.document.delete');

	// Client services routes
	Route::get('/orders', 'ServiceOrderController@index')->name('user.orders');
	Route::get('/order/create', 'ServiceOrderController@create')->name('user.order.create');
	Route::post('/order/store', 'ServiceOrderController@store')->name('user.order.store');
	Route::get('/order/{order}/edit', 'ServiceOrderController@edit')->name('user.order.edit');
	Route::get('/order/{order}/payment-error', 'ServiceOrderController@payment_error')->name('user.order.payment_error');
	Route::put('/order/{order}/update', 'ServiceOrderController@update')->name('user.order.update');
	Route::delete('/order/{order}/delete', 'ServiceOrderController@delete')->name('user.order.delete');
	Route::put('/order/{order}/close', 'ServiceOrderController@close')->name('user.order.close');
	Route::put('/order/{order}/cancel', 'ServiceOrderController@cancel')->name('user.order.cancel');
	Route::get('/order/{order}/hire/{worker}', 'ServiceOrderController@hire')->name('user.order.hire');
	
	// Route::post('webpay/{order}/return/{worker}', 'WebPayController@return')->name('user.webpay.return');
	// Route::post('webpay/{order}/final/{worker}', 'WebPayController@final')->name('user.webpay.final');

	// Client messages routes
	Route::get('/messages', 'MessageController@index')->name('user.messages');
	Route::get('/messages/chat/{job}', 'MessageController@chat')->name('user.message.chat');
	Route::post('/message/send/{job}', 'MessageController@send')->name('user.message.send');

	// Client calendar routes
	Route::get('/calendar', 'CalendarController@index')->name('user.calendar');

	// Client payments routes
	Route::get('/payments', 'PaymentController@index')->name('user.payments');
	Route::get('/payment/{payment}/detail', 'PaymentController@detail')->name('user.payment.detail');
	Route::post('/payment/store', 'PaymentController@store')->name('user.payment.store');
	Route::get('/payment/{payment}/edit', 'PaymentController@edit')->name('user.payment.edit');
	Route::put('/payment/{payment}/update', 'PaymentController@update')->name('user.payment.update');
	Route::delete('/payment/{payment}/delete', 'PaymentController@delete')->name('user.payment.delete');

	// Client ratings routes
	Route::get('/ratings', 'RatingController@index')->name('user.ratings');
	Route::get('/rating/{job}/create', 'RatingController@create')->name('user.rating.create');
	Route::post('/rating/{job}/store', 'RatingController@store')->name('user.rating.store');
	Route::get('/rating/{rating}/edit', 'RatingController@edit')->name('user.rating.edit');
	Route::put('/rating/{rating}/update', 'RatingController@update')->name('user.rating.update');
	Route::delete('/rating/{rating}/delete', 'RatingController@delete')->name('user.rating.delete');
});



/*
|------------------------------------------------------------------------------
| Worker Routes
|------------------------------------------------------------------------------
|
| This group of routes manages the worker workspace tasks.
| 
| In this case, it's used the middleware «worker.verified» as a substitute of 
| the «verified» middleware that use another way to verify worker email.
| 
*/

Route::prefix('worker')->middleware('worker.verified')->group(function() {

	// Worker profile routes
	Route::get('/', 'Worker\DashboardController@index')->name('worker.dashboard');
	Route::post('/update', 'Worker\DashboardController@update_profile')->name('worker.update_profile');
	Route::get('/documents', 'Worker\DashboardController@documents')->name('worker.documents');
	Route::get('/document/upload', 'Worker\DashboardController@document_upload')->name('worker.document.upload');
	Route::post('/document/add', 'Worker\DashboardController@document_add')->name('worker.document.add');
	Route::get('/document/{document}/edit', 'Worker\DashboardController@document_edit')->name('worker.document.edit');
	Route::put('/document/{document}/update', 'Worker\DashboardController@document_update')->name('worker.document.update');
	Route::delete('/document/{document}/delete', 'Worker\DashboardController@document_delete')->name('worker.document.delete');
	

	// Worker service routes
	Route::get('/services', 'Worker\ServiceController@index')->name('worker.services');
	Route::get('/service/create', 'Worker\ServiceController@create')->name('worker.service.create');
	Route::post('/service/store', 'Worker\ServiceController@store')->name('worker.service.store');
	Route::get('service/new', 'Worker\ServiceController@new')->name('worker.service.new');
	Route::post('/service/add', 'Worker\ServiceController@add')->name('worker.service.add');
	Route::get('/service/{service}/edit', 'Worker\ServiceController@edit')->name('worker.service.edit');
	Route::put('/service/{service}/update', 'Worker\ServiceController@update')->name('worker.service.update');
	Route::delete('/service/{service}/delete', 'Worker\ServiceController@delete')->name('worker.service.delete');

	// Worker job routes
	Route::get('/jobs', 'Worker\JobController@index')->name('worker.jobs');
	Route::get('/job/{job}/detail', 'Worker\JobController@detail')->name('worker.job.detail');
	Route::get('/job/{job}/apply', 'Worker\JobController@apply')->name('worker.job.apply');
	Route::get('/job/{job}/close', 'Worker\JobController@close')->name('worker.job.close');

	// Worker message widget routes
	Route::get('/messages', 'Worker\MessageController@index')->name('worker.messages');
	Route::get('/message/chat/{job}', 'Worker\MessageController@chat')->name('worker.message.chat');
	Route::post('/message/send/{job}', 'Worker\MessageController@send')->name('worker.message.send');

	// Worker calendar widget routes
	Route::get('/calendar', 'Worker\CalendarController@index')->name('worker.calendar');

	// Worker payment routes
	Route::get('/payments', 'Worker\PaymentController@index')->name('worker.payments');
	Route::post('/payment/store', 'Worker\PaymentController@store')->name('worker.payment.store');
	Route::get('/payment/{payment}/edit', 'Worker\PaymentController@edit')->name('worker.payment.edit');
	Route::put('/payment/{payment}/update', 'Worker\PaymentController@update')->name('worker.payment.update');
	Route::delete('/payment/{payment}/delete', 'Worker\PaymentController@delete')->name('worker.payment.delete');

	// Worker ratings routes
	Route::get('/ratings', 'Worker\RatingController@index')->name('worker.ratings');
	Route::get('/rating/{job}/create', 'Worker\RatingController@create')->name('worker.rating.create');
	Route::post('/rating/{job}/store', 'Worker\RatingController@store')->name('worker.rating.store');
	Route::get('/rating/{job}/edit', 'Worker\RatingController@edit')->name('worker.rating.edit');
	Route::put('/rating/{job}/update', 'Worker\RatingController@update')->name('worker.rating.update');
	Route::delete('/rating/{job}/delete', 'Worker\RatingController@delete')->name('worker.rating.delete');

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This group of routes manages the Admin Dashboard tasks
|
*/

Route::prefix('/admin')->group(function() {

	Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
	
	// Admin users administration
	Route::get('admin-users', 'Admin\AdminUserController@index')->name('admin.adminusers');
	Route::get('admin-user/create', 'Admin\AdminUserController@create')->name('admin.adminuser.create');
	Route::post('admin-user/store', 'Admin\AdminUserController@store')->name('admin.adminuser.store');
	Route::get('admin-user/{admin}/create-profile', 'Admin\AdminUserController@create_profile')->name('admin.adminuser.create_profile');
	Route::post('admin-user/{admin}/store-profile', 'Admin\AdminUserController@store_profile')->name('admin.adminuser.store_profile');
	Route::get('admin-user/{admin}/edit', 'Admin\AdminUserController@edit')->name('admin.adminuser.edit');
	Route::put('admin-user/{admin}/update', 'Admin\AdminUserController@update')->name('admin.adminuser.update');
	Route::get('admin-user/{admin}/ch-password', 'Admin\AdminUserController@ch_password')->name('admin.adminuser.ch_password');
	Route::put('admin-user/{admin}/ch-password', 'Admin\AdminUserController@ch_password')->name('admin.adminuser.ch_password');
	Route::delete('admin-user/{admin}/delete', 'Admin\AdminUserController@delete')->name('admin.adminuser.delete');
	
	// Services administration
	Route::get('services', 'Admin\ServiceController@index')->name('admin.services');
	Route::get('service/create', 'Admin\ServiceController@create')->name('admin.service.create');
	Route::post('service/store', 'Admin\ServiceController@store')->name('admin.service.store');
	Route::get('service/{service}/edit', 'Admin\ServiceController@edit')->name('admin.service.edit');
	Route::put('service/{service}/update', 'Admin\ServiceController@update')->name('admin.service.update');
	Route::delete('service/{service}/delete', 'Admin\ServiceController@delete')->name('admin.service.delete');
	Route::put('service/{service}/activate', 'Admin\ServiceController@activate')->name('admin.service.activate');
	
	Route::get('services/pending', 'Admin\ServiceController@pending')->name('admin.services.panding');

	// Content edition
	Route::get('content/welcome', 'Admin\DashboardController@welcome')->name('admin.welcome');
	Route::post('content/welcome/store', 'Admin\DashboardController@welcome_store')->name('admin.welcome.store');
	
	Route::get('content/services', 'Admin\DashboardController@services')->name('admin.content.services');
	
	Route::get('content/howitworks', 'Admin\DashboardController@howitworks')->name('admin.howitworks');
	Route::post('content/howitworks/store', 'Admin\DashboardController@howitworks_store')->name('admin.howitworks.store');
	
	Route::get('content/contact', 'Admin\DashboardController@contact')->name('admin.contact');
	Route::get('content/contact/edit', 'Admin\DashboardController@contact_edit')->name('admin.contact.edit');
	Route::post('content/contact/store', 'Admin\DashboardController@contact_store')->name('admin.contact.store');
	
	Route::get('content/privacy', 'Admin\DashboardController@privacy')->name('admin.privacy');
	Route::get('content/privacy/edit', 'Admin\DashboardController@privacy_edit')->name('admin.privacy.edit');
	Route::post('content/privacy/store', 'Admin\DashboardController@privacy_store')->name('admin.privacy.store');
	
	Route::get('content/terms', 'Admin\DashboardController@terms')->name('admin.terms');
	Route::get('content/terms/edit', 'Admin\DashboardController@terms_edit')->name('admin.terms.edit');
	Route::post('content/terms/store', 'Admin\DashboardController@terms_store')->name('admin.terms.store');

	// User administration
	Route::get('users/dash', 'Admin\UserController@dash')->name('admin.users.dash');
	Route::get('users', 'Admin\UserController@index')->name('admin.users');
	Route::get('users/new-users', 'Admin\UserController@show_new_users')->name('admin.users.new');
	Route::get('users/active-users', 'Admin\UserController@show_active_users')->name('admin.users.active');
	Route::get('user/{user}/edit', 'Admin\UserController@edit')->name('admin.user.edit');
	Route::put('user/{user}/update', 'Admin\UserController@update')->name('admin.user.update');
	Route::delete('users/{user}/delete', 'Admin\UserController@delete')->name('admin.user.delete');
	Route::get('users/jobs', 'Admin\UserController@jobs')->name('admin.users.jobs');

	// Worker administration
	Route::get('workers', 'Admin\WorkerController@index')->name('admin.workers');
	Route::get('workers/new-workers', 'Admin\WorkerController@show_new_workers')->name('admin.workers.new');
	Route::get('workers/active-workers', 'Admin\WorkerController@show_active_workers')->name('admin.workers.active');
	Route::get('worker/{worker}/edit', 'Admin\WorkerController@edit')->name('admin.worker.edit');
	Route::put('worker/{worker}/update', 'Admin\WorkerController@update')->name('admin.worker.update');
	Route::delete('worker/{worker}/delete', 'Admin\WorkerController@delete')->name('admin.worker.delete');
	Route::get('workers/applications', 'Admin\WorkerController@applications')->name('admin.workers.applications');
	Route::get('workers/jobs', 'Admin\WorkerController@jobs')->name('admin.workers.jobs');
	
	// Finance administration
	Route::get('finance/client-payments', 'Admin\FinanceController@client_payments')->name('admin.finance.client.payments');
	Route::get('finance/{payment}/payment-register', 'Admin\FinanceController@payment_register')->name('admin.finance.payment.register');
	Route::post('finance/{payment}/payment-register', 'Admin\FinanceController@payment_register')->name('admin.finance.payment.register');
	Route::get('finance/worker-payments', 'Admin\FinanceController@worker_payments')->name('admin.finance.worker.payments');
	Route::get('finance/{worker_payment}/show_payment', 'Admin\FinanceController@show_payment')->name('admin.finance.show.payment');

});

