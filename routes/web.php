<?php

use App\Http\Controllers\Admin\TestimonialSectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ProfileController
};
use App\Http\Controllers\Admin\{
    SliderController,
    UserController,


    FaqSectionController,
    whyChooseUsSectionController,
    EnquiryController,
    BookingController,
    NotificationController,
    ProcedureController,
    ServiceCategoryController,
    ServiceController,
    ServiceProjectController,
    ServiceSectionController,
    SettingController,
    PackageController,
    PackageCategoryController,
    InfoBlockController,
    ServiceFeatureController,
    ServiceBlockController,

    ServiceElementController,

};

Route::get('/pending-user', [UserController::class, 'pendingUser'])->name('pending.user');
Route::get('/blocked-user', [UserController::class, 'blockedUser'])->name('blocked.user');

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/slider", [SliderController::class, "index"])->name("admin.slider");
    Route::get("/slider/add", [SliderController::class, "add"])->name("admin.slider.add");
    Route::post("/slider/store", [SliderController::class, "store"])->name("admin.slider.store");
    Route::delete("/slider/delete/{id}/", [SliderController::class, "destroy"])->name("admin.slider.delete");
    Route::get("/slider/edit/{id}/", [SliderController::class, "edit"])->name("admin.slider.edit");
    Route::post("/slider/update/{id}/", [SliderController::class, "update"])->name("admin.slider.update");
});


Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('user.profile.edit');
Route::post('/update-Profile', [ProfileController::class, 'updateProfile'])->name('user.profile.update');
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('user.password.update');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'status'])->group(function () {
    Route::middleware(['auth', 'user'])->group(function () {
        Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    });
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        // profile routes
        Route::get('/editProfile', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
        Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('admin.password.update');

        // user routes
        Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add-user', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('/store-user', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/update-user/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::post('/delete-user/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

        Route::post('/makependingUser/{id}', [UserController::class, 'makependingUser'])->name('admin.user.makependingUser');
        Route::post('/makeapprovedUser/{id}', [UserController::class, 'makeapprovedUser'])->name('admin.user.makeapprovedUser');
        Route::post('/makeblockedUser/{id}', [UserController::class, 'makeblockedUser'])->name('admin.user.makeblockedUser');

        Route::get('/pendingUsers', [UserController::class, 'pendingUsers'])->name('admin.user.pendingUsers');
        Route::get('/approvedUsers', [UserController::class, 'approvedUsers'])->name('admin.user.approvedUsers');
        Route::get('/blockedUsers', [UserController::class, 'blockedUsers'])->name('admin.user.blockedUsers');

        Route::get('/testimonial-section', [TestimonialSectionController::class, 'index'])->name('admin.testimonial-section.index');
        Route::get('/testimonial-section/add', [TestimonialSectionController::class, 'add'])->name('admin.testimonial-section.add');
        Route::post('/testimonial-section/store', [TestimonialSectionController::class, 'store'])->name('admin.testimonial-section.store');
        Route::get('/testimonial-section/edit/{id}', [TestimonialSectionController::class, 'edit'])->name('admin.testimonial-section.edit');
        Route::put('/testimonial-section/update/{id}', [TestimonialSectionController::class, 'update'])->name('admin.testimonial-section.update');
        Route::post('/testimonial-section/delete/{id}', [TestimonialSectionController::class, 'delete'])->name('admin.testimonial-section.delete');

        Route::get('/why-choose-us-section', [whyChooseUsSectionController::class, 'index'])->name('admin.why.choose.us.section.index');
        Route::get('/why-choose-us-section/add', [whyChooseUsSectionController::class, 'add'])->name('admin.why.choose.us.section.add');
        Route::post('/why-choose-us-section/store', [whyChooseUsSectionController::class, 'store'])->name('admin.why.choose.us.section.store');
        Route::get('/why-choose-us-section/edit/{id}', [whyChooseUsSectionController::class, 'edit'])->name('admin.why.choose.us.section.edit');
        Route::post('/why-choose-us-section/update/{id}', [whyChooseUsSectionController::class, 'update'])->name('admin.why.choose.us.section.update');
        Route::post('/why-choose-us-section/delete/{id}', [whyChooseUsSectionController::class, 'delete'])->name('admin.why.choose.us.section.delete');

        Route::get('/faq-section', [FaqSectionController::class, 'index'])->name('admin.faq-section.index');
        Route::get('/faq-section/add', [FaqSectionController::class, 'add'])->name('admin.faq-section.add');
        Route::post('/faq-section/store', [FaqSectionController::class, 'store'])->name('admin.faq-section.store');
        Route::get('/faq-section/edit/{id}', [FaqSectionController::class, 'edit'])->name('admin.faq-section.edit');
        Route::put('/faq-section/update/{id}', [FaqSectionController::class, 'update'])->name('admin.faq-section.update');
        Route::post('/faq-section/delete/{id}', [FaqSectionController::class, 'delete'])->name('admin.faq-section.delete');




        // Route::get('/admin/procedures/{pageId}', [ProcedureController::class, 'getByPageId'])->name('admin.procedures');
        Route::get('/admin/procedures/{slug}', [ProcedureController::class, 'index'])->name('admin.procedures.index');
        Route::get('/admin/procedures/add/{slug}', [ProcedureController::class, 'add'])->name('admin.procedures.add');
        Route::post('/procedures/store/{slug}', [ProcedureController::class, 'store'])->name('admin.procedures.store');
        Route::get('/admin/procedures/{id}/edit', [ProcedureController::class, 'edit'])->name('admin.procedures.edit');
        Route::post('/admin/procedures/update/{id}', [ProcedureController::class, 'update'])->name('admin.procedures.update');
        Route::post('/admin/procedures/{id}', [ProcedureController::class, 'delete'])->name('admin.procedures.delete');


        // Service Category Routes
        Route::get('/service-category', [ServiceCategoryController::class, 'index'])->name('admin.service.category.index');
        Route::get('/service-category/add', [ServiceCategoryController::class, 'add'])->name('admin.service.category.add');
        Route::post('/service-category/store', [ServiceCategoryController::class, 'store'])->name('admin.service.category.store');
        Route::get('/service-category/edit/{id}', [ServiceCategoryController::class, 'edit'])->name('admin.service.category.edit');
        Route::put('/service-category/update/{id}', [ServiceCategoryController::class, 'update'])->name('admin.service.category.update');
        Route::post('/service-category/delete/{id}', [ServiceCategoryController::class, 'delete'])->name('admin.service.category.delete');
        // End of Service Category Routes

        // Service Routes
        Route::get('/service', [ServiceController::class, 'index'])->name('admin.service.index');
        Route::get('/service/add', [ServiceController::class, 'add'])->name('admin.service.add');
        Route::post('/service/store', [ServiceController::class, 'store'])->name('admin.service.store');
        Route::get('/service/edit/{slug}', [ServiceController::class, 'edit'])->name('admin.service.edit');
        Route::post('/service/update/{slug}', [ServiceController::class, 'update'])->name('admin.service.update');
        Route::post('/service/delete/{id}', [ServiceController::class, 'delete'])->name('admin.service.delete');

        // Blocks  Routes
        Route::get('/service/block/{slug}', [ServiceBlockController::class, 'index'])->name('admin.service.block.index');
        Route::get('/service/block/add/{slug}', [ServiceBlockController::class, 'add'])->name('admin.service.block.add');
        Route::post('/service/block/store/{slug}', [ServiceBlockController::class, 'store'])->name('admin.service.block.store');
        Route::get('/service/block/edit/{id}', [ServiceBlockController::class, 'edit'])->name('admin.service.block.edit');
        Route::post('/service/block/update/{id}', [ServiceBlockController::class, 'update'])->name('admin.service.block.update');
        Route::post('/service/block/delete/{id}', [ServiceBlockController::class, 'delete'])->name('admin.service.block.delete');


        // Blocks  Routes
        Route::get('/admin/service/section/{slug}', [ServiceSectionController::class, 'index'])->name('admin.service.section.index');
        Route::get('/admin/service/section/add/{slug}', [ServiceSectionController::class, 'add'])->name('admin.service.section.add');
        Route::post('/admin/service/section/store/{slug}', [ServiceSectionController::class, 'store'])->name('admin.service.section.store');
        Route::get('/admin/service/section/edit/{id}', [ServiceSectionController::class, 'edit'])->name('admin.service.section.edit');
        Route::post('/admin/service/section/update/{id}', [ServiceSectionController::class, 'update'])->name('admin.service.section.update');
        Route::post('/admin/service/section/delete/{id}', [ServiceSectionController::class, 'delete'])->name('admin.service.section.delete');


        Route::get('/service/setting/{slug}', [ServiceController::class, 'setting'])->name('admin.service.setting');
        Route::post('/service/setting/update/{id}', [ServiceController::class, 'updateSetting'])->name('admin.service.setting.update');

        // Elements Routes
        Route::get('/service/element/{slug}', [ServiceElementController::class, 'index'])->name('admin.service.element.index');
        Route::get('/service/element/add/{slug}', [ServiceElementController::class, 'add'])->name('admin.service.element.add');
        Route::post('/service/element/store/{slug}', [ServiceElementController::class, 'store'])->name('admin.service.element.store');
        Route::get('/service/element/edit/{id}', [ServiceElementController::class, 'edit'])->name('admin.service.element.edit');
        Route::post('/service/element/update/{id}', [ServiceElementController::class, 'update'])->name('admin.service.element.update');
        Route::post('/service/element/delete/{id}', [ServiceElementController::class, 'delete'])->name('admin.service.element.delete');

        // Feature Routes
        Route::get('/service/feature/{slug}', [ServiceFeatureController::class, 'index'])->name('admin.service.feature.index');
        Route::get('/service/feature/add/{slug}', [ServiceFeatureController::class, 'add'])->name('admin.service.feature.add');
        Route::post('/service/feature/store/{slug}', [ServiceFeatureController::class, 'store'])->name('admin.service.feature.store');
        Route::get('/service/feature/edit/{id}', [ServiceFeatureController::class, 'edit'])->name('admin.service.feature.edit');
        Route::post('/service/feature/update/{id}', [ServiceFeatureController::class, 'update'])->name('admin.service.feature.update');
        Route::post('/service/feature/delete/{id}', [ServiceFeatureController::class, 'delete'])->name('admin.service.feature.delete');

        // End of Service Routes
        Route::get("/service-project/add/{id}", [ServiceProjectController::class, "add"])->name("admin.service.project.add");
        Route::post("/service-project/store", [ServiceProjectController::class, "store"])->name("admin.service.project.store");
        Route::get("/service-project/edit/{id}/", [ServiceProjectController::class, "edit"])->name("admin.service.project.edit");
        Route::put("/service-project/update/{id}/", [ServiceProjectController::class, "update"])->name("admin.service.project.update");
        Route::post("/service-project/delete/{id}/", [ServiceProjectController::class, "delete"])->name("admin.service.project.delete");


        //start package route
        Route::get('/package', [PackageController::class, 'index'])->name('admin.package.index');
        Route::get('/package/add', [PackageController::class, 'add'])->name('admin.package.add');
        Route::post('/package/store', [PackageController::class, 'store'])->name('admin.package.store');
        Route::get('/package/edit/{id}', [PackageController::class, 'edit'])->name('admin.package.edit');
        Route::put('/package/update/{id}', [PackageController::class, 'update'])->name('admin.package.update');
        Route::delete('/package/delete/{id}', [PackageController::class, 'delete'])->name('admin.package.delete');
        // End of package Routes
        //start package categories route
        Route::get('/package-category', [PackageCategoryController::class, 'index'])->name('admin.package-category.index');
        Route::get('/package-category/add', [PackageCategoryController::class, 'add'])->name('admin.package-category.add');
        Route::post('/package-category/store', [PackageCategoryController::class, 'store'])->name('admin.package-category.store');
        Route::get('/package-category/edit/{id}', [PackageCategoryController::class, 'edit'])->name('admin.package-category.edit');
        Route::put('/package-category/update/{id}', [PackageCategoryController::class, 'update'])->name('admin.package-category.update');
        Route::delete('/package-category/delete/{id}', [PackageCategoryController::class, 'delete'])->name('admin.package-category.delete');
        // End of package categories Routes

        // Info block Routes
        Route::get('/info-block', action: [InfoBlockController::class, 'index'])->name('admin.info-block.index');
        Route::get('/info-block/add', [InfoBlockController::class, 'add'])->name('admin.info-block.add');
        Route::post('/info-block/store', [InfoBlockController::class, 'store'])->name('admin.info-block.store');
        Route::get('/info-block/edit/{id}', [InfoBlockController::class, 'edit'])->name('admin.info-block.edit');
        Route::post('/info-block/update/{id}', [InfoBlockController::class, 'update'])->name('admin.info-block.update');
        Route::post('/info-block/delete/{id}', [InfoBlockController::class, 'delete'])->name('admin.info-block.delete');
        // End of Info block Routes



        // Enquiry Routes
        Route::get('/enquiry', [EnquiryController::class, 'index'])->name('admin.enquiry.index');
        Route::get('/enquiry/add', [EnquiryController::class, 'add'])->name('admin.enquiry.add');
        Route::post('/enquiry/store', [EnquiryController::class, 'store'])->name('admin.enquiry.store');
        Route::get('enquiry/restore', [EnquiryController::class, 'restorePage'])->name('admin.enquiry.restore.page');
        Route::get('/enquiry/edit/{id}', [EnquiryController::class, 'edit'])->name('admin.enquiry.edit');
        Route::post('/enquiry/update/{id}', [EnquiryController::class, 'update'])->name('admin.enquiry.update');
        Route::post('/enquiry/delete/{id}', [EnquiryController::class, 'delete'])->name('admin.enquiry.delete');
        Route::get('/enquiry/detail/{id}', [EnquiryController::class, 'detail'])->name('admin.enquiry.detail');
        Route::post('/enquiry/comment/{id}', [EnquiryController::class, 'comment'])->name('admin.enquiry.comment.store');
        Route::get('/enquiry/comment/delete/{id}', [EnquiryController::class, 'deleteComment'])->name('admin.enquiry.comment.delete');
        Route::get('enquiry/restore/{id}', [EnquiryController::class, 'restore'])->name('admin.enquiry.restore');
        Route::post('enquiry/force_delete/{id}', [EnquiryController::class, 'forceDelete'])->name('admin.enquiry.force.delete');

        // End of Enquiry


        // End of Newsletter

        // Booking

        Route::get('/booking', action: [BookingController::class, 'index'])->name('admin.booking.index');
        Route::get('/booking/add', [BookingController::class, 'add'])->name('admin.booking.add');
        Route::post('/booking/store', [BookingController::class, 'store'])->name('admin.booking.store');
        Route::get('/booking/edit/{id}', [BookingController::class, 'edit'])->name('admin.booking.edit');
        Route::post('/booking/update/{id}', [BookingController::class, 'update'])->name('admin.booking.update');
        Route::delete('/booking/delete/{id}', [BookingController::class, 'delete'])->name('admin.booking.delete');

        // End of Booking


        // Setting Routes
        Route::get('/setting', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
        // End of Setting Routes

    });


    Route::get('admin-notification', [NotificationController::class, 'adminNotification'])->name('admin.notifications');
    Route::get('admin-notify/{id}', [NotificationController::class, 'adminNotifyDetail'])->name('admin.notify.detail');
    Route::post('admin-mark-as-read', [NotificationController::class, 'admin_Notify_MarkRead'])->name('admin.mark.read');
    Route::get('admin-all-read', [NotificationController::class, 'adminNotify_Mark_all_Read'])->name('admin.all.read');

});