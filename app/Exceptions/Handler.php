<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Validation\ValidationException;
use Log;
use Illuminate\Support\Facades\Http;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Log::error($e->getMessage(), ['exception' => $e]);

            // إرسال الخطأ إلى Slack عند حدوث خطأ خطير
//            if ($e instanceof QueryException || $e instanceof \ErrorException) {
//                Http::post(env('SLACK_WEBHOOK_URL'), [
//                    'text' => "🚨 خطأ في السيرفر: " . $e->getMessage(),
//                ]);
//            }
        });
    }

    /**
     * Handle unauthenticated users.
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/admin/login');
        }
        if ($request->is('user') || $request->is('user/*')) {
            return redirect()->guest('/')->with('auth-modal', __('Please Login First !!'));
        }
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function xrender($request, Throwable $exception)
    {
        // تسجيل الأخطاء في السجلات
        Log::error($exception->getMessage(), ['exception' => $exception]);

        // خطأ: لم يتم العثور على الصفحة
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'الصفحة المطلوبة غير موجودة',
                'error' => 'Page Not Found'
            ], 404);
        }

        // خطأ: طريقة الطلب غير مسموحة
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message' => 'طريقة الطلب غير مسموحة',
                'error' => 'Method Not Allowed'
            ], 405);
        }

        // خطأ: تجاوز الحد المسموح (Rate Limit)
        if ($exception instanceof ThrottleRequestsException) {
            return response()->json([
                'message' => 'لقد تجاوزت الحد المسموح به من الطلبات، الرجاء المحاولة لاحقًا',
                'error' => 'Too Many Requests'
            ], 429);
        }

        // خطأ: مشكلة في قاعدة البيانات
        if ($exception instanceof QueryException) {
            return response()->json([
                'message' => 'حدث خطأ أثناء التعامل مع قاعدة البيانات',
                'error' => 'Database Error'
            ], 500);
        }

        // خطأ: فشل التحقق من البيانات
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'البيانات المدخلة غير صحيحة',
                'errors' => $exception->errors()
            ], 422);
        }

//        dd($exception->getMessage());
        // خطأ عام
        return response()->json([
            'message' => 'حدث خطأ غير متوقع، يرجى المحاولة لاحقًا',
            'error' => 'Server Error'
        ], 500);
    }
}
